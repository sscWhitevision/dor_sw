id: 31
source: 2
name: HideContentManagerCustomizations
properties: 'a:0:{}'

-----

// for non admins
if (!$modx->user->isMember('Administrator')) {
    $css = '
    <style>
        #modx-resource-content {
            display: none;
        }
    </style>
    ';
    
    
    // CSS Styles for templates, resources and parents
    $resource_id = $modx->resource->get('id');
    $resource_template = $modx->resource->get('template');
    $resource_parent = $modx->resource->get('parent');
    
    $resources = array(); // ID of resources
    $templates = array(9); // ID of templates
    $parents = array(); // ID of parents
    
    
    if (in_array($resource_id, $resources) xor in_array($resource_template, $templates) xor in_array($resource_parent, $parents)) {
        $modx->regClientCSS($css);   
    }
}


return '';