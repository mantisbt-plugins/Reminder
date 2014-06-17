<?php
/**
 * This script sends reminder emails to assignees of all open bugs.
 *
 * @category Reminder plugin
 * @since 1.23
 * @license http://www.gnu.org/licenses/gpl.html GPL
 * @author Sam Wilson <sam@samwilson.id.au>
 */

# Make sure this script doesn't run via the webserver
if( php_sapi_name() != 'cli' ) {
    echo "This script must be run from the command line.\n";
    exit( 1 );
}

# Set up environment
require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . DIRECTORY_SEPARATOR . 'core.php' );
$t_login = config_get( 'plugin_Reminder_reminder_login' );
auth_attempt_script_login( $t_login );
$t_core_path = config_get( 'core_path' );
require_once( $t_core_path.'email_api.php' );

# Build and bind query
$t_bug_table = db_get_table( 'mantis_bug_table' );
$t_user_table = db_get_table( 'mantis_user_table' );
$t_resolved = config_get( 'bug_resolved_status_threshold' );
$query = "SELECT DISTINCT b.id bug_id, b.summary, b.handler_id, u.realname, u.email "
	." FROM $t_bug_table b JOIN $t_user_table u ON (b.handler_id = u.id) "
	." WHERE status < ".db_param();
$results = db_query_bound( $query, array($t_resolved) );
if ( ! $results) {
	echo 'Query failed.';
	exit( 1 );
}

# Loop through all assigned bugs, building a list of what to email
$emails = array();
while ($row = db_fetch_array($results)) {

	# New recipient
	if ( ! isset($emails[$row['handler_id']])) {
		$emails[$row['handler_id']] = array(
			'recipient' => array(
				'email' => $row['email'],
				'name' => $row['realname'],
			),
			'bugs' => array(),
		);
	}

	# Add current bug to this recipient's list
	$emails[$row['handler_id']]['bugs'][$row['bug_id']] = $row['summary'];

}

# Construct and send emails
foreach ($emails as $email) {

	# Build list of issues with summary and link
	$list = '';
	foreach ($email['bugs'] as $bug_id => $summary) {
		$url = string_get_bug_view_url_with_fqdn( $bug_id );
		$list .= "  * $summary\n    $url\n";
	}

	# Queue email for sending (and send it, if cron sending is disabled)
	$message = "Assigned to ".$email['recipient']['name'].":\n\n$list\n";
	$subject= config_get( 'plugin_Reminder_reminder_subject' );
	email_store( $email['recipient']['email'], $subject, $message );
	if( OFF == config_get( 'email_send_using_cronjob' ) ) {
		email_send_all();
	}

}

