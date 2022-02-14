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
		//<link rel="stylesheet" href="css/nm_admin_bar.css" type="text/css">
?>

<?php
		wp_enqueue_script( 'show_notice_js', plugin_dir_url( __FILE__ ) . 'js/data_manage.js' );
		add_action('admin_enqueue_scripts', 'enqueue_close_script');
		add_action('admin_bar_menu', 'nm_menu_setup', 999);
	}

	function enqueue_close_script() {
		wp_enqueue_script( 'close_item_js', plugin_dir_url(__FILE__) . 'js/close_item.js');
	}

	function nm_menu_setup($wp_admin_bar)
	{
		//--------------------setting all data to use
		$noti_id = 0;
		$a = ["#db3236", "#3cba54", "#f4c20d", "#4885ed", "black"];
		$notice_style = '<div class="';
		$notice_style2 = '" style="background-color:#F2F3F5; color:black; border:0px solid #3c434a; border-left-width:3px; padding:0px 25px 0px 5px !important; border-left-color:';
		$close_icon_style = '<span class="close_button" style="cursor:pointer; position:absolute; top:50%; right:1%; font-size:x-large; color:#808080; transform: translate(0%, -50%);">&times;</span>';

		//------------handle the case when no data gets loaded
		// 0:error, 1:success, 2:warning, 3:info, 4:misc
		// for all n{0:data, 1:dismissable 2:classes}
		$t = get_option('noti_data');


		//-------------------- Showing all the data in menu
		//adding notices section to the toolbar
		$wp_admin_bar->add_node( array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div style="text-align:right"> Notices </div>',
			'href' => false,
			'meta' => array('onclick' => '{var x = document.getElementById("wp-admin-bar-notification-manager-default").parentNode; x.style.display = (x.style.display === "block") ? "" : "block";}'),
		));
		/*
		//------------handle the case when no data gets loaded
		// 0:error, 1:success, 2:warning, 3:info, 4:misc
		// for all n{0:data, 1:dismissable 2:classes}
		$t = get_option('noti_data');


		// looping through all types of notices
		for($x=0; $x<5; $x++)
		{
			//adding the notices to menu
			for($i=0; $i<count($t[$x]); $i++)
			{
				$close_icon_status = $t[$x][$i]['dismis_type'] ? $close_icon_style : "";
				$noti_id++;
				$wp_admin_bar->add_node(array(
					'id' => $noti_id,
					'parent' => 'notification-manager',
					'title' => $notice_style.$t[$x][$i]['classes'].$notice_style2.$a[$x].'">'.$t[$x][$i]["data"].$close_icon_status.'</div>',
				));
			}
		}
		 */
		$wp_admin_bar->add_node(array(
			'id' => 404,
			'parent' => 'notification-manager',
			'title' => '<div style="color:black; height:17px !important;"><center> --------------------  </center></div>',
		));
?>
<style>
span.close_button:hover{color:red !important;}
#wp-admin-bar-notification-manager-default::-webkit-scrollbar-track{background-color: white;}
#wp-admin-bar-notification-manager-default::-webkit-scrollbar{width: 7px; background-color: #808080;}
#wp-admin-bar-notification-manager-default::-webkit-scrollbar-thumb{background-color: #808080;}
.ab-sub-wrapper #wp-admin-bar-notification-manager-default li *{height:auto !important; padding:0px 5px 10px 5px !important;}
.ab-sub-wrapper #wp-admin-bar-notification-manager-default li {width:25vw !important;}
.ab-item.ab-empty-item {white-space:unset !important;}
#wp-admin-bar-notification-manager-default{background-color:white !important; box-shadow:0 2px 5px 3px rgb(0 0 0 / 20%) !important; overflow-y:auto !important; overflow-x:hidden !important; max-height:80vh !important;}
#wp-admin-bar-notification-manager-default a:link{color:#4885ed !important;}
#wp-admin-bar-notification-manager-default a:visited{color:#4885ed !important;}
#wp-admin-bar-notification-manager-default a:hover{color:#db3236 !important;}
.nm-drpdn{background-color:#F2F3F5;color:black;border:0px solid #3c434a;border-left-width:3px;padding:0px 25px 0px 5px !important;}
.nm-close{cursor:pointer; position:absolute; top:50%; right:1%; font-size:x-large; color:#808080; transform: translate(0%, -50%);}
.nm-reset{all:unset !important;}
</style>
<?php
	}

	add_action('init', 'nm_main');
}
