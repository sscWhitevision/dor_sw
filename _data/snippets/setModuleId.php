id: 27
source: 2
name: setModuleId
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * setModuleId
 *
 * sets an html id tag if the CB setting [[+anchor]] is set
 *
 * Usage examples:
 * [[+id:setModuleId]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */

$id = empty($input) ? $options : $input;
if (empty($id)) return;

return 'id="' . $modx->filterPathSegment($id) . '" data-nav-section="' . $modx->filterPathSegment($id) . '"';