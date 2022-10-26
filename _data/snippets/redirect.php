id: 20
source: 2
name: redirect
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * redirect
 *
 * redirect to resource and add (optional) hash
 *
 * Usage examples:
 * [[redirect? &urlHash=`#/lorem/` &id=`1`]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */

// Properties 
$urlHash = $modx->getOption('urlHash', $scriptProperties);
$id = $modx->getOption('id', $scriptProperties, 1, true);

// redirect
$url = $modx->makeUrl($id) . $urlHash;
$modx->sendRedirect($url);