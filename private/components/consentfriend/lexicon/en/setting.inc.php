<?php
/**
 * Setting Lexicon Entries for ConsentFriend
 *
 * @package consentfriend
 * @subpackage lexicon
 */
$_lang['area_consentfriend'] = 'ConsentFriend';
$_lang['area_cookie'] = 'Cookie';
$_lang['area_log'] = 'Logging';
$_lang['setting_consentfriend.accept_all'] = 'Show ‘Accept all’';
$_lang['setting_consentfriend.accept_all_desc'] = 'If enabled, ConsentFriend will show an ‘Accept all’ button in the consent manager modal, which will enable all third-party services if the user clicks on it. If disabled, there will be only an ‘Accept selected’ button that will only enable the services that are enabled in the consent manager modal.';
$_lang['setting_consentfriend.cookie_domain'] = 'Cookie Domain';
$_lang['setting_consentfriend.cookie_domain_desc'] = 'You can change the cookie domain for the consent manager itself. Use this if you want to get consent once for multiple matching domains. By default, ConsentFriend will use the current domain. Only relevant if `storageMethod` is set to `cookie`.';
$_lang['setting_consentfriend.cookie_expires_after_days'] = 'Cookie Expiration';
$_lang['setting_consentfriend.cookie_expires_after_days_desc'] = 'Set a custom expiration time in days for the ConsentFriend cookie. Only relevant if `storage_method` is set to `cookie`.';
$_lang['setting_consentfriend.cookie_name'] = 'Cookie Name';
$_lang['setting_consentfriend.cookie_name_desc'] = 'The name of the cookie or localStorage entry that ConsentFriend will use for storing the consent information.';
$_lang['setting_consentfriend.css_url'] = 'CSS URL';
$_lang['setting_consentfriend.css_url_desc'] = 'The CSS URL for ConsentFriend. If it is left blank, the Javascript URL will point to a script containing the default styles.';
$_lang['setting_consentfriend.debug'] = 'Debug';
$_lang['setting_consentfriend.debug_desc'] = 'Log debug information in the MODX error log.';
$_lang['setting_consentfriend.default'] = 'Default';
$_lang['setting_consentfriend.default_desc'] = 'Defines the default state for services (true=enabled by default).';
$_lang['setting_consentfriend.disabled_templates'] = 'Disabled Templates';
$_lang['setting_consentfriend.disabled_templates_desc'] = 'Comma-separated list of template ids where ConsentFriend is disabled. The result of the `consentfriend.disabled_templates` check supersedes the result of `consentfriend.enabled_templates`.';
$_lang['setting_consentfriend.element_id'] = 'Element ID';
$_lang['setting_consentfriend.element_id_desc'] = 'The ID of the DIV element that ConsentFriend will create when starting up.';
$_lang['setting_consentfriend.embedded'] = 'Embedded';
$_lang['setting_consentfriend.embedded_desc'] = 'If enabled, ConsentFriend will will render the consent manager modal and cookie notice without the modal background, allowing you to e.g. embed them into a specific element of your website, such as your privacy notice.';
$_lang['setting_consentfriend.enable'] = 'Enable';
$_lang['setting_consentfriend.enable_desc'] = 'Enable ConsentFriend on this installation/context.';
$_lang['setting_consentfriend.enabled_templates'] = 'Enabled Templates';
$_lang['setting_consentfriend.enabled_templates_desc'] = 'Comma-separated list of template ids where ConsentFriend is enabled. The result of the `consentfriend.disabled_templates` check supersedes the result of `consentfriend.enabled_templates`.';
$_lang['setting_consentfriend.group_by_purpose'] = 'Group by Purpose';
$_lang['setting_consentfriend.group_by_purpose_desc'] = 'If enabled, ConsentFriend will group services by their purpose in the consent manager modal. This is advisable if you have a large number of services. Users can then enable or disable entire groups of services instead of having to enable or disable every service.';
$_lang['setting_consentfriend.hide_decline_all'] = 'Hide ‘Decline’';
$_lang['setting_consentfriend.hide_decline_all_desc'] = 'If enabled, ConsentFriend will hide the ‘Decline’ button in the cookie notice and force the user to open the consent manager modal in order to change his/her consent or disable all third-party services. We strongly advise you to not use this feature, as it opposes the ‘privacy by default’ and ‘privacy by design’ principles of the GDPR (but might be acceptable in other legislations such as under the CCPA).';
$_lang['setting_consentfriend.hide_learn_more'] = 'Hide ‘View details’';
$_lang['setting_consentfriend.hide_learn_more_desc'] = 'If enabled, ConsentFriend will hide the ‘View details’ button in the consent notice. We strongly advise against using this under most circumstances, as it keeps the user from customizing his/her consent choices.';
$_lang['setting_consentfriend.hide_powered_by'] = 'Hide Powered By';
$_lang['setting_consentfriend.hide_powered_by_desc'] = 'If enabled, ConsentFriend will hide the ‘Realized with ConsentFriend (Powered by Klaro!)’ link in the consent manager modal.';
$_lang['setting_consentfriend.html_texts'] = 'HTML Texts';
$_lang['setting_consentfriend.html_texts_desc'] = 'If enabled, ConsentFriend will render the texts given in the `consentModal.description` and `consentNotice.description` translations as HTML. This enables you to e.g. add custom links or interactive content.';
$_lang['setting_consentfriend.js_url'] = 'Javascript Url';
$_lang['setting_consentfriend.js_url_desc'] = 'The Javascript URL for ConsentFriend.';
$_lang['setting_consentfriend.log_usage'] = 'Log Usage';
$_lang['setting_consentfriend.log_usage_desc'] = 'Log session-based usage of accepted and denied services from visitors with an anonymized IP address for later analysis';
$_lang['setting_consentfriend.must_consent'] = 'Must Consent';
$_lang['setting_consentfriend.must_consent_desc'] = 'If enabled, ConsentFriend will directly display the consent manager modal and not allow the user to close it before having actively consented or declined the use of third-party services.';
$_lang['setting_consentfriend.no_autoLoad'] = 'No Autoload';
$_lang['setting_consentfriend.no_autoLoad_desc'] = 'If enabled, it will keep ConsentFriend from automatically loading itself when the page is being loaded.';
$_lang['setting_consentfriend.notice_as_modal'] = 'Notice as Modal';
$_lang['setting_consentfriend.notice_as_modal_desc'] = 'If enabled, ConsentFriend will show the cookie notice as modal';
$_lang['setting_consentfriend.privacy_policy_id'] = 'Privacy Policy ID';
$_lang['setting_consentfriend.privacy_policy_id_desc'] = 'The ID of a MODX resource containing the privacy policy.';
$_lang['setting_consentfriend.storage_method'] = 'Storage Method';
$_lang['setting_consentfriend.storage_method_desc'] = 'How ConsentFriend persists consent information in the browser. Specify either `cookie` (the default) or `localStorage`.';
$_lang['setting_consentfriend.theme'] = 'Theme';
$_lang['setting_consentfriend.theme_desc'] = 'The ConsentFriend theme. Could be changed to `black`, `dark`, `light`, `white`.';
$_lang['setting_consentfriend.use_contexts'] = 'Use Contexts';
$_lang['setting_consentfriend.use_contexts_desc'] = 'If enabled, ConsentFriend allows you to restrict the displayed and used services by context.';
$_lang['setting_consentfriend.user_agent_filter'] = 'User Agent Filter';
$_lang['setting_consentfriend.user_agent_filter_desc'] = 'Comma-separated list of user agent substrings that are not logged.';
