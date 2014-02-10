<?php
/*
Plugin Name: WP 101 Master
Plugin URI: http://vip.wordpress.com
Description: Example of some essential wordpress plugin methods, hooks, and filters
Version: 0.1
Author: Giancarlo Morillo
Author URI: http://www.levelg.com
*/

/* ------------------------ */
/* FILTER */
/* ------------------------ */

// Change the post excerpt length on a listing page
function custom_excerpt_length( $length ) { return 20; }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Change the ellipses indicator for truncated content on post listing page
function new_excerpt_more( $more ) {
	return '[<span style="font-size:10px;padding:2px;">&diams;&diams;&diams;</span>]';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* ------------------------ */
/* ACTION */
/* ------------------------ */

// After save action
function after_save( $post_id, $post ) {
    wp_die( 
		"YAY! You just saved".$post->post_title.". foobar!<br/>
		<a href=\"javascript:window.history.go(-1)\">Backish</a>" 
	);
}

function initialize_wp101(){
	update_option( 'save_post_arguments', 2 );
	add_action( 'save_post', 'after_save', 10, get_option( 'save_post_arguments' ) );
}

add_action('init', 'initialize_wp101');

/* Custom Admin Menu Item */
function register_my_custom_menu_page(){
    add_menu_page( 
    	'custom menu title', 
    	'custom menu', 
    	'manage_options', 
    	'wp-101-master/wp-101-admin.php', 
    	'', 
    	plugins_url( 'wp-101-master/images/icon.jpg' ), 
    	6 
    );
}

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function initialize_admin(){
	wp_enqueue_script( 'jquery' ); 		// load jquery
}
add_action( 'admin_init', 'initialize_admin');
add_action( 'admin_menu', 'register_my_custom_menu_page' );
