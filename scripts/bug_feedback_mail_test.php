<?php
# Make sure this script doesn't run via the webserver

# This page sends an E-mail to the REPORTER if an issue is awaiting feedback
# No real email is sent not are notes created for the various issues
#

require_once( '../../../core.php' );
$t_login	= config_get( 'plugin_Reminder_reminder_login' );

//echo "tlogion: ".$t_login."\n";

$ok=auth_attempt_script_login( $t_login );


//if ($ok) echo "ok=true\n";
//else echo "ok=false\n";

$t_core_path = config_get( 'core_path' );
///require_once( $t_core_path.'bug_api.php' );
require_once( $t_core_path.'email_api.php' );

$t_bug_table	= db_get_table( 'mantis_bug_table' );

$t_project		= config_get('plugin_Reminder_reminder_feedback_project');
$status			= config_get('plugin_Reminder_reminder_feedback_status');
$t_rem_body1	= config_get( 'plugin_Reminder_reminder_group_body1' );
$t_rem_body2	= config_get( 'plugin_Reminder_reminder_group_body2' );

if ($t_project>0){
	# $query = "select id,reporter_id,handler_id,project_id from $t_bug_table where status=$status and project_id=$project order by reporter_id";
	$query = "select id,reporter_id,handler_id,project_id from $t_bug_table where status in (".implode(",", $status).") and project_id=$t_project order by reporter_id";
} else{
	# $query = "select id,reporter_id,handler_id,project_id from $t_bug_table where status=$status order by reporter_id";
	$query = "select id,reporter_id,handler_id,project_id from $t_bug_table where status in (".implode(",", $status).") order by reporter_id";
}

echo "query: ".$query."\n <br>";

$results = db_query_bound( $query );
if ($results){
	$start = true ;
	$list= "";
	// first group and store feedback reminder per issue
	while ($row1 = db_fetch_array($results)) {
		$id 	   	= $row1['id'];
		$handler	= $row1['handler_id'];
		$project  = $row1['project_id'];
		$reporter = $row1['reporter_id'];

    echo "id: ".$id." handler_id: ".$handler." reporter_id:".$reporter." project_id: ".$project."\n<br>";

    if ($start){
			//$handler2 = $handler ;
			$reporter2 = $reporter ;
			$start = false ;
		}
		//if ($handler== $handler2){
		if ($reporter== $reporter2){
			$list .=" \n\n";
			//$list .= string_get_bug_view_url_with_fqdn( $id, $handler2 );
			$list .= string_get_bug_view_url_with_fqdn( $id, $reporter2 );
		} else {
			// now send the grouped email
			$body  = $t_rem_body1. " <br><br>\n\n";
			$body .= $list. " <br>\n\n";
			$body .= $t_rem_body2;
			//$result = email_group_reminder( $handler2, $body);
			$result = email_group_reminder( $reporter2, $body);

			//$handler2 = $handler ;
			$reporter2 = $reporter;

			//$list= string_get_bug_view_url_with_fqdn( $id, $handler2 );
			$list= string_get_bug_view_url_with_fqdn( $id, $reporter2 );
		}
		$list .=" <br>\n";
	}
	// handle last grouped email
	if ($results){
		$body  = $t_rem_body1. " \n\n";
		$body .= $list. " \n\n";
		$body .= $t_rem_body2;
		//why the handler? Feedback reminder email should go to the Reporter!
    //$result = email_group_reminder( $handler2, $body);
    $result = email_group_reminder( $reporter2, $body);
	} else {
  		echo 'Query-Manager had no results '.$query ;
	  	echo '<br>';
	}

}
if (php_sapi_name() !== 'cli'){
	echo config_get( 'plugin_Reminder_reminder_finished' );
}

# Send Grouped reminder
function email_group_reminder( $p_user_id, $issues ) {
	$t_username = user_get_field( $p_user_id, 'username' );
	$t_email = user_get_email( $p_user_id );
	$t_message = $issues ;
	$t_subject	= config_get( 'plugin_Reminder_reminder_subject' );

  if( !is_blank( $t_email ) ) {

	echo '------------------------------- <br>';
	echo $t_email;
		echo '**';
		echo $t_subject;
		echo '<br>';
		echo $t_message;
		echo '<br>';
		echo '------------------------------- <br>';

		// email_store( $t_email, $t_subject, $t_message );
		if( OFF == config_get( 'email_send_using_cronjob' ) ) {
				// email_send_all();
		}
	}
}
