id: 50
source: 2
name: templatingJSON
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

$tpl = $options;

$array = json_decode($input, true);

$output = '';
foreach ($array as $placeholder) {
    $output .= $modx->getChunk($tpl, $placeholder);
}

return $output;