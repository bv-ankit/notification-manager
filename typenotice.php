<?php
/*
Plugin Name: typenotice
Plugin URI: http://example.com
Description: example to show all kinds of notices
Version: 1.0
Author: someone
Author URI: http://piyush-soni.github.io
 */

require_once('test_notices.php');

function hide_then_save() {
	echo '<style> .notice{display:none;} </style>';
	wp_enqueue_script( 'show_notice_js', plugin_dir_url( __FILE__ ) . 'js/show_notices.js' );
}

function custom_wp_toolbar_link( $wp_admin_bar ) {
	$wp_admin_bar->add_menu( array(
		'id'     => 'notification-manager',
		'parent' => 'top-secondary',
		//'title'  => sprintf( __( 'Notifications %s', 'wp-notification-center' ), 
		//'<span class="wpnc-count">' . count( $notifications ) . '</span>' ),
		'title' => '<span class="ab-icon"></span><span class="ab-label">'.__( 'Notifications', 'some-textdomain' ).'</span>',
		'href'   => false
	) );
	/*
	$t = 0;
	$wp_admin_bar->add_menu(array(
		'id' => 'wnci-5',
		'parent' => 'notification-manager',
		'title' => '<div id="wnci-'.$t.'"></div>',
		'href' => false,
	));
	$t++;
	$wp_admin_bar->add_menu(array(
                'id' => 'wnci-'.$t,
                'parent' => 'notification-manager',
                'title' => '<div id="wnci-'.$t.'"></div>',
                'href' => false,
	));
	 */
	$wp_admin_bar->add_menu(array(
		'meta' => array('html' => '<div> bla </div>')
	));


}


add_action('init', 'hide_then_save' );
add_action( 'admin_bar_menu', 'custom_wp_toolbar_link', 999 );
