<?php
auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );
layout_page_header( lang_get( 'reminder_plugin_title' ) );
layout_page_begin( 'config_page.php' );
print_manage_menu();

function reminder_check_selected( $p_var, $p_val = true ) {
	if( is_array( $p_var ) ) {
		foreach( $p_var as $t_this_var ) {

			# catch the case where one entry is 0 and the other is a string.
			if( is_string( $t_this_var ) && is_string( $p_val ) ) {
				if( $t_this_var === $p_val ) {
					echo ' selected="selected" ';
					return;
				}
			}
			else if ( is_array( $p_val ) ) {
			     	foreach( $p_val as $t_this_val ) {
					if( $t_this_var == $t_this_val ) {
					        echo ' selected="selected" ';
						return;
					}
				}
			}
			else if( $t_this_var == $p_val ) {
				echo ' selected="selected" ';
				return;
			}
		}
	} else {
		if( is_string( $p_var ) && is_string( $p_val ) ) {
			if( $p_var === $p_val ) {
				echo ' selected="selected" ';
				return;
			}
		}
		else if( $p_var == $p_val ) {
			echo ' selected="selected" ';
			return;
		}
	}
}

function reminder_print_status_option_list( $p_name ) {
	$t_enum_values = MantisEnum::getValues( config_get( 'status_enum_string' ) );
	$t_selection = plugin_config_get($p_name);
	echo '<select name="' . $p_name . '[]" multiple="multiple" size="' . count($t_enum_values) . '">';
	foreach ( $t_enum_values as $t_key ) {
		$t_elem2 = get_enum_element( 'status', $t_key );

		echo '<option value="' . $t_key . '"';
		reminder_check_selected( $t_selection, $t_key );
		echo '>' . $t_elem2 . '</option>';
	}
	echo '</select>';
}

?>
<div class="col-md-12 col-xs-12">
<div class="space-10"></div>
<div class="form-container" > 
<br/>
<form action="<?php echo plugin_page( 'config_edit' ) ?>" method="post">
<div class="widget-box widget-color-blue2">
<div class="widget-header widget-header-small">
	<h4 class="widget-title lighter">
		<i class="ace-icon fa fa-text-width"></i>
		<?php echo lang_get( 'reminder_plugin_title' ) . ': ' . lang_get( 'plugin_format_config' )?>
	</h4>
</div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="table-responsive"> 
<table class="table table-bordered table-condensed table-striped"> 
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

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_hours' ) ?>
	</td>
	<td class="right" width="20%">
		<label><input type="radio" name="reminder_hours" value="1" <?php echo ( ON == plugin_config_get( 'reminder_hours' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name="reminder_hours" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_hours' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_include' ) ?>
	</td>
	<td class="right" width="20%">
		<label><input type="radio" name="reminder_include" value="1" <?php echo ( ON == plugin_config_get( 'reminder_include' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_enabled' ) ?></label>
	</td>
	<td class="center" width="20%">
		<label><input type="radio" name="reminder_include" value="0" <?php echo ( OFF == plugin_config_get( 'reminder_include' ) ) ? 'checked="checked" ' : ''?>/>
			<?php echo lang_get( 'reminder_store_disabled' ) ?></label>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_project_name' ) ?>
	</td>
		<td  width="20%">
			<input type="text" name="reminder_project_id" size="50" maxlength="50" value="<?php echo plugin_config_get( 'reminder_project_id' )?>" >
	</td>
	</td><td>
</tr>

<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_bug_status' ) ?>
	</td>
	<td width="20%">
	<?php reminder_print_status_option_list('reminder_bug_status') ?>
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
	<td class="form-title" colspan="3">
	<?php echo lang_get( 'reminder_feedback_email' ) ?>  
	</td>
</tr>	


<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_feedback_status' ) ?>
	</td>
	<td width="20%">
	<?php reminder_print_status_option_list('reminder_feedback_status')?>
	</td><td>
	</td> 
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_subject' ) ?>
	</td>
	<td  width="20%">
			<input type="text" name="reminder_subject" size="50" maxlength="50" value="<?php echo plugin_config_get( 'reminder_subject' )?>" >
	</td>
	<td></td>
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
<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_finished' ) ?>
	</td>
	<td  width="20%">
			<input type="text" name="reminder_finished" size="50" maxlength="50" value="<?php echo plugin_config_get( 'reminder_finished' )?>" >
	</td><td></td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="form-title" colspan="3">
	<?php echo lang_get( 'reminder_export_settings' ) ?>  
	</td>
</tr>
<tr <?php echo helper_alternate_class() ?>>
	<td class="category" width="60%">
		<?php echo lang_get( 'reminder_export_colsep' ) ?>
	</td>
	<td  width="20%">
			<input type="text" name="reminder_colsep" size="50" maxlength="1" value="<?php echo plugin_config_get( 'reminder_colsep' )?>" >
	</td><td></td>
</tr>

</table>
</div>
</div>
<div class="widget-toolbox padding-8 clearfix">
	<input type="submit" class="btn btn-primary btn-white btn-round" value="<?php echo lang_get( 'change_configuration' )?>" />
</div>
</div>
</div>
</form>
</div>
</div>
 
<?php
layout_page_end();