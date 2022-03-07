<?php

/*
Plugin Name: Notification Manager
Plugin URI: https://blogvault.net/
Description: Never worry about the messy pages anymore we are here to handle your notifications.
Version: 1.0.0
Author: DrowningFish
Author URI: https://blogvault.net/
 */


if ( ! defined('ABSPATH') ) exit;

if ( is_admin() ){

	$nm_current_user = "";
	function createUserName(){
		global $nm_current_user;	
	  $nm_current_user = wp_get_current_user()->user_nicename;
	}
	add_action('init','createUserName');

	function nm_create_menu( $wp_admin_bar ) {
		$wp_admin_bar->add_node(
			array(
				'id' => 'notification-manager',
				'parent' => 'top-secondary',
				'title' => '<div id="nm_notification_count" style="text-align:right" >Notifications</div>',
				'href' => false,
			)
		);

		$nm_temp = plugins_url()."/notification-manager/info.png";
		?>
		<div id="nm_container">
			<div id="nm_container_top">
				<button onClick='nm_menu_toggle(true)' class="nm_menu_button" id="nm_unread">Unread<div id="nm_count_unread"></div></button>
				<button onClick='nm_menu_toggle(false)' class="nm_menu_button" id="nm_all">All<div id="nm_count_all"></div></button>
				<button onClick='nm_menu_toggle(true)' id="nm_mark_as_read">Mark all as read</button>
			</div>
			<hr>
			<div id="nm_container_bottom">
				<h3 id="nm_no_new_notice">No New Notifications</h3>
				<div id="nm_container_unread"></div>
				<div id="nm_container_all"></div>
			</div>
		</div>
		<script>
		function nm_hide() {
			document.getElementById("nm_notice_alert_box").style.visibility = "hidden";
		}

		function nm_menu_toggle( nm_toggle ) {
			document.getElementById("nm_container_all").style.display = nm_toggle ? "none" : "block";
			document.getElementById("nm_mark_as_read").style.display = nm_toggle ? "block" : "none";
			document.getElementById("nm_all").style.color = nm_toggle ? "#a8aaac" : "black";
			document.getElementById("nm_unread").style.color = nm_toggle ? "black" : "#a8aaac";
			document.getElementById("nm_count_all").style.backgroundColor = nm_toggle ? "#a8aaac" : "black";
			document.getElementById("nm_count_unread").style.backgroundColor = nm_toggle ? "black" : "#a8aaac";
		}

		</script>
		<?php
		echo '<div id="nm_notice_alert_box" ><img src="'.$nm_temp.'"> You have Unread Notifications';
		echo '<span onClick=nm_hide()> &times </span> </div>';
	}
	add_action('admin_bar_menu', 'nm_create_menu', 999);

	function nm_enqueue_notice_data() {
		global $nm_current_user;
		add_option('nm_hash_of_read_notices', array());
		$nm_hash_of_read_notices = get_option('nm_hash_of_read_notices');
		
		wp_enqueue_style('nm_menu', plugin_dir_url(__FILE__) . 'css/nm_menu.css');
		wp_enqueue_script('nm_md5_hash', plugin_dir_url( __FILE__ ) . 'js/md5.min.js', [], false, true ); 
		wp_enqueue_script('nm_notice_data', plugin_dir_url( __FILE__ ) . 'js/nm_notice_data.js', [], false, true );
		
		if ( ! array_key_exists($nm_current_user, $nm_hash_of_read_notices) ) {
			$nm_hash_of_read_notices[$nm_current_user] = array();
			update_option('nm_hash_of_read_notices',$nm_hash_of_read_notices);
		}
		wp_localize_script('nm_notice_data', 'nm_hash_of_read_notices', $nm_hash_of_read_notices[$nm_current_user]);
	}
	add_action('admin_enqueue_scripts', 'nm_enqueue_notice_data');

	function nm_add_hash_of_notices_to_db() {
		global $nm_current_user;
		if( isset( $_REQUEST ) ) {
			$nm_notices_hash_data = $_REQUEST['nm_notices_hash_data'];
			$nm_hash_of_read_notices = get_option('nm_hash_of_read_notices');
			$nm_hash_of_read_notices[$nm_current_user] = array_merge($nm_hash_of_read_notices[$nm_current_user], $nm_notices_hash_data);
			update_option('nm_hash_of_read_notices', $nm_hash_of_read_notices);
		}
	}
	add_action('wp_ajax_update_notification_option', 'nm_add_hash_of_notices_to_db');

	function nm_delete_data_from_wp_options_on_deactivate() {
		delete_option("nm_hash_of_read_notices");
	}
	register_deactivation_hook(__FILE__, 'nm_delete_data_from_wp_options_on_deactivate');
}