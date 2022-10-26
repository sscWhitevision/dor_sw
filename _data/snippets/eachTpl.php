id: 16
source: 2
name: eachTpl
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * eachTpl
 *
 * templating a comma separted list of items to a chunk-template
 *
 * Usage examples:
 * [[*tvName:eachTpl=`chunkNameTpl`]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */
 
 
$items = explode(',', $input);
$tpl = $options;
$output = '';

foreach ($items as $item) {
    $output .= $modx->getChunk($tpl,array(
        'data' => $item,
    ));
}

return $output;