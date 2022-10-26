id: 28
source: 2
name: getNavAnchor
category: 'Snippets and Output-Filters'
properties: 'a:0:{}'

-----

/*
 * getNavAnchor
 *
 * templates the anchor navigation of CB modules
 * getting the CB settings of every module/layout:
 * if [[+navAnchorTitle]] is not empty - return nav item
 *
 * Usage examples:
 * [[getNavAnchor? &resource=`[[+id]]`]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */


// script properties
$navid = (int)$modx->getOption('resource', $scriptProperties, $modx->resource->id);
$tpl = $modx->getOption('tpl', $scriptProperties, 'navAnchorTpl', true);
$classes = $modx->getOption('classes', $scriptProperties);


// getResource Object
$resource = $modx->getObject('modResource', $navid);

// Make sure we have a resource or end here
if (!$resource) {
    return '';
}


// Make sure this is a contentblocks-enabled resource
$enabled = $resource->getProperty('_isContentBlocks', 'contentblocks');
if ($enabled !== true) return;


// get layouts
$layouts = json_decode($resource->getProperty('content', 'contentblocks'), true);

//echo '<pre>';
//die(print_r($layouts));

// set nav links
$nav_links = array();
foreach ($layouts as $layout) {
    if (!empty($layout['settings']['anchor'])) {
        
        $anchor = empty($layout['settings']['id']) ? $layout['settings']['anchor'] : $layout['settings']['id'];
        $anchor = $modx->filterPathSegment($anchor);
        
        $nav_links[] = array(
            'title' => $layout['settings']['anchor'],
            'link' => $modx->makeUrl($navid) . '#' . $anchor,
        );
    }
    
    // check special Modules to create sub anchor (Tab modules)
    if ($layout['layout'] == 7) {   // Module: Tabs-Karriere
        foreach ($layout['content']['main'][0]['rows'] as $link) {
            if (!empty($link['anchor']['value'])) {
                $nav_links[] = array(
                    'title' => $link['anchor']['value'],
                    'link' => $modx->makeUrl($navid) . '#' . $modx->filterPathSegment($link['anchor']['value']),
                );
            }
        }
    }
}


// templating links
$output = '';
foreach ($nav_links as $link) {
    $output .= $modx->getChunk($tpl, $link);
}

// set placeholder if nav exists
if (!empty($output)) {
    $modx->toPlaceholders(array(
        'headerClass' => 'anchornav',
    ),'an');
}

return $output;