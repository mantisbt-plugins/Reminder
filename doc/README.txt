We are using Due dates very heavily in our environment.
In order to stay current and achieve a high percentage On time resolving, I wanted my developers to be informed about forthcoming Due dates.

This plugin is build upon version 1.2.x of mantis and should be installed as any other plugin
No Mantis scripts or tables are being altered.

The following config options are available:

// What is the body of the E-mail
reminder_mail_subject	= "Following issue will be Due shortly";

// how many days before Due date should we take into account
reminder_days_treshold  = 2;

// Should we store this reminder as bugnote
reminder_store_as_note = OFF;

// For which status to send reminders
reminder_bug_status = ASSIGNED

// Ignore reminders for issues with no Due date set
reminder_ignore_unset = ON

After this, bug_reminder_mail can be used via cron like this:
*/1440 *   *   *   * lynx --dump http://mantis.homepage.com/plugin.php?page=Reminder/bug_reminder_mail.php

or via command line interface
*/1440 *   *   *   * /usr/local/bin/php /path/to/mantis/plugin.php?page=Reminder/bug_reminder_mail.php

This line would send out a reminder every day. 


You also can use a scheduled task under windows by calling a batch-file like:
REM *** this batch is running as a scheduled task under the ... Account ***
g:
cd \inetpub\wwwroot\mantis
php.exe plugin.php?page=Reminder/bug_reminder_mail.php

This addon is distributed under the same conditions as Mantis itself.

Cas Nuy February 2009