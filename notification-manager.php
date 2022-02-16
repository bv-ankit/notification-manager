<?php

/*
Plugin Name: Notification Manager
Plugin URI: https://blogvault.net/
Description: Never worry about the messy pages anymore we are here to handle your notifications.
Version: 1.0.0
Author: DrowningFish
Author URI: https://blogvault.net/
 */


if (!defined('ABSPATH')) exit;

if(function_exists('nm_main'))
{
	echo '<div class="notice notice-error">';
	echo '<h1> Stopping notification-manager plugin (conflict in function naming) </h1>';
	echo '</div>';
}
else
{
	function nm_main()
	{
		add_action('admin_bar_menu', 'nm_create_menu', 999);
		add_action('admin_enqueue_scripts', 'nm_enqueue_notice_data');
	}

	function nm_enqueue_notice_data()
	{
		wp_enqueue_style('nm_menu',plugin_dir_url(__FILE__) . 'css/nm_menu.min.css');
		wp_enqueue_script( 'nm_notice_data', plugin_dir_url( __FILE__ ) . 'js/nm_notice_data.js', [], false, true );
	}

	function nm_create_menu($wp_admin_bar)
	{
		$wp_admin_bar->add_node(
			array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div style="text-align:right"> Notifications <!--Notices--> </div>',
			'href' => false,
			'meta' => array('onclick' => '{var x = document.getElementById("nm_container"); x.style.visibility = x.style.visibility === "visible" ? "hidden" : "visible";}'),
			)
		);

		echo '<div id="nm_container"><h3> There is no notification to display </h3></div>';
	}

	add_action('init', 'nm_main');
}
