id: 22
source: 2
name: setLocale
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * setLocale
 *
 * sets the locale for month names in the current language
 *
 * Usage examples:
 * [[*publishedon:setLocale:date=`%B`]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */

$locale = $modx->getOption('locale', null, 'de_DE.utf8');

setlocale(LC_ALL, $locale);

return $input;