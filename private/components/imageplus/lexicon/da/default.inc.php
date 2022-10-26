<?php
/**
 * Default Lexicon Entries for Image+
 *
 * @package imageplus
 * @subpackage lexicon
 */
$_lang['imageplus'] = 'Image+';
$_lang['imageplus.editor_title'] = 'Image+ editor';
$_lang['imageplus.alt_text'] = 'Alt-tekst';
$_lang['imageplus.caption'] = 'Billedtekst';
$_lang['imageplus.credits'] = 'Kreditter';
/** Input options render **/
$_lang['imageplus.input_section'] = 'Image+ Options';
$_lang['imageplus.input_section_desc'] = 'Følgende indstillinger kan tilsidesættes af kontekst-/systemindstillinger. Læs venligst <a href="https://jako.github.io/ImagePlus/usage/#contextsystem-settings" target="_blank">dokumentationen</a> for at finde de relevante taster i kontekst-/systemindstillingerne.';
$_lang['imageplus.selectConfig'] = 'Foruddefinerede målstørrelser/aspektforhold';
$_lang['imageplus.selectConfig_desc'] = 'Vælg et foruddefineret målstørrelse/aspektforhold. Definitionerne kan oprettes i systemindstillingerne.';
$_lang['imageplus.selectConfigForce'] = 'Forcerede foruddefinerede målstørrelser/aspektforhold';
$_lang['imageplus.selectConfigForce_desc'] = 'Tvangsvalg af en foruddefineret afgrødestørrelse/aspektforhold. Definitionerne kan oprettes i systemindstillingerne.';
$_lang['imageplus.targetwidth'] = 'Ønsket (minimums) bredde';
$_lang['imageplus.targetwidth_desc'] = '(Valgfrit, heltal) Målbredden for outputbilledet. Det uploadede billede skal have denne minimumsbredde.';
$_lang['imageplus.targetheight'] = 'Højde';
$_lang['imageplus.targetheight_desc'] = '(Valgfrit, heltal) Målhøjden for outputbilledet. Det uploadede billede skal have denne minimumshøjde.';
$_lang['imageplus.targetRatio'] = 'Ønsket højde- breddeforhold';
$_lang['imageplus.targetRatio_desc'] = '(Valgfri, float) Det ønskede højde-breddeforhold for billedet som en float værdi. Hvis den ønskede højde og den ønskede bredde er sat bliver denne værdi ignoreret.';
$_lang['imageplus.thumbnailWidth'] = 'Miniature bredde';
$_lang['imageplus.thumbnailWidth_desc'] = '(Valgfrit, heltal) Bredden på miniaturebilledet i TV-fanen.';
$_lang['imageplus.allowAltTag'] = 'Alternativ tekst';
$_lang['imageplus.allowAltTag_desc'] = 'Tillader brugeren at indtaste en titel/alt-tag til billedet.';
$_lang['imageplus.allowCaption'] = 'Vis feltet med billedtekst';
$_lang['imageplus.allowCaption_desc'] = 'Tillader brugeren at indtaste en billedtekst til billedet.';
$_lang['imageplus.allowCredits'] = 'Vis feltet Credits';
$_lang['imageplus.allowCredits_desc'] = 'Tillader brugeren at angive en kredit for billedet.';
/** Output options render **/
$_lang['imageplus.phpThumbParams'] = 'Ekstra phpThumb parametre';
$_lang['imageplus.phpThumbParams_desc'] = 'Tilføj ekstra filtre osv. til phpThumb. Dokumentationen kan findes <a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.readme.txt" target="_blank">her</a>.';
$_lang['imageplus.outputChunk'] = 'Output chunk';
$_lang['imageplus.outputChunk_desc'] = 'Vælg en chunk til tv-udgang. Lad det være tomt for rå url-udgang.';
$_lang['imageplus.generateUrl'] = 'Generer URL til miniature';
$_lang['imageplus.generateUrl_desc'] = '(Valgfrit) URL til miniature er måske ikke nødvendigt hvis du generer miniaturen i output chunk\'en f.eks. ved brug af pthumb output filter.';
$_lang['imageplus.generateUrl_desc_warning'] = 'Du skal aktivere denne indstilling, når du ikke angiver en output chunk i outputindstillingerne, eller når du bruger [[+url]]-pladsholderen [[+url]] i den angivne output chunk. Ellers beskæres/formindskes billedet ikke, og den originale billedsti returneres.';
/** Placeholder descriptions */
$_lang['imageplus.placeholder.url'] = 'URL til miniaturebilledet';
$_lang['imageplus.placeholder.alt'] = 'Alt-tekst';
$_lang['imageplus.placeholder.width'] = 'Miniaturebredde (ignoreret ved 0)';
$_lang['imageplus.placeholder.height'] = 'Miniaturehøjde (ignoreret ved 0)';
$_lang['imageplus.placeholder.source.src'] = 'Stien til kildebilledet';
$_lang['imageplus.placeholder.source.width'] = 'Bredden på kildebilledet';
$_lang['imageplus.placeholder.source.height'] = 'Højden på kildebilledet';
$_lang['imageplus.placeholder.crop.width'] = 'Beskær kildebilledets bredde';
$_lang['imageplus.placeholder.crop.height'] = 'Beskær kildebilledets højde';
$_lang['imageplus.placeholder.crop.x'] = 'Beskær x placering af kildebilledet';
$_lang['imageplus.placeholder.crop.y'] = 'Beskær y placering af kildebilledet';
$_lang['imageplus.placeholder.options'] = 'phpThumb indstillingsstreng til at generere miniaturebilledet';
$_lang['imageplus.placeholder.crop.options'] = 'phpThumb beskæringsindstillingsstreng til at generere miniaturebilledet';
$_lang['imageplus.error.image_too_small.title'] = 'Billedet er for lille';
$_lang['imageplus.error.image_too_small.msg'] = 'Det valgte billede er for småt til at blive brugt her. Vælg venligst et andet billede.';
$_lang['imageplus.error.image_not_found.title'] = 'Billedet blev ikke fundet';
$_lang['imageplus.error.image_not_found.msg'] = 'Billedet blev ikke fundet og kan dermed ikke blive beskåret. Vælg venligst et andet billede.';
