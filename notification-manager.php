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
		add_action('wp_ajax_update_notification_option', 'update_notification_option');
	}

	function nm_enqueue_notice_data()
	{
		if(get_option('notifications_seen_status_db')){
			//echo "Exists";
		}
		else{
			add_option('notifications_seen_status_db', array());
		}
		$options = get_option('notifications_seen_status_db');
		wp_enqueue_style('nm_menu',plugin_dir_url(__FILE__) . 'css/nm_menu.css');
		wp_enqueue_script( 'nm_notice_data', plugin_dir_url( __FILE__ ) . 'js/nm_notice_data.js', [], false, true );
		wp_localize_script('nm_notice_data', 'notifications_status_data_new', $options);
	}

	function update_notification_option(){
		if(isset($_REQUEST)){
			$new_hashes = $_REQUEST['status'];
			$options = get_option('notifications_seen_status_db');
			$options = array_merge($options, $new_hashes);
			update_option('notifications_seen_status_db', $options);
		}
	}

	function nm_create_menu($wp_admin_bar)
	{
		$wp_admin_bar->add_node(
			array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div id="notification-count" style="text-align:right" class="notification-count"> Notifications </div>',
			'href' => false,
			)
		);

		$nm_temp = plugins_url()."/notification-manager/bell_icon.png";
		//echo '<div id="nm_container"><h3 id="no-notifications-present"> There is no notification to display </h3></div>';
		echo '<div id="nm_container">
			<button type="button" id="mark_all_read_button">Mark all as read</button><br><br>
				<button type="button" class="collapsible">All Notifications </button>
				<div id="nm_sub_container_1">
					<h3 id="no-notifications-present"> No new notification </h3>
				</div>
				<button type="button" class="collapsible">Read Notifications</button>
				<div id="nm_sub_container_2">
				</div>
			</div>';
		echo '<script> function nm_hide(){console.log("aaa");document.getElementById("nm_notice_alert_box").style.visibility = "hidden"} </script>';
		echo '<div id="nm_notice_alert_box" class="nm_alert_animation"><div id="nm_alert_box_left_border"></div>New Notification Alert';
		echo '<span onclick=nm_hide()> &times </span> </div>';
	}

	add_action('init', 'nm_main');
}
