<?php
# This page creates spreadsheet for those issues where the due date is getting near
# parameters
# days		=> number of days to take into account to raise warning
# status	=> Status that needs to be checked
# if not passed as parameter, default values 2,50 are being used
# extra program with the reminder plugin
# in case no due date is given, issue will be ignored
# Call script like: http://www.YourMantisHome.com/bug_due_overview.php?days=2&status=50
# Created by Cas Nuy http://www.nuy.info
# February 2009
$reqVar = '_' . $_SERVER['REQUEST_METHOD'];
$form_vars = $$reqVar;
$parm1= $form_vars['days'] ;
$parm2 $form_vars['status'] ;
if (!parm1){
	$t_rem_days		= 2;
}else{
	$t_rem_days		= $parm1;
}
if (!parm2){
	$t_rem_status		= 50;
}else{
	$t_rem_status		= $parm2;
}
require_once( 'core.php' );
$t_core_path = config_get( 'core_path' );
$t_bug_table	= db_get_table( 'mantis_bug_table' );
$t_user_table	= db_get_table( 'mantis_user_table' );
$query="select id,summary,due_date,username,realname from $t_bug_table,$t_user_table where $t_bug_table.handler_id=$t_user_table.id and YEAR(due_date)<>1970 and status=$t_rem_status and CURDATE()+$t_rem_days>=due_date" ;
$results = mysql_query( $query );
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
while ($row1 = mysql_fetch_array($results, MYSQL_NUM)) {
	$id 		= $row1[0];
	$summary	= $row1[1];
	$duedate	= $row1[2];
	$assigned	= $row1[3];
	$name		= $row1[4];
	$content .= $id ;
	$content .= "," ;
	$content .= $summary ;
	$content .= "," ;
	$content .= $assigned ;
	$content .= "," ;
	$content .= $name ;
	$content .= "\r\n";
}
header('Content-type: text/richtext');
header  ("Content-type:  application/csv\nContent-Disposition:  \"inline;  filename=Issues_due.csv\"");
echo $content;
?>