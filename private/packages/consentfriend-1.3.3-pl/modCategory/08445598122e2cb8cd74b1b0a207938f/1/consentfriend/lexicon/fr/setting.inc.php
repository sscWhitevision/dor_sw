<?php
/**
 * Setting Lexicon Entries
 *
 * @package consentfriend
 * @subpackage lexicon
 */

$_lang['area_consentfriend'] = 'ConsentFriend';

$_lang['setting_consentfriend.accept_all'] = 'Accept All';
$_lang['setting_consentfriend.accept_all_desc'] = 'If enabled, ConsentFriend will show an "accept all" button in the notice and modal, which will enable all third-party apps if the user clicks on it. If disabled, there will be an "accept" button that will only enable the apps that are enabled in the consent modal.';
$_lang['setting_consentfriend.cookie_domain'] = 'Cookie Domain';
$_lang['setting_consentfriend.cookie_domain_desc'] = 'You can change the cookie domain for the consent manager itself. Use this if you want to get consent once for multiple matching domains. By default, ConsentFriend will use the current domain. Only relevant if "storageMethod" is set to "cookie".';
$_lang['setting_consentfriend.cookie_expires_after_days'] = 'Cookie Expiration';
$_lang['setting_consentfriend.cookie_expires_after_days_desc'] = 'Set a custom expiration time in days for the ConsentFriend cookie. Only relevant if "storage_method" is set to "cookie".';
$_lang['setting_consentfriend.cookie_name'] = 'Cookie Name';
$_lang['setting_consentfriend.cookie_name_desc'] = 'The name of the cookie or localStorage entry that ConsentFriend will use for storing the consent information.';
$_lang['setting_consentfriend.css_url'] = 'CSS Url';
$_lang['setting_consentfriend.css_url_desc'] = 'The CSS URL for ConsentFriend. If it is left blank, the Javascript URL will point to a script containing the default styles.';
$_lang['setting_consentfriend.debug'] = 'Debug';
$_lang['setting_consentfriend.debug_desc'] = 'Log debug informations in the MODX error log.';
$_lang['setting_consentfriend.default'] = 'Default';
$_lang['setting_consentfriend.default_desc'] = 'Defines the default state for services (true=enabled by default).';
$_lang['setting_consentfriend.element_id'] = 'Element ID';
$_lang['setting_consentfriend.element_id_desc'] = 'The ID of the DIV element that ConsentFriend will create when starting up.';
$_lang['setting_consentfriend.embedded'] = 'Embedded';
$_lang['setting_consentfriend.embedded_desc'] = 'If enabled, ConsentFriend will will render the modal and notice without the modal background, allowing you to e.g. embed them into a specific element of your website, such as your privacy notice.';
$_lang['setting_consentfriend.no_autoLoad'] = 'No Autoload';
$_lang['setting_consentfriend.no_autoLoad_desc'] = 'If enabled, it will keep ConsentFriend from automatically loading itself when the page is being loaded.';
$_lang['setting_consentfriend.enable'] = 'Enable';
$_lang['setting_consentfriend.enable_desc'] = 'Enable ConsentFriend on this installation/context.';
$_lang['setting_consentfriend.group_by_purpose'] = 'Group by Purpose';
$_lang['setting_consentfriend.group_by_purpose_desc'] = 'If enabled, ConsentFriend will group apps by their purpose in the modal. This is advisable if you have a large number of apps. Users can then enable or disable entire groups of apps instead of having to enable or disable every app.';
$_lang['setting_consentfriend.hide_decline_all'] = 'Hide Decline All';
$_lang['setting_consentfriend.hide_decline_all_desc'] = 'If enabled, ConsentFriend will hide the "decline" button in the consent modal and force the user to open the modal in order to change his/her consent or disable all third-party apps. We strongly advise you to not use this feature, as it opposes the "privacy by default" and "privacy by design" principles of the GDPR (but might be acceptable in other legislations such as under the CCPA).';
$_lang['setting_consentfriend.hide_learn_more'] = 'Hide Learn More';
$_lang['setting_consentfriend.hide_learn_more_desc'] = 'If enabled, ConsentFriend will hide the "learn more/customize" link in the consent notice. We strongly advise against using this under most circumstances, as it keeps the user from customizing his/her consent choices.';
$_lang['setting_consentfriend.html_texts'] = 'HTML Texts';
$_lang['setting_consentfriend.html_texts_desc'] = 'If enabled, ConsentFriend will render the texts given in the `consentModal.description` and `consentNotice.description` translations as HTML. This enables you to e.g. add custom links or interactive content.';
$_lang['setting_consentfriend.js_url'] = 'Javascript Url';
$_lang['setting_consentfriend.js_url_desc'] = 'The Javascript URL for ConsentFriend.';
$_lang['setting_consentfriend.must_consent'] = 'Must Consent';
$_lang['setting_consentfriend.must_consent_desc'] = 'If enabled, ConsentFriend will directly display the consent manager modal and not allow the user to close it before having actively consented or declined the use of third-party applications.';
$_lang['setting_consentfriend.notice_as_modal'] = 'Notice as Modal';
$_lang['setting_consentfriend.notice_as_modal_desc'] = 'If enabled, ConsentFriend will show the cookie notice as modal';
$_lang['setting_consentfriend.privacy_policy_id'] = 'Privacy Policy ID';
$_lang['setting_consentfriend.privacy_policy_id_desc'] = 'The ID of a MODX resource containing the privacy policy.';
$_lang['setting_consentfriend.storage_method'] = 'Storage Method';
$_lang['setting_consentfriend.storage_method_desc'] = 'How ConsentFriend persists consent information in the browser. Specify either "cookie" (the default) or "localStorage".';
$_lang['setting_consentfriend.hide_powered_by'] = 'Hide Powered By';
$_lang['setting_consentfriend.hide_powered_by_desc'] = 'If enabled, ConsentFriend will hide the "Realized with ConsentFriend (Powered by Klaro!)" link in the consent modal.';
$_lang['setting_consentfriend.theme'] = 'Theme';
$_lang['setting_consentfriend.theme_desc'] = 'The ConsentFriend theme. Could be changed to "black", "dark", "light", "white".';
