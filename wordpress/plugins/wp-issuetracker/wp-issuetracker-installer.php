<?php
function it_install() {
	global $wpdb;

	$main_table = $wpdb->prefix . "it_tracker";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "CREATE TABLE " . $main_table . " (
				id int(3) NOT NULL AUTO_INCREMENT,
				UNIQUE KEY id (id)
			);";
	dbDelta($sql);
	
	$sql = "CREATE TABLE {$wpdb->prefix}it_issue (
				issue_id int(11) NOT NULL AUTO_INCREMENT,
				issue_tracker int(3),
				issue_summary varchar(256),
				issue_type int(3),
				issue_status int(3),
				issue_description text,
				issue_assignee int(11) default 0,
				issue_reporter int(11),
				issue_time int(11),
				UNIQUE KEY issue_id (issue_id)
			);";
	dbDelta($sql);
	
	$sql = "CREATE TABLE {$wpdb->prefix}it_type (
				type_id int(3) NOT NULL AUTO_INCREMENT,
				type_tracker int(3),
				type_name varchar(64),
				type_colour varchar(6),
				type_order int(3),
				UNIQUE KEY type_id (type_id)
			);";
	dbDelta($sql);
	
	$sql = "CREATE TABLE {$wpdb->prefix}it_status (
				status_id int(3) NOT NULL AUTO_INCREMENT,
				status_tracker int(3),
				status_name varchar(64),
				status_colour varchar(6),
				status_strike int(1),
				status_order int(3),
				UNIQUE KEY status_id (status_id)
			);";
	dbDelta($sql);
	
	$sql = "CREATE TABLE {$wpdb->prefix}it_comment (
				comment_id int(11) NOT NULL AUTO_INCREMENT,
				comment_issue int(11),
				comment_poster int(11),
				comment_body text,
				comment_time int(11),
				UNIQUE KEY comment_id (comment_id)
			);";
	dbDelta($sql);
	
	$sql = "CREATE TABLE {$wpdb->prefix}it_starred (
				user_id int(11),
				issue_id int(11)
			);";
	dbDelta($sql);
	
	$installed = $wpdb->get_var("SELECT COUNT(*) FROM $main_table");
	if (!$installed) {
		/* default tracker */
		$wpdb->insert( $main_table, array('id' => 1) );

		/* types */
		$wpdb->insert("{$wpdb->prefix}it_type", array('type_name' => 'Bug', 'type_colour' => 'FFB4AD', 'type_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_type", array('type_name' => 'New Feature', 'type_colour' => 'E1FFDF', 'type_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_type", array('type_name' => 'Improvement', 'type_colour' => 'FFFFCF', 'type_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_type", array('type_name' => 'Feedback', 'type_colour' => 'E5D4E7', 'type_tracker' => 1));

		/* statuses */
		$wpdb->insert("{$wpdb->prefix}it_status", array('status_name' => 'Assigned', 
																				'status_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_status", array('status_name' => 'Resolved', 
							'status_strike' => 1, 'status_colour' => 'B8EFB3', 'status_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_status", array('status_name' => 'Won\'t Fix', 
							'status_strike' => 1, 'status_colour' => 'FFB4AD', 'status_tracker' => 1));
		$wpdb->insert("{$wpdb->prefix}it_status", array('status_name' => 'Duplicate', 
							'status_strike' => 1, 								'status_tracker' => 1));
	}
}

