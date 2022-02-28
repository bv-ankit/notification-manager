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

function nm_create_menu($wp_admin_bar){
	$wp_admin_bar->add_node(
		array(
			'id' => 'notification-manager',
			'parent' => 'top-secondary',
			'title' => '<div id="notification-count" style="text-align:right" class="notification-count"> Notifications </div>',
			'href' => false,
		)
	);

	$nm_temp = plugins_url()."/notification-manager/info.png";
	?>
	<div id="nm_container">
		<div id="nm_container_top">
			<button onClick='nm_menu_toggle(true)' class="nm_menu_button">Unread</button>
			<button onClick='nm_menu_toggle(false)' class="nm_menu_button">All</button>
			<button onClick='nm_menu_toggle(true)' id="mark_as_read_button"> Mark all as read </button>
		</div>
		<hr>
		<div id="nm_container_bottom">
			<div id="nm_container_unread">
				<h3> There is no notification to display </h3>
			</div>
			<div id="nm_container_all">
				<h3> There is no notification to display </h3>
			</div>
		</div>
	</div>
	<script>
	function nm_hide(){
		document.getElementById("nm_notice_alert_box").style.visibility = "hidden";
	}

	function nm_menu_toggle(nm_toggle){
		document.getElementById("nm_container_unread").style.display = nm_toggle ? "block" : "none";
		document.getElementById("nm_container_all").style.display = nm_toggle ? "none" : "block";
		document.getElementById("mark_as_read_button").style.display = nm_toggle ? "block" : "none";
	}

	</script>
	<?php
	/*animatio-n*/echo '<div id="nm_notice_alert_box" class="nm_alert_animatio"><img src="'.$nm_temp.'">New Notification Alert';
	echo '<span onclick=nm_hide()> &times </span> </div>';
}

add_action('admin_bar_menu', 'nm_create_menu', 999);

function nm_enqueue_notice_data(){
	add_option('nm_hash_of_read_notices', array());
	$nm_hash_of_read_notices = get_option('nm_hash_of_read_notices');
	wp_enqueue_style('nm_menu',plugin_dir_url(__FILE__) . 'css/nm_menu.css');
	wp_enqueue_script( 'nm_notice_data', plugin_dir_url( __FILE__ ) . 'js/nm_notice_data.js', [], false, true );
	wp_localize_script('nm_notice_data', 'nm_hash_of_read_notices', $nm_hash_of_read_notices);
}

add_action('admin_enqueue_scripts', 'nm_enqueue_notice_data');

function nm_add_hash_of_notices_to_db(){
	if(isset($_REQUEST)){
		$nm_notices_hash_data = $_REQUEST['nm_notices_hash_data'];
		$nm_hash_of_read_notices = get_option('nm_hash_of_read_notices');
		$nm_hash_of_read_notices = array_merge($nm_hash_of_read_notices, $nm_notices_hash_data);
		update_option('nm_hash_of_read_notices', $nm_hash_of_read_notices);
	}
}

add_action('wp_ajax_update_notification_option', 'nm_add_hash_of_notices_to_db');