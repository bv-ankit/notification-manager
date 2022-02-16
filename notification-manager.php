<?php

/*
Plugin Name: Notification Manager
Plugin URI: https://blogvault.net/
Description: Never worry about the messy pages anymore we are here to handle your notifications.
Version: 1.0.0
Author: DrowningFish
Author URI: https://blogvault.net/
 */

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
		wp_register_style( 'nm_admin_bar',plugin_dir_url(__FILE__) . 'css/nm_admin_bar.css' );
		wp_enqueue_style( 'nm_admin_bar' );
		add_action('admin_bar_menu', 'nm_menu_setup', 999);
		add_action('admin_enqueue_scripts', 'nm_manage_script');
	}

	function nm_manage_script()
	{
		wp_enqueue_script( 'nm_data_manage', plugin_dir_url( __FILE__ ) . 'js/data_manage.js', [], false, true );
	}

	function nm_menu_setup($wp_admin_bar)
	{
		$wp_admin_bar->add_node(
			array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div style="text-align:right"> Notices </div>',
			'href' => false,
			'meta' => array('onclick' => '{var x = document.getElementById("nm_container"); x.style.visibility = x.style.visibility === "visible" ? "hidden" : "visible";}'),
			)
		);
		echo '<div id="nm_container"><h3> There is no notification to display </h3></div>';
	}

	add_action('init', 'nm_main');
}
