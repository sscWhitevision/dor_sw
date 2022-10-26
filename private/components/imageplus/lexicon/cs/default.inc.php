<?php
/**
 * Default Lexicon Entries for Image+
 *
 * @package imageplus
 * @subpackage lexicon
 */
$_lang['imageplus'] = 'Image+';
$_lang['imageplus.editor_title'] = 'Image+ Editor';
$_lang['imageplus.alt_text'] = 'Alt text';
$_lang['imageplus.caption'] = 'Titulek';
$_lang['imageplus.credits'] = 'Kredity';
/** Input options render **/
$_lang['imageplus.input_section'] = 'Image+ Options';
$_lang['imageplus.input_section_desc'] = 'Následující možnosti mohou být přepsány kontextovým/systémovým nastavením. Příslušné klíče v kontextovém/systémovém nastavení naleznete v <a href="https://jako.github.io/ImagePlus/usage/#contextsystem-settings" target="_blank">dokumentaci</a>.';
$_lang['imageplus.selectConfig'] = 'Předdefinované velikosti cílů/poměry stran';
$_lang['imageplus.selectConfig_desc'] = 'Zvolte předem definovaný cílový poměr velikostí a stran. Definice lze vytvořit v nastavení systému.';
$_lang['imageplus.selectConfigForce'] = 'Vynucené předdefinované velikosti cílů/poměr stran';
$_lang['imageplus.selectConfigForce_desc'] = 'Vynucený výběr předem definované velikosti ořezu/poměru stran. Definice lze vytvořit v nastavení systému.';
$_lang['imageplus.targetwidth'] = 'Cílová šířka (minimální)';
$_lang['imageplus.targetwidth_desc'] = '(Volitelné, celé číslo) Cílová šířka pro výstupní obrázek. Nahraný obrázek by neměl být menší.';
$_lang['imageplus.targetheight'] = 'Cílová výška (minimální)';
$_lang['imageplus.targetheight_desc'] = '(Volitelné, celé číslo) Cílová výška pro výstupní obrázek. Nahraný obrázek by neměl být menší.';
$_lang['imageplus.targetRatio'] = 'Cílový poměr stran';
$_lang['imageplus.targetRatio_desc'] = '(Volitelné, plovoucí) Cílový poměr stran výstupního obrázku. Pokud je nastavena cílová výška a šířka, tato hodnota je ignorována.';
$_lang['imageplus.thumbnailWidth'] = 'Šířka miniatury';
$_lang['imageplus.thumbnailWidth_desc'] = '(Volitelné, celé číslo) Šířka miniatury v panelu Template variable.';
$_lang['imageplus.allowAltTag'] = 'Zobrazit pole "alt" tag';
$_lang['imageplus.allowAltTag_desc'] = 'Povolit uživatelům zadat title/alt.';
$_lang['imageplus.allowCaption'] = 'Zobrazit pole titulků';
$_lang['imageplus.allowCaption_desc'] = 'Umožňuje uživateli zadat popisek k obrázku.';
$_lang['imageplus.allowCredits'] = 'Zobrazit pole Kredity';
$_lang['imageplus.allowCredits_desc'] = 'Umožnit uživateli zadat kredit obrázku.';
/** Output options render **/
$_lang['imageplus.phpThumbParams'] = 'Další phpThumb parametry';
$_lang['imageplus.phpThumbParams_desc'] = 'Přidání dalších filtrů atd. pro phpThumb. Dokumentaci najdete <a href="http://phpthumb.sourceforge.net/demo/docs/phpthumb.readme.txt" target="_blank">zde</a>.';
$_lang['imageplus.outputChunk'] = 'Výstupní chunk';
$_lang['imageplus.outputChunk_desc'] = 'Vyberte chunk pro výstup TV. Nechte prázdé pro výstup čisté URL.';
$_lang['imageplus.generateUrl'] = 'Generovat URL miniatury';
$_lang['imageplus.generateUrl_desc'] = '(Volitelné) URL miniatury možná není třeba, pokud miniaturu generujete v chunku (například pomocí pthumb).';
$_lang['imageplus.generateUrl_desc_warning'] = 'Tuto možnost musíte aktivovat, pokud ve výstupních možnostech nezadáte výstupní oddíl nebo pokud v zadaném výstupním oddílu použijete zástupný znak [[+url]]. Jinak se obrázek neořízne/nezmění velikost a vrátí se původní cesta k obrázku.';
/** Placeholder descriptions */
$_lang['imageplus.placeholder.url'] = 'URL miniatury';
$_lang['imageplus.placeholder.alt'] = 'Alt text';
$_lang['imageplus.placeholder.width'] = 'Šířka miniatury (ignorováno pokud je 0)';
$_lang['imageplus.placeholder.height'] = 'Výška miniatury (ignorováno pokud je 0)';
$_lang['imageplus.placeholder.source.src'] = 'Cesta ke zdrojovému obrázku';
$_lang['imageplus.placeholder.source.width'] = 'Šířka zdrojového obrázku';
$_lang['imageplus.placeholder.source.height'] = 'Výška zdrojového obrázku';
$_lang['imageplus.placeholder.crop.width'] = 'Oříznout šířku zdrojového obrázku';
$_lang['imageplus.placeholder.crop.height'] = 'Oříznout výšku zdrojového obrázku';
$_lang['imageplus.placeholder.crop.x'] = 'Oříznout podle X osy zdrojového obrázku';
$_lang['imageplus.placeholder.crop.y'] = 'Oříznout podle Y osy zdrojového obrázku';
$_lang['imageplus.placeholder.options'] = 'phpThumb řetězec pro generování miniatur';
$_lang['imageplus.placeholder.crop.options'] = 'phpThumb řetězec ořezu pro generování miniatur';
$_lang['imageplus.error.image_too_small.title'] = 'Obrázek je příliš malý';
$_lang['imageplus.error.image_too_small.msg'] = 'Vybraný obrázek je moc malý pro použití. Prosím vyberte jiný obrázek.';
$_lang['imageplus.error.image_not_found.title'] = 'Obrázek nebyl nalezen';
$_lang['imageplus.error.image_not_found.msg'] = 'Obrázek nebyl nalezen a nelze ho oříznout. Prosím vyberte jiný obrázek.';
