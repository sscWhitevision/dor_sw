<?php
/**
 * Default Lexicon Entries
 *
 * @package consentfriend
 * @subpackage lexicon
 */

$_lang['consentfriend'] = 'ConsentFriend';

$_lang['consentfriend.menu_home'] = 'ConsentFriend';
$_lang['consentfriend.menu_home_desc'] = 'MODX Konsens-Management-Plattform';

$_lang['consentfriend.services'] = 'Dienste';
$_lang['consentfriend.services_desc'] = 'Erstellen und ändern Sie Ihre ConsentFriend-Dienste.';
$_lang['consentfriend.services_tab_callbacks'] = 'Callbacks';
$_lang['consentfriend.services_tab_code'] = 'Code';
$_lang['consentfriend.services_tab_cookies'] = 'Cookies';
$_lang['consentfriend.services_tab_on_accept'] = 'On Accept';
$_lang['consentfriend.services_tab_on_decline'] = 'On Decline';
$_lang['consentfriend.services_tab_on_init'] = 'On Init';
$_lang['consentfriend.services_tab_on_toggle'] = 'On Toggle';
$_lang['consentfriend.services_tab_service'] = 'Dienste';

$_lang['consentfriend.service_active'] = 'Aktiv';
$_lang['consentfriend.service_active_desc'] = 'Wenn "Aktiv" aktiviert ist, wird der Dienst im Konsens-Management angezeigt.';
$_lang['consentfriend.service_on_toggle'] = 'Callback';
$_lang['consentfriend.service_on_toggle_desc'] = 'Der Callback-Code, der beim Ändern der Dienst-Zustimmung ausgeführt wird.';
$_lang['consentfriend.service_code'] = 'Code';
$_lang['consentfriend.service_code_desc'] = 'Der Code des Dienstes, der automatisch in den Seitencode eingefügt wird.';
$_lang['consentfriend.service_code_section'] = 'Code Abschnitt';
$_lang['consentfriend.service_code_section_desc'] = 'Der Abschnitt des Seitencodes, in den der Dienst-Code eingefügt wird.';
$_lang['consentfriend.service_contextual_consent_only'] = 'Nur kontextbezogene Zustimmung';
$_lang['consentfriend.service_contextual_consent_only_desc'] = 'Wenn "Nur kontextabhängige Zustimmung" markiert ist, wird dieser Dienst vom "Alle akzeptieren"-Ablauf ausgenommen, d. h. ein Klick auf "Alle akzeptieren" aktiviert diesen Dienst nicht.';
$_lang['consentfriend.service_contextual_consent_only_short'] = 'Nur kontextabhängig';
$_lang['consentfriend.service_cookie_cookie'] = 'Cookie';
$_lang['consentfriend.service_cookie_domain'] = 'Domain';
$_lang['consentfriend.service_cookie_path'] = 'Pfad';
$_lang['consentfriend.service_cookies'] = 'Cookies';
$_lang['consentfriend.service_cookies_desc'] = 'In der Cookie-Spalte können Sie einen Cookie-Namen oder einen regulären Ausdruck (Regex) eingeben. Das Ausfüllen der Pfad- und Domain-Spalte ist optional. Die Angabe eines Pfads und einer Domäne ist erforderlich, wenn Sie Apps haben, die Cookies für einen Pfad setzen, der nicht "/" ist, oder für eine Domäne, die nicht die aktuelle Domäne ist. Wenn Sie diese Werte nicht richtig festlegen, kann das Cookie von ConsentFriend nicht gelöscht werden, da es keine Möglichkeit gibt, auf den Pfad oder die Domäne eines Cookies in JS zuzugreifen. Beachten Sie, dass es nicht möglich ist, Cookies zu löschen, die in einer Drittanbieter-Domain gesetzt wurden, oder Cookies, die das Attribut HTTPOnly haben: https://developer.mozilla.org/en-US/docs/Web/API/Document/cooki #new-cookie_domain';
$_lang['consentfriend.service_create'] = 'Neuer Dienst';
$_lang['consentfriend.service_default'] = 'Standard';
$_lang['consentfriend.service_default_desc'] = 'Wenn "Standard" aktiviert ist, wird der Dienst standardmäßig aktiviert. Dies überschreibt die globale "Standard" Einstellung.';
$_lang['consentfriend.service_description'] = 'Beschreibung';
$_lang['consentfriend.service_description_desc'] = 'Die Beschreibung des Dienstes, wie im Konsens-Management aufgeführt. Wenn die Beschreibung leer gelassen wird, wird sie durch den Lexikoneintrag "consentfriend.services.&lt;name&gt;.description" mit dem Namensraum consentfriend festgelegt.';
$_lang['consentfriend.service_export'] = 'Dienste exportieren';
$_lang['consentfriend.service_import'] = 'Dienste importieren';
$_lang['consentfriend.service_import_append'] = 'Anhängen';
$_lang['consentfriend.service_import_mode'] = 'Importmodus';
$_lang['consentfriend.service_import_replace'] = 'Ersetzen';
$_lang['consentfriend.service_import_text'] = 'ConsentFriend YAML-Dienst-Datei importieren.';
$_lang['consentfriend.service_import_update'] = 'Update';
$_lang['consentfriend.service_import_yaml_file'] = 'YAML-Datei';
$_lang['consentfriend.service_name'] = 'Name';
$_lang['consentfriend.service_name_desc'] = 'Jeder Dienst muss einen eindeutigen Namen haben. ConsentFriend sucht nach HTML-Elementen mit einem passenden "data-name" Attribut, um Elemente zu identifizieren, die zu diesem Dienst gehören.';
$_lang['consentfriend.service_on_accept'] = 'On Accept';
$_lang['consentfriend.service_on_accept_desc'] = 'Der Callback-Code, der nach dem Akzeptieren der Dienst-Zustimmung ausgeführt wird.';
$_lang['consentfriend.service_on_decline'] = 'On Decline';
$_lang['consentfriend.service_on_decline_desc'] = 'Der Callback-Code, der nach der Ablehnung der Dienst-Zustimmung ausgeführt wird.';
$_lang['consentfriend.service_on_init'] = 'On Init';
$_lang['consentfriend.service_on_init_desc'] = 'Der Callback-Code, der nach der Initialisierung des Dienstes ausgeführt wird.';
$_lang['consentfriend.service_only_once'] = 'Nur einmal';
$_lang['consentfriend.service_only_once_desc'] = 'Wenn "Nur einmal" markiert ist, wird der Dienst nur einmal ausgeführt, unabhängig davon, wie oft der Benutzer ihn ein- und ausschaltet. Dies ist z. B. für Tracking-Skripte relevant, die jedes Mal neue Seitenaufruf-Ereignisse erzeugen würden, wenn ConsentFriend sie aufgrund einer Zustimmungsänderung durch den Benutzer deaktiviert und wieder aktiviert.';
$_lang['consentfriend.service_opt_out'] = 'Opt out';
$_lang['consentfriend.service_opt_out_desc'] = 'Wenn "Opt out" aktiviert ist, lädt ConsentFriend diesen Dienst, noch bevor der Benutzer seine ausdrückliche Zustimmung erteilt hat. Wir raten dringend davon ab.';
$_lang['consentfriend.service_purposes'] = 'Zwecke';
$_lang['consentfriend.service_purposes_desc'] = 'Die Zwecke dieses Dienstes, die in der Einwilligungserklärung aufgeführt werden. Vergessen Sie nicht, Übersetzungen für alle hier aufgeführten Zwecke hinzuzufügen.';
$_lang['consentfriend.service_remove'] = 'Dienst entfernen';
$_lang['consentfriend.service_remove_confirm'] = 'Sind Sie sicher, dass Sie diesen Dienst entfernen möchten?';
$_lang['consentfriend.service_required'] = 'Erforderlich';
$_lang['consentfriend.service_required_desc'] = 'Wenn "Erforderlich" aktiviert ist, lässt ConsentFriend nicht zu, dass dieser Dienst vom Benutzer deaktiviert wird. Verwenden Sie diese Option für Dienste, die immer erforderlich sind, damit Ihre Website funktioniert (z.B. Warenkorb-Cookies).';
$_lang['consentfriend.service_section_body'] = 'BODY';
$_lang['consentfriend.service_section_head'] = 'HEAD';
$_lang['consentfriend.service_title'] = 'Titel';
$_lang['consentfriend.service_title_desc'] = 'Der Titel Ihres Dienstes, wie im Zustimmungs-Management aufgeführt. Wenn der Titel leer gelassen wird, wird die Beschreibung durch den Lexikoneintrag "consentfriend.services.&lt;name&gt;.title" mit dem Namensraum consentfriend festgelegt.';
$_lang['consentfriend.service_update'] = 'Dienst bearbeiten';

$_lang['consentfriend.config_err_not_an_export'] = 'Diese Datei ist kein ConsentFriend-Export!';
$_lang['consentfriend.config_err_yaml'] = 'Die YAML-Zeichenkette konnte nicht verarbeitet werden: ';

$_lang['consentfriend.config_export'] = 'Konfiguration exportieren';
$_lang['consentfriend.config_import'] = 'Konfiguration importieren';
$_lang['consentfriend.config_import_yaml_file'] = 'YAML-Datei';
$_lang['consentfriend.config_import_text'] = 'ConsentFriend YAML-Konfigurations-Datei importieren.';

$_lang['consentfriend.service_err_importing_file'] = 'Fehler beim Importieren der Datei!';
$_lang['consentfriend.service_err_importing_row'] = 'Fehler beim Importieren des folgenden Dienstes: "[[+row]]"';
$_lang['consentfriend.service_err_importing_purposes'] = 'Fehler beim Importieren des folgenden Zwecks: "[[+row]]"';
$_lang['consentfriend.service_err_name_ae'] = 'Der Name des Dienstes existiert bereits!';
$_lang['consentfriend.service_err_not_an_export'] = 'Diese Datei ist kein ConsentFriend-Export!';
$_lang['consentfriend.service_err_servicepurpose_nf'] = 'Der Zweck des Dienstes wurde nicht gefunden!';
$_lang['consentfriend.service_err_servicepurpose_remove'] = 'Der Zweck des Dienstes konnte nicht entfernt werden!';
$_lang['consentfriend.service_err_servicepurpose_save'] = 'Der Zweck des Dienstes kann nicht gespeichert werden!';
$_lang['consentfriend.service_err_yaml'] = 'Die YAML-Zeichenkette konnte nicht verarbeitet werden: ';

$_lang['consentfriend.services.change_setting'] = 'Zustimmung ändern';

$_lang['consentfriend.purposes'] = 'Zwecke';
$_lang['consentfriend.purposes_desc'] = 'Erstellen und ändern Sie Ihre ConsentFriend-Zwecke.';

$_lang['consentfriend.purpose_active'] = 'Aktiv';
$_lang['consentfriend.purpose_active_desc'] = 'Wenn "Aktiv" aktiviert ist, wird der Zweck im Konsens-Management oder in der Liste der Zwecke angezeigt.';
$_lang['consentfriend.purpose_create'] = 'Neuer Zweck';
$_lang['consentfriend.purpose_description'] = 'Beschreibung';
$_lang['consentfriend.purpose_description_desc'] = 'Die Beschreibung des Zwecks, wie im Konsens-Management aufgeführt. Wenn die Beschreibung leer gelassen wird, wird die Beschreibung durch den Lexikoneintrag "consentfriend.purposes.&lt;key&gt;.description" mit dem Namensraum consentfriend festgelegt.';
$_lang['consentfriend.purpose_export'] = 'Zwecke exportieren';
$_lang['consentfriend.purpose_import'] = 'Zwecke importieren';
$_lang['consentfriend.purpose_import_append'] = 'Anhängen';
$_lang['consentfriend.purpose_import_mode'] = 'Importmodus';
$_lang['consentfriend.purpose_import_replace'] = 'Ersetzen';
$_lang['consentfriend.purpose_import_text'] = 'ConsentFriend YAML-Zweck-Datei importieren.<br><span class="red">ACHTUNG: Wenn Sie während des Imports das Ersetzen der Zwecke auswählen, werden alle Zwecke aus den Diensten entfernt.</span>';
$_lang['consentfriend.purpose_import_update'] = 'Update';
$_lang['consentfriend.purpose_import_yaml_file'] = 'YAML-Datei';
$_lang['consentfriend.purpose_key'] = 'Schlüssel';
$_lang['consentfriend.purpose_key_desc'] = 'Der Schlüssel des Zwecks. Der Schlüssel wird verwendet, um den Lexikoneintrag abzurufen, wenn der Titel leer ist.';
$_lang['consentfriend.purpose_remove'] = 'Zweck entfernen';
$_lang['consentfriend.purpose_remove_confirm'] = 'Sind Sie sicher, dass Sie diesen Zweck entfernen möchten?';
$_lang['consentfriend.purpose_sortindex'] = 'Sortier-Index';
$_lang['consentfriend.purpose_title'] = 'Titel';
$_lang['consentfriend.purpose_title_desc'] = 'Der Name des Zwecks. Wenn die Titel leer gelassen wird, wird die Beschreibung durch den Lexikoneintrag "consentfriend.purposes.&lt;key&gt;.title" mit dem Namensraum consentfriend festgelegt.';
$_lang['consentfriend.purpose_update'] = 'Zweck bearbeiten';

$_lang['consentfriend.purpose_err_importing_row'] = 'Fehler beim Importieren des folgenden Zwecks: "[[+row]]"';
$_lang['consentfriend.purpose_err_key_ae'] = 'Der Schlüssel des Zwecks existiert bereits!';
$_lang['consentfriend.purpose_err_not_an_export'] = 'Diese Datei ist kein ConsentFriend-Export!';
$_lang['consentfriend.purpose_err_yaml'] = 'Die YAML-Zeichenkette konnte nicht verarbeitet werden: ';

$_lang['consentfriend.purposes.security.description'] = 'Diese Dienste verarbeiten persönliche Informationen, um den Inhalt, das Hosting oder die Formulare der Website zu schützen.';
$_lang['consentfriend.purposes.security.title'] = 'Sicherheit';
$_lang['consentfriend.purposes.styling.description'] = 'Diese Dienste verarbeiten persönliche Informationen, um das Design der Website zu verbessern.';
$_lang['consentfriend.purposes.styling.title'] = 'Styling';

$_lang['consentfriend.setting_err_importing_row'] = 'Fehler beim Importieren der folgenden Einstellung: "[[+row]]"';

$_lang['consentfriend.settings'] = '<i class="icon icon-cog"></i>';
$_lang['consentfriend.settings_desc'] = 'Bearbeiten Sie die Einstellungen von ConsentFriend. Sie können den Wert einer Systemeinstellung mit einem Doppelklick auf die ‚Wert‘-Tabellenzelle oder die Systemeinstellung mit einem Rechtsklick in der Tabellenzelle bearbeiten.';

$_lang['consentfriend.debug_mode'] = 'Debug-Modus';

$_lang['consentfriend.systemsetting_key_err_nv'] = 'Sie dürfen nur Einstellungen mit dem Prefix consentfriend bearbeiten.';
$_lang['consentfriend.systemsetting_usergroup_err_nv'] = 'Nur Benutzer mit einer settings Berechtigung oder einer settings_consentfriend Berechtigung können die Einstellungen ändern.';
