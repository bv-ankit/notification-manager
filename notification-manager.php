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
{	function enqueue_close_script() {
		wp_enqueue_script( 'close_item_js', plugin_dir_url(__FILE__) . 'js/close_item.js');
	}
	function nm_main()
	{
		//------------handle the case when require once fails
		require_once('nm-data-handler.php');
		add_action('admin_enqueue_scripts', 'enqueue_close_script');
		add_action('admin_bar_menu', 'nm_menu_setup', 999);
	}

	function nm_menu_setup($wp_admin_bar)
	{
		$noti_id = 0;
		$a = ["#db3236", "#3cba54", "#4885ed", "#f4c20d", "black"];
		
		//adding notices section to the toolbar
		$wp_admin_bar->add_node( array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div style="text-align:right"> Notices </div>',
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

		$notice_style = '<div style="background-color:#F2F3F5; color:black; border:0px solid #3c434a; border-left-width:4px; border-left-color:';
		$close_icon_style = '<span class="close" style="cursor:pointer; position:absolute; top:50%; right:1%; padding: 12px 16px; transform: translate(0%, -50%);">&times;</span>';
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
					'title' => $notice_style.$a[$x].'">'.$t[$x][$i]["data"].$close_icon_style'</div>',
				));
			}
		}
		echo '<style>';
		echo '.ab-sub-wrapper li *{height:auto !important; padding:4px 5px !important;}';
		echo '.ab-sub-wrapper li {width:400px !important;}';
		echo '.ab-item.ab-empty-item {white-space:unset !important;}';
	        echo '#wp-admin-bar-notification-manager-default{background-color:white !important; box-shadow:0 2px 5px 3px rgb(0 0 0 / 20%) !important; overflow-y:auto !important; max-height:90vh !important;}';
		echo '#wp-admin-bar-notification-manager-default a:link{color:#4885ed !important;}';
	       	echo '#wp-admin-bar-notification-manager-default a:visited{color:#4885ed !important;}';
	       	echo '#wp-admin-bar-notification-manager-default a:hover{color:#db3236 !important;} </style>';
	}

	add_action('init', 'nm_main');
}
