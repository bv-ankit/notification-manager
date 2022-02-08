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
		$a = ["#db3236", "#3cba54", "#4885ed", "#f4c20d", "while"];
		
		//adding notices section to the toolbar
		$wp_admin_bar->add_node( array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => 'Notices',
			'href' => false,
		));
		
		//------------handle the case when no data gets loaded
		//fetching all the data from wp_options
		//$number_of_notifications = get_option('number_of_notifications');
		
		// 0:error, 1:success, 2:warning, 3:info, 4:misc
		$t = get_option('noti_data');
		if( (count($t[0]) + count($t[1]) + count($t[2]) + count($t[3])  + count($t[4])) == 0)
		{
			$wp_admin_bar->add_node(array(
				'id' => 404,
				'parent' => 'notification-manager',
				'title' => '<div style="color:black"> Nothing to see here </div>',
			));
		}

		$sty1 = '<style> #wp-admin-bar-';
		$sty2 = ' * {height:auto !important;padding:5px 12px !important;} </style>';
		$notice_style = '<div style="background-color:#F2F3F5; color:black; border:0px solid #3c434a; border-left-width:4px; border-left-color:';

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
					'title' => $sty1.$noti_id.$sty2.$notice_style.$a[$x].'">'.$t[$x][$i]["data"].'</div>',
				));
			}
		}
		echo '<style> #wp-admin-bar-notification-manager-default{background-color:white !important;}';
		echo '#wp-admin-bar-notification-manager-default a:link{color:#4885ed !important;}';
	       	echo '#wp-admin-bar-notification-manager-default a:visited{color:#4885ed !important;}';
	       	echo '#wp-admin-bar-notification-manager-default a:hover{color:#db3236 !important;} </style>';
	}

	add_action('init', 'nm_main');
}
