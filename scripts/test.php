<?php
echo "Starting program";
echo "<br>";

$query = "select * from ";
$t_rem_include	= ON;
$t_rem_projects	= "(1,3)";
if (ON == $t_rem_include){
	if (!empty( config_get( 'plugin_Reminder_reminder_project_id' ) )) {
		$query .= ' and project_id IN $t_rem_projects';
	}
}else{
	$query .= 'and project_id NOT IN $t_rem_projects';
}
echo $query;
