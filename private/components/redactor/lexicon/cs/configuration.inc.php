<?php

$_lang['redactor.configuration_set'] = 'Configuration Set';
$_lang['redactor.configuration_set_desc'] = 'Select the configuration to use. To manage configuration sets, go to Extras > Redactor Configuration.';
$_lang['redactor.configuration_sets'] = 'Configuration Sets';
$_lang['redactor.configuration_sets_desc'] = 'With Configuration Sets you can manage your Redactor Rich Text Editor. It allows you to control both its appearance and functionality. To use different configuration sets in different contexts, create the <code>redactor.configuration_set</code> context settings, providing it the ID of the set managed here.';

$_lang['redactor.id'] = 'ID';
$_lang['redactor.class_key'] = 'Type of Set';
$_lang['redactor.class_key.redConfigurationSet'] = 'Basic';
$_lang['redactor.class_key.redAdvancedConfigurationSet'] = 'Advanced';
$_lang['redactor.class_key.description'] = 'To configure Redactor you can choose between a <em>Basic</em> and <em>Advanced</em> mode. With <em>Basic</em> you will be presented with a form with the available settings, allowing you to choose or fill in the proper values. With <em>advanced</em> mode you can instead write the Redactor configuration as code, which gives a bit more flexibility but requires more knowledge about redactor.js. ';
$_lang['redactor.class_key.description_upd'] = 'To change the type of set, please duplicate the set and change the type there. When moving from Advanced to Basic you may lose certain options that Basic does not support.';
$_lang['redactor.name'] = 'Name';
$_lang['redactor.description'] = 'Description';
$_lang['redactor.usage'] = 'Used for';
$_lang['redactor.usage.system_default'] = 'System default';
$_lang['redactor.usage.context'] = 'Context "[[+key]]"';
$_lang['redactor.usage.user'] = 'User "[[+username]]"';
$_lang['redactor.usage.usergroup'] = 'User group "[[+name]]"';
$_lang['redactor.usage.tv'] = 'Template variable "[[+name]]"';
$_lang['redactor.usage.template'] = 'Template "[[+name]]"';
$_lang['redactor.usage.contentblocks'] = 'ContentBlocks field "[[+name]]"';
$_lang['redactor.usage.introtext'] = 'Resource introtext';

$_lang['redactor.manage_configuration'] = 'Manage Configuration';
$_lang['redactor.manage_configuration_desc_redConfigurationSet'] = 'On this page you can manage the configuration set. Below you\'ll find the different categories and available options, and on the right of the screen is a preview of the configuration. This updates automatically as you make changes. ';
$_lang['redactor.manage_configuration_desc_redAdvancedConfigurationSet'] = 'On this page you can manage the configuration set. Below you\'ll find the raw JavaScript configuration you can edit. <a href="https://imperavi.com/redactor/docs/">Use the Imperavi Redactor Documentation</a> for the available settings and callbacks. ';
$_lang['redactor.advanced_configuration'] = 'Advanced Configuration';
$_lang['redactor.live_preview'] = 'Live Preview';
$_lang['redactor.live_preview_desc_redConfigurationSet'] = 'On every change to the settings on the left, the preview here will update automatically.';
$_lang['redactor.live_preview_desc_redAdvancedConfigurationSet'] = 'As long as the JavaScript on the left is valid, the preview here will automatically update.';
$_lang['redactor.live_preview_error'] = '<b>Could not update preview, error thrown:</b> [[+error]]<br><br>This may indicate an error in a plugin or Redactor itself. Saving your configuration and refreshing may resolve it as well. If the problem persists, please contact support with an export of your configuration and information about your browser.';

$_lang['redactor.install_ace'] = '<b>Tip!</b> If you install the <b>Ace</b> Extra from the MODX.com package manager, the advanced configuration below will use it to provide syntax highlighting and code completion.';


$_lang['redactor.add_configuration_set'] = 'Create new Configuration Set';
$_lang['redactor.edit_configuration_set'] = 'Edit';
$_lang['redactor.delete_configuration_set'] = 'Delete';
$_lang['redactor.delete_configuration_set.confirm'] = 'Are you sure you want to delete this configuration set?';
$_lang['redactor.duplicate_configuration_set'] = 'Duplicate';
$_lang['redactor.make_default_set'] = 'Use as system default';
$_lang['redactor.make_default_set.confirm_text'] = 'This will update the <code>redactor.configuration_set</code> system setting to use <b>[[+name]]</b> as the default configuration set.';
$_lang['redactor.make_default_set.saved'] = 'Default configuration set successfully updated.';
$_lang['redactor.make_introtext_set'] = 'Use for introtext';
$_lang['redactor.make_introtext_set.confirm_text'] = 'This will update the <code>redactor.introtext.configuration_set</code> system setting to use <b>[[+name]]</b> as the configuration set for the introtext.';
$_lang['redactor.make_introtext_set.saved'] = 'Introtext configuration set successfully updated.';
$_lang['redactor.export_configuration_set'] = 'Export';
$_lang['redactor.export_configuration_sets'] = 'Export';
$_lang['redactor.import_configuration_sets'] = 'Import';
$_lang['redactor.import_configuration_sets.title'] = 'Import Configuration Sets';
$_lang['redactor.import_configuration_sets.intro'] = 'By uploading an XML file and choosing the right import mode, you can import Configuration Sets you exported before or from a different site.';


$_lang['redactor.start_import'] = 'Start Import';
$_lang['redactor.import_file'] = 'File';
$_lang['redactor.import_mode'] = 'Import Mode';
$_lang['redactor.import_mode.insert'] = 'Insert: leave existing [[+what]] and add the imported data';
$_lang['redactor.import_mode.overwrite'] = 'Overwrite: leave existing [[+what]], but overwrite them if they have the same ID';
$_lang['redactor.import_mode.replace'] = 'Replace: first remove all current [[+what]], and then import the new rows.';

$_lang['redactor.error.not_an_export'] = 'The file does not seem to be a Redactor export';
$_lang['redactor.error.importing_row'] = 'Error importing row: ';
$_lang['redactor.error.xml_not_loaded'] = 'Could not load the XML File';
$_lang['redactor.error.set_ns'] = 'No configuration set specified.';
$_lang['redactor.error.set_nf'] = 'Configuration set could not be found.';
