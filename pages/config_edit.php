<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_reminder_project_id			= gpc_get_string('reminder_project_id','0');
$f_reminder_include				= gpc_get_int('reminder_include',ON);
$f_reminder_days_treshold		= gpc_get_int('reminder_days_treshold',2);
$f_reminder_store_as_note		= gpc_get_int('reminder_store_as_note', OFF);
$f_reminder_sender				= gpc_get_string('reminder_sender', 'admin@xample.com');
$f_reminder_bug_status			= gpc_get_int_array('reminder_bug_status', [ASSIGNED]);
$f_reminder_ignore_unset		= gpc_get_int('reminder_ignore_unset', ON);
$f_reminder_ignore_past 		= gpc_get_int('reminder_ignore_past', ON);
$f_reminder_mail_subject		= gpc_get_string('reminder_mail_subject','Following issue will be Due shortly');
$f_reminder_handler				= gpc_get_int('reminder_handler', ON);
$f_reminder_group_issues		= gpc_get_int('reminder_group_issues', ON);
$f_reminder_group_project		= gpc_get_int('reminder_group_project', ON);
$f_reminder_manager_overview	= gpc_get_int('reminder_manager_overview', ON);
$f_reminder_group_subject		= gpc_get_string('reminder_group_subject','Following issue will be Due shortly');
$f_reminder_group_body1			= gpc_get_string('reminder_group_body1','Please review the following issues');
$f_reminder_group_body2			= gpc_get_string('reminder_group_body2','Please do not reply to this message');
$f_reminder_feedback_status		= gpc_get_int_array('reminder_feedback_status',[FEEDBACK]);
$f_reminder_login				= gpc_get_string('reminder_login', 'admin');
$f_reminder_subject				= gpc_get_string('reminder_subject', 'Issues requiring your attention');
$f_reminder_finished			= gpc_get_string('reminder_finished', 'Finished processing your selection');
$f_reminder_hours				= gpc_get_int('reminder_hours', OFF);
$f_reminder_colsep				= gpc_get_string('reminder_colsep', ';');
$f_reminder_details				= gpc_get_int('reminder_details', OFF);

plugin_config_set('reminder_project_id'			, $f_reminder_project_id);
plugin_config_set('reminder_include'			, $f_reminder_include);
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
plugin_config_set('reminder_feedback_status'	, $f_reminder_feedback_status);
plugin_config_set('reminder_login'				, $f_reminder_login);
plugin_config_set('reminder_subject'			, $f_reminder_subject);
plugin_config_set('reminder_finished'			, $f_reminder_finished);
plugin_config_set('reminder_hours'				, $f_reminder_hours);
plugin_config_set('reminder_colsep'				, $f_reminder_colsep);
plugin_config_set('reminder_details'			, $f_reminder_details);


print_successful_redirect( plugin_page( 'config',TRUE ) );
