<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
$f_reminder_days_treshold		= gpc_get_int('reminder_days_treshold',2);
$f_reminder_store_as_note		= gpc_get_int('reminder_store_as_note', OFF);
$f_reminder_sender				= gpc_get_string('reminder_sender', 'admin@nuy.info');	
$f_reminder_bug_status			= gpc_get_string('reminder_bug_status', ASSIGNED);	
$f_reminder_ignore_unset		= gpc_get_int('reminder_ignore_unset', ON);
$f_reminder_mail_subject		= gpc_get_string('reminder_mail_subject','Following issue will be Due shortly');
plugin_config_set('reminder_days_treshold'	, $f_reminder_days_treshold);			
plugin_config_set('reminder_store_as_note'	, $f_reminder_store_as_note);			
plugin_config_set('reminder_sender'			, $f_reminder_sender);				
plugin_config_set('reminder_bug_status'		, $f_reminder_bug_status);	
plugin_config_set('reminder_ignore_unset'	, $f_reminder_ignore_unset);	
plugin_config_set('reminder_mail_subject'	, $f_reminder_mail_subject);
print_successful_redirect( plugin_page( 'config',TRUE ) );