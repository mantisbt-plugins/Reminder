<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_reminder_project_id			= gpc_get_int('reminder_project_id',0);
$f_reminder_days_treshold		= gpc_get_int('reminder_days_treshold',2);
$f_reminder_store_as_note		= gpc_get_int('reminder_store_as_note', OFF);
$f_reminder_sender				= gpc_get_string('reminder_sender', 'admin@nuy.info');	
$f_reminder_bug_status			= gpc_get_string('reminder_bug_status', ASSIGNED);	
$f_reminder_ignore_unset		= gpc_get_int('reminder_ignore_unset', ON);
$f_reminder_ignore_past 		= gpc_get_int('reminder_ignore_past', ON);
$f_reminder_mail_subject		= gpc_get_string('reminder_mail_subject','Following issue will be Due shortly');
$f_reminder_handler				= gpc_get_int('reminder_handler', ON);
$f_reminder_group_issues		= gpc_get_int('reminder_group_issues', ON);
$f_reminder_group_project       = gpc_get_int('reminder_group_project', ON);	
$f_reminder_manager_overview	= gpc_get_int('reminder_manager_overview', ON);		
$f_reminder_group_subject		= gpc_get_string('reminder_group_subject','Following issue will be Due shortly');
$f_reminder_group_body1			= gpc_get_string('reminder_group_body1','Please review the following issues');
$f_reminder_group_body2			= gpc_get_string('reminder_group_body2','Please do not reply to this message');
$f_reminder_feedback_project	= gpc_get_int('reminder_feedback_project',0);
$f_reminder_feedback_status		= gpc_get_int('reminder_feedback_status',FEEDBACK);

plugin_config_set('reminder_project)id'			, $f_reminder_project_id);	
plugin_config_set('reminder_days_treshold'		, $f_reminder_days_treshold);			
plugin_config_set('reminder_store_as_note'		, $f_reminder_store_as_note);			
plugin_config_set('reminder_sender'				, $f_reminder_sender);				
plugin_config_set('reminder_bug_status'			, $f_reminder_bug_status);	
plugin_config_set('reminder_ignore_unset'		, $f_reminder_ignore_unset);	
plugin_config_set('reminder_ignore_past'		, $f_reminder_ignore_past);	
plugin_config_set('reminder_mail_subject'		, $f_reminder_mail_subject);
plugin_config_set('reminder_handler'			, $f_reminder_handler	);
plugin_config_set('reminder_group_issues'		, $f_reminder_group_issues);
plugin_config_set('reminder_group_project'		, $f_reminder_group_project);	
plugin_config_set('reminder_manager_overview'	, $f_reminder_manager_overview);	
plugin_config_set('reminder_group_subject'		, $f_reminder_group_subject);	
plugin_config_set('reminder_group_body1'		, $f_reminder_group_body1);	
plugin_config_set('reminder_group_body2'		, $f_reminder_group_body2);	

print_successful_redirect( plugin_page( 'config',TRUE ) );