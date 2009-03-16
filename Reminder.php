<?php
class ReminderPlugin extends MantisPlugin {
	function register() {
		$this->name        = 'Reminder';
		$this->description = 'Sends E-mail to warn for Coming Due Dates';
		$this->version     = '1.00';
		$this->requires    = array('MantisCore'       => '1.2.0',);
		$this->author      = 'Cas Nuy';
		$this->contact     = 'Cas-at-nuy.info';
		$this->url         = 'http://www.nuy.info';
		$this->page			= 'config';
	}

 	/*** Default plugin configuration.	 */
	function config() {
		return array(
			'reminder_mail_subject'			=> 'Following issue will be Due shortly' ,
			'reminder_days_treshold'		=> 2,
			'reminder_store_as_note'		=> OFF,
			'reminder_sender'				=> 'Admin@nuy.info',
			'reminder_bug_status'			=> ASSIGNED,
			'reminder_ignore_unset'			=> ON,
			'reminder_handler'				=> ON,
			'reminder_group_issues'			=> ON,
			'reminder_group_project'		=> OFF,
			'reminder_manager_overview'		=> ON,
			'reminder_group_subject'		=> "You have issues approaching their Due Date",
			'reminder_group_body1'			=> "Please review the following issues",
			'reminder_group_body2'			=> "Please do not reply to this message",
			'reminder_project_id'			=> 0,
			);
	}
}

