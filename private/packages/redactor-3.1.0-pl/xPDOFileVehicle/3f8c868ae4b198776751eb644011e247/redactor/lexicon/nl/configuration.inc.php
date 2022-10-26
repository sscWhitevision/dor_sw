<?php

$_lang['redactor.configuration_set'] = 'Configuratieset';
$_lang['redactor.configuration_set_desc'] = 'Selecteer de configuratie set om te gebruiken. Om configuratie sets the beheren, navigeer naar Extras > Redactor Configuratie.';
$_lang['redactor.configuration_sets'] = 'Configuratiesets';
$_lang['redactor.configuration_sets_desc'] = 'Met configuratiesets beheer je de Redactor rich text editor. Je kunt zowel de weergave als functionaliteit aanpassen. Om verschillende configuratiesets in verschillende contexten te gebruiken, maak je de <code>redactor.configuration_set</code> context setting aan, met daarin het ID van de configuratieset zoals hier weergegeven.';

$_lang['redactor.id'] = 'ID';
$_lang['redactor.class_key'] = 'Type set';
$_lang['redactor.class_key.redConfigurationSet'] = 'Standaard';
$_lang['redactor.class_key.redAdvancedConfigurationSet'] = 'Geavanceerd';
$_lang['redactor.class_key.description'] = 'To configure Redactor you can choose between a <em>Basic</em> and <em>Advanced</em> mode. With <em>Basic</em> you will be presented with a form with the available settings, allowing you to choose or fill in the proper values. With <em>advanced</em> mode you can instead write the Redactor configuration as code, which gives a bit more flexibility but requires more knowledge about redactor.js. ';
$_lang['redactor.class_key.description_upd'] = 'To change the type of set, please duplicate the set and change the type there. When moving from Advanced to Basic you may lose certain options that Basic does not support.';
$_lang['redactor.name'] = 'Naam';
$_lang['redactor.description'] = 'Omschrijving';
$_lang['redactor.usage'] = 'Gebruikt voor';
$_lang['redactor.usage.system_default'] = 'Systeemstandaard';
$_lang['redactor.usage.context'] = 'Context "[[+key]]"';
$_lang['redactor.usage.user'] = 'Gebruiker "[[+username]]"';
$_lang['redactor.usage.usergroup'] = 'Gebruikersgroep "[[+name]]"';
$_lang['redactor.usage.tv'] = 'Template variabele "[[+name]]"';
$_lang['redactor.usage.template'] = 'Template "[[+name]]"';
$_lang['redactor.usage.contentblocks'] = 'ContentBlocks veld "[[+name]]"';
$_lang['redactor.usage.introtext'] = 'Document omschrijving';

$_lang['redactor.manage_configuration'] = 'Beheer configuratie';
$_lang['redactor.manage_configuration_desc_redConfigurationSet'] = 'Op deze pagina kun je de configuratieset beheren. Hieronder vindt je in diverse categorieën de beschikbare opties voor de editor, en aan de rechterkant is een voorbeeld van de configuratie te vinden. Het voorbeeld wordt automatisch bijgewerkt als je opties wijzigt. ';
$_lang['redactor.manage_configuration_desc_redAdvancedConfigurationSet'] = 'On this page you can manage the configuration set. Below you\'ll find the raw JavaScript configuration you can edit. <a href="https://imperavi.com/redactor/docs/">Use the Imperavi Redactor Documentation</a> for the available settings and callbacks. ';
$_lang['redactor.advanced_configuration'] = 'Advanced Configuration';
$_lang['redactor.live_preview'] = 'Live voorbeeld';
$_lang['redactor.live_preview_desc_redConfigurationSet'] = 'Bij elke wijziging in de configuratie aan de linkerkant, zal dit voorbeeld automatisch bijgewerkt worden.';
$_lang['redactor.live_preview_desc_redAdvancedConfigurationSet'] = 'As long as the JavaScript on the left is valid, the preview here will automatically update.';
$_lang['redactor.live_preview_error'] = '<b>Kon het voorbeeld niet bijwerken door een fout:</b> [[+error]]<br><br>Dit kan een probleem met een plugin of Redactor zelf zijn. Soms kan het helpen om de configuratie op te slaan en de pagina te verversen. Als het probleem blijft, neem dan contact op met support met een export van de configuratie en informatie over de gebruikte browser.';

$_lang['redactor.install_ace'] = '<b>Tip!</b> If you install the <b>Ace</b> Extra from the MODX.com package manager, the advanced configuration below will use it to provide syntax highlighting and code completion.';


$_lang['redactor.add_configuration_set'] = 'Nieuwe configuratie aanmaken';
$_lang['redactor.edit_configuration_set'] = 'Bewerken';
$_lang['redactor.delete_configuration_set'] = 'Verwijderen';
$_lang['redactor.delete_configuration_set.confirm'] = 'Weet je zeker dat je deze configuratieset wilt verwijderen?';
$_lang['redactor.duplicate_configuration_set'] = 'Dupliceren';
$_lang['redactor.make_default_set'] = 'Instellen als systeem standaard';
$_lang['redactor.make_default_set.confirm_text'] = 'Dit zal de <code>redactor.configuration_set</code> systeeminstelling bijwerken om <b>[[+name]]</b> als standaard configuratie set te gebruiken.';
$_lang['redactor.make_default_set.saved'] = 'Standaard configuratie set succesvol bijgewerkt.';
$_lang['redactor.make_introtext_set'] = 'Gebruik voor de introductie tekst';
$_lang['redactor.make_introtext_set.confirm_text'] = 'Dit zal de <code>redactor.introtext.configuration_set</code> systeeminstelling bijwerken om <b>[[+name]]</b> als configuratie set te gebruiken voor de introductie tekst.';
$_lang['redactor.make_introtext_set.saved'] = 'Configuratie set voor de introductie tekst succesvol bijgewerkt.';
$_lang['redactor.export_configuration_set'] = 'Exporteren';
$_lang['redactor.export_configuration_sets'] = 'Exporteren';
$_lang['redactor.import_configuration_sets'] = 'Importeren';
$_lang['redactor.import_configuration_sets.title'] = 'Configuratiesets importeren';
$_lang['redactor.import_configuration_sets.intro'] = 'Upload een XML bestand en kies de gewenste importeer modus om configuratiesets te importeren.';


$_lang['redactor.start_import'] = 'Start importeren';
$_lang['redactor.import_file'] = 'Bestand';
$_lang['redactor.import_mode'] = 'Importeer modus';
$_lang['redactor.import_mode.insert'] = 'Toevoegen: bestaande [[+what]] laten staan, en geïmporteerde items toevoegen';
$_lang['redactor.import_mode.overwrite'] = 'Overschrijven: bestaande [[+what]] laten staan, maar overschrijven als ze hetzelfde ID hebben';
$_lang['redactor.import_mode.replace'] = 'Vervangen: eerst alle huidige [[+what]] verwijderen, en daar de nieuwe importeren.';

$_lang['redactor.error.not_an_export'] = 'Het bestand lijkt geen export van Redactor te zijn';
$_lang['redactor.error.importing_row'] = 'Fout tijdens importeren: ';
$_lang['redactor.error.xml_not_loaded'] = 'Kon het XML bestand niet laden';
$_lang['redactor.error.set_ns'] = 'Geen configuratie set opgegeven.';
$_lang['redactor.error.set_nf'] = 'Configuratie set kon niet worden gevonden.';
