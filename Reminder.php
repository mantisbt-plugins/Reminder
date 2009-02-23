<?php
class ReminderPlugin extends MantisPlugin {
	function register() {
		$this->name        = 'Reminder';
		$this->description = 'Sends E-mail to warn for Coming Due Dates';
		$this->version     = '0.91';
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
			);
	}
}