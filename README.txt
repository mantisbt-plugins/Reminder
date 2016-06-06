********************************************************************************
* Introduction                                                                 *
********************************************************************************

This plugin can be used to send periodic email reminders to bug reporters,
managers, and assignees.

The files in the `plugins/Reminder/scripts` directory should be run directly,
from the command line.

1. `bug_feedback_mail.php` sends emails to reporters listing all bugs awaiting
   their feedback.
2. `bug_reminder_mail.php` sends emails to assignees when bugs are approaching
   their due date.
3. `bug_reminder_unique_mail.php` do the same as script n°2 but only when the
   due date is the exact planned day (see parameter reminder_days_treshold)
4. `assigned_bugs.php` sends emails to assignees listing all open bugs that are
   assigned to them.

This plugin is build upon version 1.2.x of mantis and should be installed like
any other plugin. No Mantis scripts or tables are being create/altered.


********************************************************************************
* Installation                                                                 *
********************************************************************************

Like any other plugin.
After copying to your webserver :
- Start mantis as administrator
- Select manage
- Select manage Plugins
- Select Install near "Reminder 1.xx" (where 1.xx is the version no)
- Once installed, click on the plugin name for further configuration.

For version 1.2.x make sure to have this statement in confg_inc.php:
$g_path          = 'http://path to your mantis installation/';


********************************************************************************
* Configuration options                                                        *
********************************************************************************

// What is the body of the E-mail
reminder_mail_subject	= "Following issue will be Due shortly";

// What is the subject of the grouped E-mail
reminder_group_subject	= "You have issues approaching their Due Date";

// What is the start of the body of the grouped E-mail
reminder_groupbody1	= "Please review the following issues";

// What is the end of the body of the grouped E-mail
reminder_groupbody2	= "Please do not reply to this message";

// perform for which project
reminder_project_id = 0; // 0 means ALL

// how many days before Due date should we take into account
reminder_days_treshold  = 2;

// Should we use hours instead of days
reminder_hours		  	= OFF;

// Should we store this reminder as bugnote
reminder_store_as_note = OFF;
// only possible for handler

// For which status to send reminders
reminder_bug_status = array(ASSIGNED);

// Ignore reminders for issues with no Due date set
reminder_ignore_unset = ON;

// Ignore reminders for issues with Due dates in the past
reminder_ignore_past = ON;

// only valid for the mail function, downloads will always have duedates that have gone by

// Create overview per handler
reminder_handler = ON;

// Group issues by Handler
reminder_group_issues = ON;

// Group issues by project/handler
reminder_group_project = OFF;

// Create overview per manager/project
reminder_manager_overview = ON;
//
// access level for manager = 70
// this needs to be made flexible
// we will only produce overview for those projects that have a separate manager
//

// Select project to receive Feedback mail
reminder_feedback_project = 0; // 0 means ALL

// For which status to send feedbackreminders
reminder_bug_status = array(FEEDBACK);


********************************************************************************
* Automatically generating mail                                                *
********************************************************************************

The bug_reminder_mail script can be called via cron like this (using Lynx):
*/1440 *   *   *   * lynx --dump http://mantis.homepage.com/plugins/Reminder/scripts/bug_reminder_mail.php

or via command line interface (recommanded):
*/1440 *   *   *   * /usr/local/bin/php /path/to/mantis/plugins/Reminder/scripts/bug_reminder_mail.php

This line would send out a reminder every day until the due date.

You can also decide to run the script every day at 7a.m. and send a reminder only
if it's near the due date (see parameter reminder_days_treshold for nb of days/hours):
0 7 * * * /usr/local/bin/php /path/to/mantis/plugins/Reminder/scripts/bug_reminder_unique_mail.php

You also can use a scheduled task under windows by calling a batch-file like:

REM *** this batch is running as a scheduled task under the ... Account ***
g:
cd \inetpub\wwwroot\mantis
php.exe plugins/Reminder/scripts/bug_reminder_mail.php

One can also schedule a job to prompt reporters to respond because their
issue has status Feedback. In that case replace bug_reminder_mail.php with
bug_feedback_mail.php


********************************************************************************
* Extras                                                                       *
********************************************************************************

On top of that, I have created a little variant which will create a
spreadsheet with issues getting due. Call script like:

http://www.YourMantisHome.com/plugins/Reminder/scripts/bug_due_overview2.php?days=2&status=50

If you do not apply parameters, the script will default to the above.

In the script directory you will also find a script called
bug_reminder_mail_test.php. This script which you should call from within the
browser (once logged on) will provide useful feedback if things are not
working as expected. In case of a blank screen, all is processed normally.

You can also use the test script named bug_reminder_unique_mail_test.php to test
the unique reminder feature.

For option Days/Hours, the script will fetch the plugin definition.


********************************************************************************
* License                                                                      *
********************************************************************************

This plugin is distributed under the same conditions as Mantis itself (GPL).


********************************************************************************
* Bug reporting                                                                *
********************************************************************************

Main issue: http://www.mantisbt.org/bugs/view.php?id=10153

Log new issues against the [Plugin - Reminder] project on mantisbt.org's tracker:
http://www.mantisbt.org/bugs/view_all_bug_page.php?project_id=7

This code is available on github: https://github.com/mantisbt-plugins/Reminder


********************************************************************************
* Thanks                                                                       *
********************************************************************************

Mark Ziegler	German translation	May 2010


********************************************************************************
* Greetings                                                                    *
********************************************************************************

Cas Nuy
cas@nuy.info
http://www.nuy.info