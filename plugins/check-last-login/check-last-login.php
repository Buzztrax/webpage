<?php
/*
Plugin Name: Check Last Login
Plugin URI: http://www.techforum.sk/
Description: Checks user's login status
Version: 0.6
Author: Ján Bočínec
Author URI: http://johnnypea.wp.sk/
License: GPL2
*/

function check_last_login_menu() {
  	add_submenu_page('options-general.php', 'Check Last Login', 'Check Last Login', 'manage_options', 'check-last-login', 'check_last_login_page' );

	//call register settings function
	add_action( 'admin_init', 'register_cll_settings' );
}
add_action('admin_menu', 'check_last_login_menu');

function register_cll_settings() {
	//register settings
	register_setting( 'cll-group', 'allow_deletion' );
	register_setting( 'cll-group', 'inactive_days' );

}

function check_last_login_page() { ?>
		<div class="wrap"><h1>Check Last Login Settings</h1>
		<form method="post" action="options.php">
		<?php settings_fields( 'cll-group' ); ?>
		<table class="form-table">		
		<tr>
		<td width="30%" valign="middle"><strong>Allow the automatic user deletion</strong></td>
		<td width="70%"><input type="checkbox" name="allow_deletion" value="1" <?php if ( get_option('allow_deletion') ) echo 'checked="checked"'; ?> /></td>
		</tr>
		<?php
		if ( get_option('allow_deletion') ) {
			?>
			<tr>
			<td width="30%" valign="middle"><strong>Number of inactive days after the registration</strong></td>
			<td width="70%"><input type="text" size="1" name="inactive_days" value="<?php if ( get_option('inactive_days') ) { echo get_option('inactive_days');}else{ echo 30; } ?>" /></td>
			</tr>	
			<?php
		}
		?>
		</table>
		<p class="submit">
	    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	    </p>	
		</form></div>
<?php }


add_action('cll_cron_daily_event', 'cll_is_user_active');

if ( !wp_next_scheduled('cll_cron_daily_event') && get_option('allow_deletion') ) {
	wp_schedule_event( time(), 'daily', 'cll_cron_daily_event' );
}

if ( wp_next_scheduled('cll_cron_daily_event') && !get_option('allow_deletion') ) {
	wp_clear_scheduled_hook('cll_cron_daily_event');
}

function cll_cron_deactivation() {
	wp_clear_scheduled_hook('cll_cron_daily_event');
}
register_deactivation_hook(__FILE__, 'cll_cron_deactivation');

function cll_registration_login($user_ID) {
	update_user_meta( $user_ID, 'last_user_login', 'No login' );
}
add_action('user_register', 'cll_registration_login');

function cll_last_user_login($login) {
    $user = get_userdatabylogin($login);
    update_user_meta( $user->ID, 'last_user_login', time() );
}
add_action('wp_login','cll_last_user_login');

function cll_is_user_active() {
	global $wpdb;
	
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	
	$inactive_days = ( get_option('inactive_days') ) ? get_option('inactive_days') : 30;
	$last_user_login = $wpdb->get_results("SELECT * FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ID = user_id WHERE meta_key  = 'last_user_login' AND meta_value = 'No login' AND DATEDIFF(NOW(),user_registered) >= $inactive_days", ARRAY_A);
	
	if ( $last_user_login )
		foreach ( $last_user_login as $user_login )
			wp_delete_user( $user_login['ID'] );	
}

function cll_users_manage_columns( $empty, $column_name, $userid) {
	$user_data = get_userdata( $userid );
	if ( $column_name == 'registration_date' ) {
		return date( "j.n. Y G:i", strtotime($user_data->user_registered) );
	} elseif( $column_name == 'last_user_login' ) {
		$last_user_login = get_user_meta( $userid, 'last_user_login', TRUE );
		if ( ($last_user_login && $last_user_login == 'No login') || !$last_user_login ) {
			return 'No login';
		} elseif ( $last_user_login ) {
			return date( "j.n. Y G:i", $last_user_login );
		}
	}
}
add_filter( 'manage_users_custom_column', 'cll_users_manage_columns', 10, 3);

function cll_users_edit_columns($columns) {
		$columns['registration_date'] = 'Registered';
		$columns['last_user_login'] = 'Last log in';
		return $columns;
}
// add custom columns
add_filter( 'manage_users_columns', 'cll_users_edit_columns');