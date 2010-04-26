<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
html_page_top1( lang_get( 'reminder_plugin_title' ) );
html_page_top2();
print_manage_menu();
?>
<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<table align="center" class="width75" cellspacing="1">
<tr>
	<td class="form-title" colspan="3">
		<?php echo lang_get( 'reminder_plugin_title' ) . ': ' . lang_get( 'reminder_config' ) ?>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_mail_subject' ) ?>
	</td>
	<td  width="20%">
		<textarea NAME="reminder_mail_subject" rows=3 cols=50 ><?php echo plugin_config_get( 'reminder_mail_subject' )?></textarea>
	</td><td></td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_sender' ) ?>
	</td>
	<td  width="20%">
		<input type="text" name="reminder_sender" size="50" maxlength="50" value="<?php echo plugin_config_get( 'reminder_sender' )?>" >
	</td><td></td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_days_treshold' ) ?>
	</td>
	<td  width="20%">
		<input type="text" name="reminder_days_treshold" size="3" maxlength="3" value="<?php echo plugin_config_get( 'reminder_days_treshold' )?>" >
	</td><td></td>
</tr>


<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_project_name' ) ?>
	</td>
	<td width="20%">
			<select name="reminder_project_id">
			<option value="0" ><?php echo lang_get( 'all_projects' ); ?></option>
			<?php
			$t_value=plugin_config_get( 'reminder_project_id');
			print_project_option_list( $t_value, FALSE, NULL, FALSE ) ;
			?>
			</select> 
	</td>
		</td><td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_bug_status' ) ?>
	</td>
	<td width="20%">
	<?php print_status_option_list( 'reminder_bug_status',plugin_config_get( 'reminder_bug_status' ) ) ?>
	</td><td>
	</td> 
	</td>
</tr>


<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_manager_overview' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_manager_overview" value="1" <?php echo ( ON == plugin_config_get( 'reminder_manager_overview' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_manager_overview" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_manager_overview' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_handler' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_handler" value="1" <?php echo ( ON == plugin_config_get( 'reminder_handler' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_handler" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_handler' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_group_issues' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_group_issues" value="1" <?php echo ( ON == plugin_config_get( 'reminder_group_issues' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_group_issues" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_group_issues' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_group_project' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_group_project" value="1" <?php echo ( ON == plugin_config_get( 'reminder_group_project' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_group_project" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_group_project' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>


<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_ignore_unset' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_ignore_unset" value="1" <?php echo ( ON == plugin_config_get( 'reminder_ignore_unset' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_ignore_unset" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_ignore_unset' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_ignore_past' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_ignore_past" value="1" <?php echo ( ON == plugin_config_get( 'reminder_ignore_past' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_ignore_past" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_ignore_past' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category">
		<?php echo lang_get( 'reminder_store_as_note' ) ?>
	</td>
	<td class="right">
		<label><input type="radio" name="reminder_store_as_note" value="1" <?php echo ( ON == plugin_config_get( 'reminder_store_as_note' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center">
		<label><input type="radio" name="reminder_store_as_note" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_store_as_note' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>


<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_group_subject' ) ?>
	</td>
	<td  width="20%">
		<textarea NAME="reminder_group_subject" rows=3 cols=50 ><?php echo plugin_config_get( 'reminder_group_subject' )?></textarea>
	</td><td></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_group_body1' ) ?>
	</td>
	<td  width="20%">
		<textarea NAME="reminder_group_body1" rows=3 cols=50 ><?php echo plugin_config_get( 'reminder_group_body1' )?></textarea>
	</td><td></td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_group_body2' ) ?>
	</td>
	<td  width="20%">
		<textarea NAME="reminder_group_body2" rows=3 cols=50 ><?php echo plugin_config_get( 'reminder_group_body2' )?></textarea>
	</td><td></td>
</tr>

<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_feedback_project_name' ) ?>
	</td>
	<td width="20%">
			<select name="reminder_feedback_project">
			<option value="0" ><?php echo lang_get( 'all_projects' ); ?></option>
			<?php
			$t_value=plugin_config_get( 'reminder_feedback_project');
			print_project_option_list( $t_value, FALSE, NULL, FALSE ) ;
			?>
			</select> 
	</td>
		</td><td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_feedback_status' ) ?>
	</td>
	<td width="20%">
	<?php print_status_option_list( 'reminder_feedback_status',plugin_config_get( 'reminder_feedback_status' ) ) ?>
	</td><td>
	</td> 
	</td>
</tr>

<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_login' ) ?>
	</td>
	<td  width="20%">
			<input type="text" name="reminder_login" size="15" maxlength="15" value="<?php echo plugin_config_get( 'reminder_login' )?>" >
	</td><td></td>
</tr>
<tr>
	<td class="center" colspan="3">
		<input type="submit" class="button" value="<?php echo lang_get( 'reminder_update_config' ) ?>" />
	</td>
</tr>

</table>
<form>
<?php
html_page_bottom1( __FILE__ );