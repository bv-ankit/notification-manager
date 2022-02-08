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
		add_action('admin_bar_menu', 'nm_menu_setup', 999);
	}

	function nm_menu_setup($wp_admin_bar)
	{
		$noti_id = 0;
		
		//adding notices section to the toolbar
		$wp_admin_bar->add_node( array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => 'Notices',
			'href' => false,
		));
		
		//------------handle the case when no data gets loaded
		//fetching all the data from wp_options
		$number_of_notifications = get_option('number_of_notifications');
		
		// 0:error, 1:success, 2:warning, 3:info, 4:misc
		$t = get_option('noti_data');

		// looping through all types of notices
		for($x=0; $x<5; $x++)
		{
			//adding the notices to menu
			for($i=0; $i<count($t[$x]); $i++)
			{
				$noti_id++;
				$wp_admin_bar->add_node(array(
					'id' => $noti_id,
					'parent' => 'notification-manager',
					'title' => '<br><style> #wp-admin-bar-'.$noti_id.' * {height:auto !important;} </style><div style="color:white">'.$t[$x][$i]["data"].'</div>',
				));
			}
		}
		echo '<style> #wp-admin-bar-notification-manager-default{color:teal !important;} </style>';
	}

	add_action('init', 'nm_main');
}
