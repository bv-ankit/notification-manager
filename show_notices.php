<?php
/*
Plugin Name: Notices Plugin
Description: A Plugin showing notices
Version: 1.0.0
*/


//Type 1
function display_admin_notice_1() {
	?>
	<div class="notice notice-success">
		<p>Hello!!</p>
	</div>
	<?php
}
add_action('admin_notices', 'display_admin_notice_1');


//Type 2
function display_admin_notice_2() {
	?>
	<div class="notice notice-success is-dismissible">
		<p>This is dismissible</p>
	</div>
	<?php
}
add_action('admin_notices', 'display_admin_notice_2');


//Type 3 
echo '<div class="notice notice-success is-dismissible">';
echo '<p>Echoing!!</p>';
echo '</div>';


//Type 4: One-Off Admin Notice - Timer Based
function set_admin_notice_transient() {
	set_transient('admin-notice-transient', true, 15);
	
}
register_activation_hook(__FILE__, 'set_admin_notice_transient' );

function display_admin_notice_4(){
	if( get_transient( 'admin-notice-transient' ) ) {
		?>
		<div class="notice notice-success">
			<p>This is transient</p>
		</div>
		<?php
	}
	//delete_transient( 'admin-notice-transient' );
}
add_action('admin_notices', 'display_admin_notice_4');


//Type 5: Admin Notice Counter - Counter Based
function display_admin_notice_5() {
	$counter = get_option( 'admin_notice_counter', 1 );
	if ($counter > 100 ) {
		return;
	}
	?>
	<div class="notice notice-success">
		<p>This is counter having number <?php echo $counter ?></p>
	</div>
	<?php
	update_option( 'admin_notice_counter', ++$counter );
}
add_action('admin_notices', 'display_admin_notice_5');


//Type 6: Sticky Admin Notice
add_action('admin_enqueue_scripts', 'enqueue_scripts' );
function enqueue_scripts() {
	wp_enqueue_script( 'show_notice_js', plugin_dir_url( __FILE__ ) . 'js/show_notices.js' );
}

function create_custom_option() {
	update_option( 'notice-dismis_permanent', true );
}
register_activation_hook( __FILE__, 'create_custom_option' );

function display_dismissible_admin_notice() {
	update_option( 'notice-dismis_permanent', false );
	wp_die();
}
function display_admin_notice_6() {
	$display_status = get_option( 'notice-dismis_permanent' );
	if ( $display_status ) {
		?>
		<div id="sticky_an", class="notice notice-success is-dismissible">
			<p>This is one-time showing notice. Dismis me!</p>
		</div>	
		<?php
	}
}
add_action( 'wp_ajax_display_dismissible_admin_notice', 'display_dismissible_admin_notice' );
add_action( 'admin_notices', 'display_admin_notice_6' );



?>

