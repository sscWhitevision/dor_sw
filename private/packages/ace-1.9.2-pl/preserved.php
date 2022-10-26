<?php return array (
  'b5285360db06e01615a6dfbbc06d4a4a' => 
  array (
    'criteria' => 
    array (
      'name' => 'ace',
    ),
    'object' => 
    array (
      'name' => 'ace',
      'path' => '{core_path}components/ace/',
      'assets_path' => '',
    ),
  ),
  '2a07f10f0222f3b7145ca4c35463748c' => 
  array (
    'criteria' => 
    array (
      'name' => 'Ace',
    ),
    'object' => 
    array (
      'id' => 1,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Ace',
      'description' => 'Ace code editor plugin for MODx Revolution',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Ace Source Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,
 * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,
 * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender
 *
 * @author Danil Kostin <danya.postfactum(at)gmail.com>
 *
 * @package ace
 *
 * @var array $scriptProperties
 * @var Ace $ace
 */
if ($modx->event->name == \'OnRichTextEditorRegister\') {
    $modx->event->output(\'Ace\');
    return;
}

if ($modx->getOption(\'which_element_editor\', null, \'Ace\') !== \'Ace\') {
    return;
}

$ace = $modx->getService(\'ace\', \'Ace\', $modx->getOption(\'ace.core_path\', null, $modx->getOption(\'core_path\').\'components/ace/\').\'model/ace/\');
$ace->initialize();

$extensionMap = array(
    \'tpl\'   => \'text/x-smarty\',
    \'htm\'   => \'text/html\',
    \'html\'  => \'text/html\',
    \'css\'   => \'text/css\',
    \'scss\'  => \'text/x-scss\',
    \'less\'  => \'text/x-less\',
    \'svg\'   => \'image/svg+xml\',
    \'xml\'   => \'application/xml\',
    \'xsl\'   => \'application/xml\',
    \'js\'    => \'application/javascript\',
    \'json\'  => \'application/json\',
    \'php\'   => \'application/x-php\',
    \'sql\'   => \'text/x-sql\',
    \'md\'    => \'text/x-markdown\',
    \'txt\'   => \'text/plain\',
    \'twig\'  => \'text/x-twig\'
);

// Define default mime for html elements(templates, chunks and html resources)
$html_elements_mime=$modx->getOption(\'ace.html_elements_mime\',null,false);
if(!$html_elements_mime){
    // this may deprecated in future because components may set ace.html_elements_mime option now
    switch (true) {
        case $modx->getOption(\'twiggy_class\'):
            $html_elements_mime = \'text/x-twig\';
            break;
        case $modx->getOption(\'pdotools_fenom_parser\'):
            $html_elements_mime = \'text/x-smarty\';
            break;
        default:
            $html_elements_mime = \'text/html\';
    }
}

// Defines wether we should highlight modx tags
$modxTags = false;
switch ($modx->event->name) {
    case \'OnSnipFormPrerender\':
        $field = \'modx-snippet-snippet\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnTempFormPrerender\':
        $field = \'modx-template-content\';
        $modxTags = true;
        $mimeType = $html_elements_mime;
        break;
    case \'OnChunkFormPrerender\':
        $field = \'modx-chunk-snippet\';
        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {
            $extension = pathinfo($modx->controller->chunk->name, PATHINFO_EXTENSION);
            if(!$extension||!isset($extensionMap[$extension])){
                $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);
            }
            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : \'text/plain\';
        } else {
            $mimeType = $html_elements_mime;
        }
        $modxTags = true;
        break;
    case \'OnPluginFormPrerender\':
        $field = \'modx-plugin-plugincode\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnFileCreateFormPrerender\':
        $field = \'modx-file-content\';
        $mimeType = \'text/plain\';
        break;
    case \'OnFileEditFormPrerender\':
        $field = \'modx-file-content\';
        $extension = pathinfo($scriptProperties[\'file\'], PATHINFO_EXTENSION);
        $mimeType = isset($extensionMap[$extension])
            ? $extensionMap[$extension]
            : (\'@FILE:\'.pathinfo($scriptProperties[\'file\'], PATHINFO_BASENAME));
        $modxTags = $extension == \'tpl\';
        break;
    case \'OnDocFormPrerender\':
        if (!$modx->controller->resourceArray) {
            return;
        }
        $field = \'ta\';
        $mimeType = $modx->getObject(\'modContentType\', $modx->controller->resourceArray[\'content_type\'])->get(\'mime_type\');

        if($mimeType == \'text/html\')$mimeType = $html_elements_mime;

        if ($modx->getOption(\'use_editor\')){
            $richText = $modx->controller->resourceArray[\'richtext\'];
            $classKey = $modx->controller->resourceArray[\'class_key\'];
            if ($richText || in_array($classKey, array(\'modStaticResource\',\'modSymLink\',\'modWebLink\',\'modXMLRPCResource\'))) {
                $field = false;
            }
        }
        $modxTags = true;
        break;
    default:
        return;
}

$modxTags = (int) $modxTags;
$script = \'\';
if ($field) {
    $script .= "MODx.ux.Ace.replaceComponent(\'$field\', \'$mimeType\', $modxTags);";
}

if ($modx->event->name == \'OnDocFormPrerender\' && !$modx->getOption(\'use_editor\')) {
    $script .= "MODx.ux.Ace.replaceTextAreas(Ext.query(\'.modx-richtext\'));";
}

if ($script) {
    $modx->controller->addHtml(\'<script>Ext.onReady(function() {\' . $script . \'});</script>\');
}',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'ace/elements/plugins/ace.plugin.php',
      'content' => '/**
 * Ace Source Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnSnipFormPrerender,
 * OnTempFormPrerender, OnChunkFormPrerender, OnPluginFormPrerender,
 * OnFileCreateFormPrerender, OnFileEditFormPrerender, OnDocFormPrerender
 *
 * @author Danil Kostin <danya.postfactum(at)gmail.com>
 *
 * @package ace
 *
 * @var array $scriptProperties
 * @var Ace $ace
 */
if ($modx->event->name == \'OnRichTextEditorRegister\') {
    $modx->event->output(\'Ace\');
    return;
}

if ($modx->getOption(\'which_element_editor\', null, \'Ace\') !== \'Ace\') {
    return;
}

$ace = $modx->getService(\'ace\', \'Ace\', $modx->getOption(\'ace.core_path\', null, $modx->getOption(\'core_path\').\'components/ace/\').\'model/ace/\');
$ace->initialize();

$extensionMap = array(
    \'tpl\'   => \'text/x-smarty\',
    \'htm\'   => \'text/html\',
    \'html\'  => \'text/html\',
    \'css\'   => \'text/css\',
    \'scss\'  => \'text/x-scss\',
    \'less\'  => \'text/x-less\',
    \'svg\'   => \'image/svg+xml\',
    \'xml\'   => \'application/xml\',
    \'xsl\'   => \'application/xml\',
    \'js\'    => \'application/javascript\',
    \'json\'  => \'application/json\',
    \'php\'   => \'application/x-php\',
    \'sql\'   => \'text/x-sql\',
    \'md\'    => \'text/x-markdown\',
    \'txt\'   => \'text/plain\',
    \'twig\'  => \'text/x-twig\'
);

// Define default mime for html elements(templates, chunks and html resources)
$html_elements_mime=$modx->getOption(\'ace.html_elements_mime\',null,false);
if(!$html_elements_mime){
    // this may deprecated in future because components may set ace.html_elements_mime option now
    switch (true) {
        case $modx->getOption(\'twiggy_class\'):
            $html_elements_mime = \'text/x-twig\';
            break;
        case $modx->getOption(\'pdotools_fenom_parser\'):
            $html_elements_mime = \'text/x-smarty\';
            break;
        default:
            $html_elements_mime = \'text/html\';
    }
}

// Defines wether we should highlight modx tags
$modxTags = false;
switch ($modx->event->name) {
    case \'OnSnipFormPrerender\':
        $field = \'modx-snippet-snippet\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnTempFormPrerender\':
        $field = \'modx-template-content\';
        $modxTags = true;
        $mimeType = $html_elements_mime;
        break;
    case \'OnChunkFormPrerender\':
        $field = \'modx-chunk-snippet\';
        if ($modx->controller->chunk && $modx->controller->chunk->isStatic()) {
            $extension = pathinfo($modx->controller->chunk->name, PATHINFO_EXTENSION);
            if(!$extension||!isset($extensionMap[$extension])){
                $extension = pathinfo($modx->controller->chunk->getSourceFile(), PATHINFO_EXTENSION);
            }
            $mimeType = isset($extensionMap[$extension]) ? $extensionMap[$extension] : \'text/plain\';
        } else {
            $mimeType = $html_elements_mime;
        }
        $modxTags = true;
        break;
    case \'OnPluginFormPrerender\':
        $field = \'modx-plugin-plugincode\';
        $mimeType = \'application/x-php\';
        break;
    case \'OnFileCreateFormPrerender\':
        $field = \'modx-file-content\';
        $mimeType = \'text/plain\';
        break;
    case \'OnFileEditFormPrerender\':
        $field = \'modx-file-content\';
        $extension = pathinfo($scriptProperties[\'file\'], PATHINFO_EXTENSION);
        $mimeType = isset($extensionMap[$extension])
            ? $extensionMap[$extension]
            : (\'@FILE:\'.pathinfo($scriptProperties[\'file\'], PATHINFO_BASENAME));
        $modxTags = $extension == \'tpl\';
        break;
    case \'OnDocFormPrerender\':
        if (!$modx->controller->resourceArray) {
            return;
        }
        $field = \'ta\';
        $mimeType = $modx->getObject(\'modContentType\', $modx->controller->resourceArray[\'content_type\'])->get(\'mime_type\');

        if($mimeType == \'text/html\')$mimeType = $html_elements_mime;

        if ($modx->getOption(\'use_editor\')){
            $richText = $modx->controller->resourceArray[\'richtext\'];
            $classKey = $modx->controller->resourceArray[\'class_key\'];
            if ($richText || in_array($classKey, array(\'modStaticResource\',\'modSymLink\',\'modWebLink\',\'modXMLRPCResource\'))) {
                $field = false;
            }
        }
        $modxTags = true;
        break;
    default:
        return;
}

$modxTags = (int) $modxTags;
$script = \'\';
if ($field) {
    $script .= "MODx.ux.Ace.replaceComponent(\'$field\', \'$mimeType\', $modxTags);";
}

if ($modx->event->name == \'OnDocFormPrerender\' && !$modx->getOption(\'use_editor\')) {
    $script .= "MODx.ux.Ace.replaceTextAreas(Ext.query(\'.modx-richtext\'));";
}

if ($script) {
    $modx->controller->addHtml(\'<script>Ext.onReady(function() {\' . $script . \'});</script>\');
}',
    ),
  ),
  '68d2d858a8e7b2ec9bc2d07f65a966c6' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnChunkFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnChunkFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ac4aa9d04a39a549cf603b0d0a8dbcbc' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnPluginFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnPluginFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '0eb530a614c5b2d71503adfc179fb445' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnSnipFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnSnipFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'db01dd499b0bceda67a4e28efb71b69d' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnTempFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnTempFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'bf9a8f7ddd1c728d16c52bb8e8c64988' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnFileEditFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnFileEditFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '9073971a703c2611775bcd772c7e1813' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnFileCreateFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnFileCreateFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '5b2ddc4fcdaf4a0fdc95950063c08ac1' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7b87944b81080fc7c8c550dcb1b46381' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnRichTextEditorRegister',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnRichTextEditorRegister',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '77d41b3edda875af24e713ef83c48f34' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 1,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 1,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ff4b70c9beb2c4a017bb16da83042335' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.theme',
    ),
    'object' => 
    array (
      'key' => 'ace.theme',
      'value' => 'chrome',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a7a75475347b05b518a37f1555f7719c' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.font_size',
    ),
    'object' => 
    array (
      'key' => 'ace.font_size',
      'value' => '13px',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'aaec439e040399b5ea899f1d4a31c2c4' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.word_wrap',
    ),
    'object' => 
    array (
      'key' => 'ace.word_wrap',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7072828c0756d8b19267249b53a8e22e' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.soft_tabs',
    ),
    'object' => 
    array (
      'key' => 'ace.soft_tabs',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '987b7d1e7a82b88008864a9200fbb8ad' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.tab_size',
    ),
    'object' => 
    array (
      'key' => 'ace.tab_size',
      'value' => '4',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'e6f990a8ff57a4f494e42fb558eff8c1' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.fold_widgets',
    ),
    'object' => 
    array (
      'key' => 'ace.fold_widgets',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'f438eef506b8d6df61c937e5c292bfb4' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.show_invisibles',
    ),
    'object' => 
    array (
      'key' => 'ace.show_invisibles',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ef4316f048de082de5d5e429f0bb895f' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.snippets',
    ),
    'object' => 
    array (
      'key' => 'ace.snippets',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7d6d27d2c0b4ed905cfe2ca7fc3bea25' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.height',
    ),
    'object' => 
    array (
      'key' => 'ace.height',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '1fb61f8f0369e0de351fff81802de06c' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.grow',
    ),
    'object' => 
    array (
      'key' => 'ace.grow',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '3db42b2424e219b582d40ea452aa5279' => 
  array (
    'criteria' => 
    array (
      'key' => 'ace.html_elements_mime',
    ),
    'object' => 
    array (
      'key' => 'ace.html_elements_mime',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'ace',
      'area' => 'general',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
);