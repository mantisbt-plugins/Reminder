<?php
# This page creates spreadsheet for those issues where the due date is getting near
# parameters
# days		=> number of days to take into account to raise warning
# status	=> Status that needs to be checked
# if not passed as parameter, default values 2,50 are being used
# extra program with the reminder plugin
# in case no due date is given, issue will be ignored
/*  http://www.YourMantisHome.com/plugin.php?page=Reminder/bug_due_overview.php */
# Created by Cas Nuy http://www.nuy.info
# February 2009
$t_rem_days		= plugin_config_get('reminder_days_treshold');
$t_rem_status	= plugin_config_get('reminder_bug_status');
$t_rem_hours	= plugin_config_get('reminder_hours');
if (ON == $t_rem_hours){
	$multiply=24;
} else{
	$multiply=1;
}
require_once( 'core.php' );
$t_core_path = config_get( 'core_path' );
$t_bug_table	= db_get_table( 'mantis_bug_table' );
$t_user_table	= db_get_table( 'mantis_user_table' );
$baseline=time(true)+ ($t_rem_days*$multiply*60*60);
$query="select $t_bug_table.id,summary,due_date,username,realname from $t_bug_table,$t_user_table where $t_bug_table.handler_id=$t_user_table.id and  status=$t_rem_status and due_date>1 and due_date<=$baseline" ;
$results = db_query_bound( $query );
if (!$results) {
	echo "Nothing to report (or version too old,no due_date field)";
	return;
} else{
	$content = "Issue-id" ;
	$content .= "," ;
	$content .= "Summary" ;
	$content .= "," ;
	$content .= "Due date" ;
	$content .= "," ;
	$content .= "Assigned to" ;
	$content .= "," ;
	$content .= "Name" ;
	$content .= "\r\n";
}
while ($row1 = db_fetch_array($results)) {
	$id 		= $row1['id'];
	$summary	= $row1['summary'];
	$duedate	= date( config_get( 'short_date_format' ),$row1['due_date'] );
	$assigned	= $row1['username'];
	$name		= $row1['realname'];
	$content .= $id ;
	$content .= "," ;
	$content .= $summary ;
	$content .= "," ;
	$content .= $duedate ;
	$content .= "," ;
	$content .= $assigned ;
	$content .= "," ;
	$content .= $name ;
	$content .= "\r\n";
}
# Make sure that IE can download the attachments under https.
header( 'Pragma: public' );
header( 'Content-Type: application/vnd.ms-excel' );
header( 'Content-Disposition: attachment; filename="issues_due.xls"' );
echo $content;