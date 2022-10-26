<?php
/**
 * Default Lexicon Entries
 *
 * @package consentfriend
 * @subpackage lexicon
 */

$_lang['consentfriend'] = 'ConsentFriend';

$_lang['consentfriend.menu_home'] = 'ConsentFriend';
$_lang['consentfriend.menu_home_desc'] = 'MODX consent management platform';

$_lang['consentfriend.services'] = 'Services';
$_lang['consentfriend.services_desc'] = 'Create and modify your ConsentFriend services.';
$_lang['consentfriend.services_tab_callbacks'] = 'Callbacks';
$_lang['consentfriend.services_tab_code'] = 'Code';
$_lang['consentfriend.services_tab_cookies'] = 'Cookies';
$_lang['consentfriend.services_tab_on_accept'] = 'On Accept';
$_lang['consentfriend.services_tab_on_decline'] = 'On Decline';
$_lang['consentfriend.services_tab_on_init'] = 'On Init';
$_lang['consentfriend.services_tab_on_toggle'] = 'On Toggle';
$_lang['consentfriend.services_tab_service'] = 'Service';

$_lang['consentfriend.service_active'] = 'Active';
$_lang['consentfriend.service_active_desc'] = 'If "active" is checked, the service is shown in the consent management window.';
$_lang['consentfriend.service_callback'] = 'Callback';
$_lang['consentfriend.service_on_toggle_desc'] = 'The callback code, thats executed during changing the service consent.';
$_lang['consentfriend.service_code'] = 'Code';
$_lang['consentfriend.service_code_desc'] = 'The service code, thats injected automatically into the page code.';
$_lang['consentfriend.service_code_section'] = 'Code Section';
$_lang['consentfriend.service_code_section_desc'] = 'The section of the page code, where the service code is injected.';
$_lang['consentfriend.service_contextual_consent_only'] = 'Contextual Consent Only';
$_lang['consentfriend.service_contextual_consent_only_desc'] = 'If "Contextual Consent Only" is checked, this service will be exempted from the "Accept all" flow, i.e. clicking on "Accept all" will not enable this service.';
$_lang['consentfriend.service_contextual_consent_only_short'] = 'Contextual Only';
$_lang['consentfriend.service_cookie_cookie'] = 'Cookie';
$_lang['consentfriend.service_cookie_domain'] = 'Domain';
$_lang['consentfriend.service_cookie_path'] = 'Path';
$_lang['consentfriend.service_cookies'] = 'Cookies';
$_lang['consentfriend.service_cookies_desc'] = 'In the cookie column you could enter the cookie name or a regular expression (regex), filling the path and domain column is optional. Providing a path and domain is necessary, when you have apps that set cookies for a path that is not "/" or a domain that is not the current domain. If you do not set these values properly, the cookie can\'t be deleted by ConsentFriend, as there is no way to access the path or domain of a cookie in JS. Notice that it is not possible to delete cookies that were set on a third-party domain, or cookies that have the HTTPOnly attribute: https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie#new-cookie_domain';
$_lang['consentfriend.service_create'] = 'New Service';
$_lang['consentfriend.service_default'] = 'Default';
$_lang['consentfriend.service_default_desc'] = 'If "default" is checked, the service will be enabled by default. This overrides the global "default" setting.';
$_lang['consentfriend.service_description'] = 'Description';
$_lang['consentfriend.service_description_desc'] = 'The description of the service as listed in the consent modal. If the description is left blank, the description is set by the lexicon entry "consentfriend.services.&lt;name&gt;.description" with the consentfriend namespace.';
$_lang['consentfriend.service_export'] = 'Export Services';
$_lang['consentfriend.service_import'] = 'Import Services';
$_lang['consentfriend.service_import_append'] = 'Append';
$_lang['consentfriend.service_import_mode'] = 'Import Mode';
$_lang['consentfriend.service_import_replace'] = 'Replace';
$_lang['consentfriend.service_import_text'] = 'Import ConsentFriend Services YAML file.';
$_lang['consentfriend.service_import_update'] = 'Update';
$_lang['consentfriend.service_import_yaml_file'] = 'YAML File';
$_lang['consentfriend.service_name'] = 'Name';
$_lang['consentfriend.service_name_desc'] = 'Each service must have a unique name. ConsentFriend will look for HTML elements with a matching "data-name" attribute to identify elements that belong to this service.';
$_lang['consentfriend.service_on_accept_desc'] = 'The callback code, thats executed after accepting the service consent.';
$_lang['consentfriend.service_on_decline_desc'] = 'The callback code, thats executed after declining the service consent.';
$_lang['consentfriend.service_on_init_desc'] = 'The callback code, thats executed after initializing the service.';
$_lang['consentfriend.service_only_once'] = 'Only once';
$_lang['consentfriend.service_only_once_desc'] = 'If "Only once" is checked, the service will only be executed once regardless how often the user toggles it on and off. This is relevant e.g. for tracking scripts that would generate new page view events every time ConsentFriend disables and re-enables them due to a consent change by the user.';
$_lang['consentfriend.service_opt_out'] = 'Opt out';
$_lang['consentfriend.service_opt_out_desc'] = 'If "Opt out" is checked, ConsentFriend will load this service even before the user has given explicit consent. We strongly advise against this.';
$_lang['consentfriend.service_purposes'] = 'Purposes';
$_lang['consentfriend.service_purposes_desc'] = 'The purpose(s) of this service that will be listed on the consent notice. Do not forget to add translations for all purposes you list here.';
$_lang['consentfriend.service_remove'] = 'Remove Service';
$_lang['consentfriend.service_remove_confirm'] = 'Are you sure you want to remove this service?';
$_lang['consentfriend.service_required'] = 'Required';
$_lang['consentfriend.service_required_desc'] = 'If "required" is checked, ConsentFriend will not allow this service to be disabled by the user. Use this for service s that are always required for your website to function (e.g. shopping cart cookies).';
$_lang['consentfriend.service_section_body'] = 'BODY';
$_lang['consentfriend.service_section_head'] = 'HEAD';
$_lang['consentfriend.service_title'] = 'Title';
$_lang['consentfriend.service_title_desc'] = 'The title of the service as listed in the consent modal. If the description is left blank, the title is set by the lexicon entry "consentfriend.services.&lt;name&gt;.title" with the consentfriend namespace.';
$_lang['consentfriend.service_update'] = 'Update Service';

$_lang['consentfriend.config_err_not_an_export'] = 'This file is not an ConsentFriend export!';
$_lang['consentfriend.config_err_yaml'] = 'Unable to parse the YAML string: ';

$_lang['consentfriend.config_export'] = 'Export Configuration';
$_lang['consentfriend.config_import'] = 'Import Configuration';
$_lang['consentfriend.config_import_yaml_file'] = 'YAML File';
$_lang['consentfriend.config_import_text'] = 'Import ConsentFriend Configuration YAML file.';

$_lang['consentfriend.service_err_importing_file'] = 'Error importing the file!';
$_lang['consentfriend.service_err_importing_row'] = 'Error importing the following service: "[[+row]]"';
$_lang['consentfriend.service_err_importing_purposes'] = 'Error importing the following purposes: "[[+purposes]]"';
$_lang['consentfriend.service_err_name_ae'] = 'The name of the service already exists!';
$_lang['consentfriend.service_err_not_an_export'] = 'This file is not an ConsentFriend export!';
$_lang['consentfriend.service_err_servicepurpose_nf'] = 'The service purpose was not found!';
$_lang['consentfriend.service_err_servicepurpose_remove'] = 'The service purpose could not be removed!';
$_lang['consentfriend.service_err_servicepurpose_save'] = 'The service purpose can\'t be saved!';
$_lang['consentfriend.service_err_yaml'] = 'Unable to parse the YAML string: ';

$_lang['consentfriend.services.change_setting'] = 'Change consent';

$_lang['consentfriend.purposes'] = 'Purposes';
$_lang['consentfriend.purposes_desc'] = 'Create and modify your ConsentFriend purposes.';

$_lang['consentfriend.purpose_active'] = 'Active';
$_lang['consentfriend.purpose_active_desc'] = 'If "active" is checked, the purpose is shown in the consent modal or in the list of the purposes.';
$_lang['consentfriend.purpose_create'] = 'New Purpose';
$_lang['consentfriend.purpose_description'] = 'Description';
$_lang['consentfriend.purpose_description_desc'] = 'The description of the purpose as listed in the consent modal. If the description is left blank, the description is set by the lexicon entry "consentfriend.purposes.&lt;key&gt;.description" with the consentfriend namespace.';
$_lang['consentfriend.purpose_export'] = 'Export Purposes';
$_lang['consentfriend.purpose_import'] = 'Import Purposes';
$_lang['consentfriend.purpose_import_append'] = 'Append';
$_lang['consentfriend.purpose_import_mode'] = 'Import Mode';
$_lang['consentfriend.purpose_import_replace'] = 'Replace';
$_lang['consentfriend.purpose_import_text'] = 'Import ConsentFriend Purposes YAML file.<br><span class="red">CAUTION: If you select to replace the purposes during the import, all purposes are removed from the services.</span>';
$_lang['consentfriend.purpose_import_update'] = 'Update';
$_lang['consentfriend.purpose_import_yaml_file'] = 'YAML File';
$_lang['consentfriend.purpose_key'] = 'Key';
$_lang['consentfriend.purpose_key_desc'] = 'The key of the purpose. The key is used to retrive the lexicon entry, when the title is blank.';
$_lang['consentfriend.purpose_remove'] = 'Remove Purpose';
$_lang['consentfriend.purpose_remove_confirm'] = 'Are you sure you want to remove this purpose?';
$_lang['consentfriend.purpose_sortindex'] = 'Sort Index';
$_lang['consentfriend.purpose_title'] = 'Title';
$_lang['consentfriend.purpose_title_desc'] = 'The name of the purpose. If the title is left blank, the title is set by the lexicon entry "consentfriend.purposes.&lt;key&gt;.title" with the consentfriend namespace.';
$_lang['consentfriend.purpose_update'] = 'Update Purpose';

$_lang['consentfriend.purpose_err_importing_row'] = 'Error importing the following purpose: \'[[+row]]\'';
$_lang['consentfriend.purpose_err_key_ae'] = 'The key of the purpose already exists!';
$_lang['consentfriend.purpose_err_not_an_export'] = 'This file is not an ConsentFriend export!';
$_lang['consentfriend.purpose_err_yaml'] = 'Unable to parse the YAML string: ';

$_lang['consentfriend.purposes.security.description'] = 'These services process personal information to protect the content, the hosting or the forms of the website.';
$_lang['consentfriend.purposes.security.title'] = 'Security';
$_lang['consentfriend.purposes.styling.description'] = 'These services process personal information to improve the styling of the website.';
$_lang['consentfriend.purposes.styling.title'] = 'Styling';

$_lang['consentfriend.setting_err_importing_row'] = 'Error importing the following setting: "[[+row]]"';

$_lang['consentfriend.settings'] = '<i class="icon icon-cog"></i>';
$_lang['consentfriend.settings_desc'] = 'Edit the settings of ConsentFriend. You can edit the value of a system setting by double-clicking on the \'Value\' table cell or by right-clicking in the table cell.';

$_lang['consentfriend.debug_mode'] = 'Debug Mode';

$_lang['consentfriend.systemsetting_key_err_nv'] = 'You could only edit settings with the prefix consentfriend.';
$_lang['consentfriend.systemsetting_usergroup_err_nv'] = 'Only users with a settings permission or a settings_consentfriend permission are allowed to change settings.';
