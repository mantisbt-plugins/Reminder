<?php
/*  http://localhost/apps/m120/plugin.php?page=Reminder/bug_reminder_mail.php */
# This page sends an E-mail if a due date is getting near
require_once( 'core.php' );
$t_core_path = config_get( 'core_path' );
require_once( $t_core_path.'bug_api.php' );
require_once( $t_core_path.'email_api.php' );
require_once( $t_core_path.'bugnote_api.php' );
	
$t_bug_table	= db_get_table( 'mantis_bug_table' );
$t_rem_days		= plugin_config_get( 'reminder_days_treshold' );
$t_rem_status	= plugin_config_get( 'reminder_bug_status' );
$t_rem_body		= plugin_config_get( 'reminder_mail_subject' );
$t_rem_store	= plugin_config_get( 'reminder_store_as_note' );
$t_rem_ignore	= plugin_config_get( 'reminder_ignore_unset' );
$t_rem_sender	= plugin_config_get( 'reminder_sender' );

if ( ON == $t_rem_ignore ) {
	$query="select id,handler_id from $t_bug_table where YEAR(due_date)<>1970 and status=$t_rem_status and CURDATE()+$t_rem_days>=due_date" ;
}else{
	$query="select id,handler_id from $t_bug_table where status=$t_rem_status and CURDATE()+$t_rem_days>=due_date" ;
}
$results = mysql_query( $query );
if (!$results) {
	return;
}
while ($row1 = mysql_fetch_array($results, MYSQL_NUM)) {
	$id 		= $row1[0];
	$handler	= $row1[1];
	$result = email_bug_reminder( $handler, $id, $t_rem_body );
	# Add reminder as bugnote if store reminders option is ON.
	if ( ON == $t_rem_store ) {
		$t_attr = '|' . $handler . '|';
		bugnote_add( $id, $t_rem_body, 0, config_get( 'default_reminder_view_status' ) == VS_PRIVATE, REMINDER, $t_attr, NULL, FALSE );
	}
}
?>