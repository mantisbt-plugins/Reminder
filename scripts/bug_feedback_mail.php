<?php
# This page sends an E-mail to the reporter if an issue is awaiting feedback
require_once( '/../../../core.php' );
$t_login	= config_get( 'plugin_Reminder_reminder_login' );
$ok=auth_attempt_script_login( $t_login ); 
$t_core_path = config_get( 'core_path' );
///require_once( $t_core_path.'bug_api.php' );
require_once( $t_core_path.'email_api.php' );

$t_bug_table	= db_get_table( 'mantis_bug_table' );
// next 2 lines to be made variable
$t_rem_body1 = 'The following issue(s) are awaiting your input';
$t_rem_body2 = 'Please do not reply to this message, use the helpdesk system itself';

$t_project		= config_get('plugin_Reminder_reminder_feedback_project');
$status			= config_get('plugin_Reminder_reminder_feedback_status');

if ($project>0){
	$query = "select id,reporter_id,project_id from $t_bug_table where status=$status and project_id=$project order by reporter_id";
} else{
	$query = "select id,reporter_id,project_id from $t_bug_table where status=$status order by reporter_id";
}
$results = mysql_query( $query );
if ($results){
	$start = true ;
	$list= "";
	// first group and store reminder per issue
	while ($row1 = mysql_fetch_array($results, MYSQL_NUM)) {
		$id 		= $row1[0];
		$handler	= $row1[1];
		$project	= $row1[2];
		if ($start){
			$handler2 = $handler ;
			$start = false ;
		}
		if ($handler== $handler2){
			$list .=" \n\n"; 
			$list .= string_get_bug_view_url_with_fqdn( $id, $handler2 );
		} else {
			// now send the grouped email
			$body  = $t_rem_body1. " \n\n";
			$body .= $list. " \n\n";
			$body .= $t_rem_body2;
			$result = email_group_reminder( $handler2, $body);
			$handler2 = $handler ;
			$list= string_get_bug_view_url_with_fqdn( $id, $handler2 );
		}
	}
	// handle last grouped email
	if ($results){
		$body  = $t_rem_body1. " \n\n";
		$body .= $list. " \n\n";
		$body .= $t_rem_body2;
		$result = email_group_reminder( $handler2, $body);
	}
} 
# Send Grouped reminder
function email_group_reminder( $p_user_id, $issues ) {
	$t_username = user_get_field( $p_user_id, 'username' );
	$t_email = user_get_email( $p_user_id );
	$t_message = $issues ;
// next line to be made variable
	$t_subject   = 'Issues requiring your attention';
	if( !is_blank( $t_email ) ) {
		email_store( $t_email, $t_subject, $t_message );
		if( OFF == config_get( 'email_send_using_cronjob' ) ) {
				email_send_all();
		}
	}
}