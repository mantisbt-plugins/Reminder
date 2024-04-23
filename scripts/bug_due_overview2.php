<?php
# This page creates spreadsheet for those issues where the due date is getting near
# parameters
# days		=> number of days to take into account to raise warning
# status	=> Status that needs to be checked
# if not passed as parameter, default values 2,50 are being used
# extra program with the reminder plugin
# in case no due date is given, issue will be ignored
# Call script like: http://www.YourMantisHome.com/plugins/Reminder/scripts/bug_due_overview2.php?days=2&status=50
# Created by Cas Nuy http://www.nuy.info
# February 2009
$reqVar = '_' . $_SERVER['REQUEST_METHOD'];
$form_vars = $$reqVar;
$parm1= $form_vars['days'] ;
$parm2 = $form_vars['status'] ;
if (!$parm1){
	$t_rem_days		= 2;
}else{
	$t_rem_days		= $parm1;
}
if (!$parm2){
	$t_rem_status		= 50;
}else{
	$t_rem_status		= $parm2;
}

require_once( '../../../core.php' );
$t_core_path = config_get( 'core_path' );
$t_rem_hours	= config_get('plugin_Reminder_reminder_hours');
if (ON == $t_rem_hours){
	$multiply=24;
} else{
	$multiply=1;
}
$baseline=time(true)+ ($t_rem_days*$multiply*60*60);
$query="select bugs.id,summary,due_date,username,realname from {bug} bugs,{user} users where bugs.handler_id=users.id and status in (".implode(",", $t_rem_status).") and due_date>1 and due_date<=$baseline" ;

$t_rem_include	= config_get('plugin_Reminder_reminder_include');
$t_rem_projects	= "(";
$t_rem_projects	.= config_get('plugin_Reminder_reminder_project_id');
$t_rem_projects	.= ")";
if (ON==$t_rem_include){
	if (!empty( config_get( 'plugin_Reminder_reminder_project_id' ) )) {
		$query .= " and bugs.project_id IN ". $t_rem_projects;
	}
}else{
	if (!empty( config_get( 'plugin_Reminder_reminder_project_id' ) )) {
		$query .= " and bugs.project_id NOT IN ".$t_rem_projects;
	}
}

$results = db_query( $query );
if (!$results) {
	echo "Nothing to report (or version too old,no due_date field)";
	echo '<br>';
	echo $query;
	return;
} else{
# Make sure that IE can download the attachments under https.
header( 'Pragma: public' );
header( 'Content-Type: application/vnd.ms-excel' );
header( 'Content-Disposition: attachment; filename="issues_due.xls"' );
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
echo $content;
