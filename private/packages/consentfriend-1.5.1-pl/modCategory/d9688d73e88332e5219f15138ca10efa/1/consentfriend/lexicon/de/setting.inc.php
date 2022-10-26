<?php
/**
 * Setting Lexicon Entries for ConsentFriend
 *
 * @package consentfriend
 * @subpackage lexicon
 */
$_lang['area_consentfriend'] = 'ConsentFriend';
$_lang['area_cookie'] = 'Cookie';
$_lang['area_log'] = 'Protokollierung';
$_lang['setting_consentfriend.accept_all'] = '‚Alle akzeptieren‘ einblenden';
$_lang['setting_consentfriend.accept_all_desc'] = 'Wenn diese Option aktiviert ist, zeigt ConsentFriend im Zustimmungsmanager-Modal die Schaltfläche ‚Alle akzeptieren‘ an, die alle Drittanbieter-Dienste aktiviert, wenn der Nutzer darauf klickt. Wenn sie deaktiviert ist, gibt es dort nur die Schaltfläche ‚Ausgewählte Akzeptieren‘, die nur die Dienste aktiviert, die im Zustimmungsmanager-Modal aktiviert sind.';
$_lang['setting_consentfriend.cookie_domain'] = 'Cookie-Domain';
$_lang['setting_consentfriend.cookie_domain_desc'] = 'Sie können die Cookie-Domain für den Consent Manager selbst ändern. Verwenden Sie diese Option, wenn Sie die Zustimmung für mehrere übereinstimmende Domains einmalig einholen möchten. ConsentFriend verwendet standardmäßig die aktuelle Domäne. Nur relevant, wenn `storageMethod` auf `cookie` gesetzt ist.';
$_lang['setting_consentfriend.cookie_expires_after_days'] = 'Cookie-Ablauf';
$_lang['setting_consentfriend.cookie_expires_after_days_desc'] = 'Legen Sie eine benutzerdefinierte Verfallszeit in Tagen für das ConsentFriend-Cookie fest. Nur relevant, wenn `storage_method` auf `cookie` gesetzt ist.';
$_lang['setting_consentfriend.cookie_name'] = 'Cookie Name';
$_lang['setting_consentfriend.cookie_name_desc'] = 'Der Name des Cookies oder des localStorage-Eintrags, den ConsentFriend für die Speicherung der Zustimmungsinformationen verwendet.';
$_lang['setting_consentfriend.css_url'] = 'CSS-URL';
$_lang['setting_consentfriend.css_url_desc'] = 'Die CSS-URL für ConsentFriend. Wenn sie leer gelassen wird, verweist die Javascript-URL auf ein Skript, das die Standardstile enthält.';
$_lang['setting_consentfriend.debug'] = 'Debug';
$_lang['setting_consentfriend.debug_desc'] = 'Debug-Informationen im MODX Fehlerprotokoll ausgeben.';
$_lang['setting_consentfriend.default'] = 'Default';
$_lang['setting_consentfriend.default_desc'] = 'Legt den Standardstatus für Dienste fest (true=standardmäßig aktiviert).';
$_lang['setting_consentfriend.disabled_templates'] = 'Deaktivierte Templates';
$_lang['setting_consentfriend.disabled_templates_desc'] = 'Kommagetrennte Liste von Templates, bei denen ConsentFriend deaktiviert ist. Das Ergebnis der Prüfung `consentfriend.disabled_templates` ersetzt das Ergebnis von `consentfriend.enabled_templates`.';
$_lang['setting_consentfriend.element_id'] = 'Element-ID';
$_lang['setting_consentfriend.element_id_desc'] = 'Die ID des DIV-Elements, das ConsentFriend beim Starten erstellt.';
$_lang['setting_consentfriend.embedded'] = 'Eingebettet';
$_lang['setting_consentfriend.embedded_desc'] = 'Wenn diese Option aktiviert ist, stellt ConsentFriend das Zustimmungsmanager-Modal und den Cookie-Hinweis ohne den Modalhintergrund dar, so dass Sie sie z. B. in ein bestimmtes Element Ihrer Website einbetten können, wie z. B. Ihren Datenschutzhinweis.';
$_lang['setting_consentfriend.enable'] = 'Aktivieren';
$_lang['setting_consentfriend.enable_desc'] = 'Aktivieren Sie ConsentFriend für diese Installation/diesen Kontext.';
$_lang['setting_consentfriend.enabled_templates'] = 'Aktivierte Templates';
$_lang['setting_consentfriend.enabled_templates_desc'] = 'Kommagetrennte Liste von Templates, bei denen ConsentFriend aktiviert ist. Das Ergebnis der Prüfung `consentfriend.disabled_templates` ersetzt das Ergebnis von `consentfriend.enabled_templates`.';
$_lang['setting_consentfriend.group_by_purpose'] = 'Nach Zweck gruppieren';
$_lang['setting_consentfriend.group_by_purpose_desc'] = 'Wenn diese Option aktiviert ist, gruppiert ConsentFriend die Dienste im Zustimmungsmanager-Modal nach ihrem Zweck. Dies ist ratsam, wenn Sie eine große Anzahl von Diensten haben. Benutzer können dann ganze Gruppen von Diensten aktivieren oder deaktivieren, anstatt jeden einzelnen Dienst aktivieren oder deaktivieren zu müssen.';
$_lang['setting_consentfriend.hide_decline_all'] = '‚Ablehnen‘ ausblenden';
$_lang['setting_consentfriend.hide_decline_all_desc'] = 'Wenn diese Funktion aktiviert ist, blendet ConsentFriend die Schaltfläche ‚Ablehnen‘ im Cookie-Hinweis aus und zwingt den Nutzer, das Zustimmungsmanager-Modal zu öffnen, um seine Zustimmung zu ändern oder alle Dienste Dritter zu deaktivieren. Wir raten Ihnen dringend davon ab, diese Funktion zu verwenden, da sie den Grundsätzen ‚Datenschutz durch Voreinstellung‘ und ‚Datenschutz durch Design‘ der Datenschutz-Grundverordnung widerspricht (in anderen Gesetzen wie dem CCPA jedoch zulässig sein könnte).';
$_lang['setting_consentfriend.hide_learn_more'] = '‚Details anzeigen‘ ausblenden';
$_lang['setting_consentfriend.hide_learn_more_desc'] = 'Wenn diese Option aktiviert ist, blendet ConsentFriend die Schaltfläche ‚Details anzeigen‘ im Cookie-Hinweis aus. Wir raten dringend davon ab, dies unter den meisten Umständen zu verwenden, da es den Nutzer daran hindert, seine Einwilligungsentscheidungen anzupassen.';
$_lang['setting_consentfriend.hide_powered_by'] = 'Powered By‘ ausblenden';
$_lang['setting_consentfriend.hide_powered_by_desc'] = 'Wenn diese Option aktiviert ist, blendet ConsentFriend den Link ‚Realisiert mit ConsentFriend (Powered by Klaro!)‘ im Zustimmungsmanager-Modal aus.';
$_lang['setting_consentfriend.html_texts'] = 'HTML-Texte';
$_lang['setting_consentfriend.html_texts_desc'] = 'Wenn diese Option aktiviert ist, rendert ConsentFriend die in den Übersetzungen `consentModal.description` und `consentNotice.description` angegebenen Texte als HTML. Dies ermöglicht es Ihnen, z.B. benutzerdefinierte Links oder interaktive Inhalte hinzuzufügen.';
$_lang['setting_consentfriend.js_url'] = 'Javascript-URL';
$_lang['setting_consentfriend.js_url_desc'] = 'Die Javascript-URL für ConsentFriend.';
$_lang['setting_consentfriend.log_usage'] = 'Nutzung protokollieren';
$_lang['setting_consentfriend.log_usage_desc'] = 'Protokollierung der sitzungsbasierten Nutzung von akzeptierten und abgelehnten Diensten von Besuchern mit anonymisierter IP-Adresse zur späteren Analyse';
$_lang['setting_consentfriend.must_consent'] = 'Muss Zustimmen';
$_lang['setting_consentfriend.must_consent_desc'] = 'Wenn diese Option aktiviert ist, zeigt ConsentFriend das Zustimmungsmanager-Modal direkt an und erlaubt dem Nutzer nicht, es zu schließen, bevor er der Nutzung von Drittanbieterdiensten aktiv zugestimmt oder sie abgelehnt hat.';
$_lang['setting_consentfriend.no_autoLoad'] = 'Kein Autoload';
$_lang['setting_consentfriend.no_autoLoad_desc'] = 'Wenn diese Option aktiviert ist, wird ConsentFriend nicht automatisch geladen, wenn die Seite geladen wird.';
$_lang['setting_consentfriend.notice_as_modal'] = 'Hinweis als Modal';
$_lang['setting_consentfriend.notice_as_modal_desc'] = 'Wenn aktiviert, zeigt ConsentFriend den Cookie-Hinweis als modales Fenster an';
$_lang['setting_consentfriend.privacy_policy_id'] = 'Datenschutzerklärung-ID';
$_lang['setting_consentfriend.privacy_policy_id_desc'] = 'Die ID einer MODX-Ressource, welche die Datenschutzrichtlinie enthält.';
$_lang['setting_consentfriend.storage_method'] = 'Speichermethode';
$_lang['setting_consentfriend.storage_method_desc'] = 'Wie ConsentFriend die Zustimmungsinformationen im Browser speichert. Geben Sie entweder `cookie` (Standard) oder `localStorage` an.';
$_lang['setting_consentfriend.theme'] = 'Theme';
$_lang['setting_consentfriend.theme_desc'] = 'Das Thema von ConsentFriend. Kann in `black`, `dark`, `light`, `white` geändert werden.';
$_lang['setting_consentfriend.use_contexts'] = 'Kontexte verwenden';
$_lang['setting_consentfriend.use_contexts_desc'] = 'Wenn diese Funktion aktiviert ist, können Sie mit ConsentFriend die angezeigten und verwendeten Dienste nach Kontext einschränken.';
$_lang['setting_consentfriend.user_agent_filter'] = 'User Agent Filter';
$_lang['setting_consentfriend.user_agent_filter_desc'] = 'Kommagetrennte Liste von User-Agent-Substrings, die nicht protokolliert werden.';
