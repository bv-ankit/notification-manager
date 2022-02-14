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
		//------------handle the case when require once fails
		require_once('nm-data-handler.php');
		wp_enqueue_script( 'show_notice_js', plugin_dir_url( __FILE__ ) . 'js/data_manage.js' );
		wp_register_style( 'nm_admin_bar',plugin_dir_url(__FILE__) . 'css/nm_admin_bar.css' );
		wp_enqueue_style( 'nm_admin_bar' );
		add_action('admin_enqueue_scripts', 'enqueue_close_script');
		add_action('admin_bar_menu', 'nm_menu_setup', 999);
	}

	function enqueue_close_script() {
		wp_enqueue_script( 'close_item_js', plugin_dir_url(__FILE__) . 'js/close_item.js');
	}

	function nm_menu_setup($wp_admin_bar)
	{
		//-------------------- Showing all the data in menu
		//adding notices section to the toolbar
		$wp_admin_bar->add_node( array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div style="text-align:right"> Notices </div>',
			'href' => false,
			'meta' => array('onclick' => '{var x = document.getElementById("wp-admin-bar-notification-manager-default").parentNode; x.style.display = (x.style.display === "block") ? "" : "block";}'),
		));

		$wp_admin_bar->add_node(array(
			'id' => 404,
			'parent' => 'notification-manager',
			'title' => '<div style="color:black; height:17px !important;"></div>',
		));
	}

	add_action('init', 'nm_main');
}
