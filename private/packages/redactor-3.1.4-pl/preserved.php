<?php return array (
  '274c2744962d864a2d24fd6b896f2356' => 
  array (
    'criteria' => 
    array (
      'name' => 'redactor',
    ),
    'object' => 
    array (
      'name' => 'redactor',
      'path' => '{core_path}components/redactor/',
      'assets_path' => '{assets_path}components/redactor/',
    ),
  ),
  'cfb2fd6a1681a88da1be9b1ec9b4f664' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.configuration_set',
    ),
    'object' => 
    array (
      'key' => 'redactor.configuration_set',
      'value' => '4',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'configuration',
      'editedon' => '2020-01-16 16:50:37',
    ),
  ),
  '9047dcfd760e080e3a9674691dd46c19' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.introtext',
    ),
    'object' => 
    array (
      'key' => 'redactor.introtext',
      'value' => '',
      'xtype' => 'modx-combo-boolean',
      'namespace' => 'redactor',
      'area' => 'configuration',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '311da2284c5feb890adbbab1be0830a6' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.introtext.configuration_set',
    ),
    'object' => 
    array (
      'key' => 'redactor.introtext.configuration_set',
      'value' => '1',
      'xtype' => 'numberfield',
      'namespace' => 'redactor',
      'area' => 'configuration',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a803d3665405735241ed9cc3632847f8' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.css',
    ),
    'object' => 
    array (
      'key' => 'redactor.css',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '116bb475c1a0cb889d91837178cad623' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.js',
    ),
    'object' => 
    array (
      'key' => 'redactor.js',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'configuration',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '084a5ba7d67a5cc3031afcb8060daf7b' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.sanitizePattern',
    ),
    'object' => 
    array (
      'key' => 'redactor.sanitizePattern',
      'value' => '/([[:alnum:]_\\.-]*)/',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '2c2bd68d010320e16f4afb71286a828e' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.sanitizeReplace',
    ),
    'object' => 
    array (
      'key' => 'redactor.sanitizeReplace',
      'value' => '_',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'Advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '097a225f0f8c1ed5d0bdbdc2d390abd5' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.translit',
    ),
    'object' => 
    array (
      'key' => 'redactor.translit',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '69fda44e4b07a8d040d254f352013f94' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.translit_class',
    ),
    'object' => 
    array (
      'key' => 'redactor.translit_class',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '3b420eb29686dd5c35edf960475de651' => 
  array (
    'criteria' => 
    array (
      'key' => 'redactor.translit_class_path',
    ),
    'object' => 
    array (
      'key' => 'redactor.translit_class_path',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'redactor',
      'area' => 'advanced',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c6926024effee8e4032a3cd0b69f764e' => 
  array (
    'criteria' => 
    array (
      'text' => 'redactor.configuration',
    ),
    'object' => 
    array (
      'text' => 'redactor.configuration',
      'parent' => 'components',
      'action' => 'configuration',
      'description' => 'redactor.configuration.menu_desc',
      'icon' => '',
      'menuindex' => 5,
      'params' => '',
      'handler' => '',
      'permissions' => 'redactor_configurator',
      'namespace' => 'redactor',
    ),
  ),
  'bbb6fbb64fb3beaed4823a741110dd14' => 
  array (
    'criteria' => 
    array (
      'name' => 'RedactorTemplate',
    ),
    'object' => 
    array (
      'id' => 10,
      'template_group' => 1,
      'name' => 'RedactorTemplate',
      'description' => 'Policy Template for access to the Redactor configurator.',
      'lexicon' => 'redactor:permissions',
    ),
  ),
  '20603300b1c81ca18dd7fda28c26e96e' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_configurator',
    ),
    'object' => 
    array (
      'id' => 260,
      'template' => 10,
      'name' => 'redactor_configurator',
      'description' => 'redactor.permission.configurator',
      'value' => 1,
    ),
  ),
  'fe04d528370dde58b26f748f70e8c2c1' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_view',
    ),
    'object' => 
    array (
      'id' => 261,
      'template' => 10,
      'name' => 'redactor_sets_view',
      'description' => 'redactor.permission.sets_view',
      'value' => 1,
    ),
  ),
  '9f8fedde839ae55063a3ba206b841087' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_create',
    ),
    'object' => 
    array (
      'id' => 262,
      'template' => 10,
      'name' => 'redactor_sets_create',
      'description' => 'redactor.permission.sets_create',
      'value' => 1,
    ),
  ),
  '9480a0bd99d6d3afe4b97b4596af4285' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_save',
    ),
    'object' => 
    array (
      'id' => 263,
      'template' => 10,
      'name' => 'redactor_sets_save',
      'description' => 'redactor.permission.sets_save',
      'value' => 1,
    ),
  ),
  '03ee1d1a5da72642494c82af568582b4' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_export',
    ),
    'object' => 
    array (
      'id' => 264,
      'template' => 10,
      'name' => 'redactor_sets_export',
      'description' => 'redactor.permission.sets_export',
      'value' => 1,
    ),
  ),
  '55279cd8e37b1c4fa1c3d42342f8fa88' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_import',
    ),
    'object' => 
    array (
      'id' => 265,
      'template' => 10,
      'name' => 'redactor_sets_import',
      'description' => 'redactor.permission.sets_import',
      'value' => 1,
    ),
  ),
  '0195a424c448bee93538b6124c0b9447' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'redactor_sets_delete',
    ),
    'object' => 
    array (
      'id' => 266,
      'template' => 10,
      'name' => 'redactor_sets_delete',
      'description' => 'redactor.permission.sets_delete',
      'value' => 1,
    ),
  ),
  '07c7d9e8623c800511cade6425e77438' => 
  array (
    'criteria' => 
    array (
      'template' => 10,
      'name' => 'Redactor Full Access',
    ),
    'object' => 
    array (
      'id' => 16,
      'name' => 'Redactor Full Access',
      'description' => 'Access Policy for Redactor that gives full access to the configurator. Overwritten on upgrade.',
      'parent' => 0,
      'template' => 10,
      'class' => '',
      'data' => '{"redactor_configurator":true,"redactor_sets_view":true,"redactor_sets_create":true,"redactor_sets_save":true,"redactor_sets_export":true,"redactor_sets_import":true,"redactor_sets_delete":true,"formit":true,"formit_encryptions":false}',
      'lexicon' => 'redactor:permissions',
    ),
  ),
  'a07669a6651d73bcf51199984739f676' => 
  array (
    'criteria' => 
    array (
      'name' => 'Redactor',
    ),
    'object' => 
    array (
      'id' => 10,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Redactor',
      'description' => 'Redactor WYSIWYG editor plugin for MODX Revolution',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Redactor WYSIWYG Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnRichTextBrowserInit, OnDocFormPrerender
 *
 * @author JP DeVries <mail@devries.jp>
 *
 * @package redactor
 */

$corePath = $modx->getOption(\'redactor.core_path\', null, $modx->getOption(\'core_path\').\'components/redactor/\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tvs/input/\');
        break;

    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/inputoptions/\');
        break;

    case \'OnRichTextEditorRegister\':
        $modx->event->output(\'Redactor\');
        break;

    case \'OnFileManagerFileRename\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }
        $redactor->renames[] = $path;

        break;

    case \'OnRichTextEditorInit\':
        /**
         * @var string $editor
         * @var array $elements
         *
         * Only load up the editor if the editor is Redactor, and use_editor is enabled.
         */
        $rte = isset($editor) ? $editor : $modx->getOption(\'which_editor\', null, \'\');
        if ($rte !== \'Redactor\' || !$modx->getOption(\'use_editor\', null, true)) {
            return;
        }

        /**
         * Attempt to load the Redactor service class. Log error and halt processing if it fails.
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        if (isset($resource) && $resource instanceof modResource) {
            $redactor->setResource($resource);
        }
        elseif ($modx->resource && $modx->resource instanceof modResource) {
            $redactor->setResource($modx->resource);
        }
        elseif ($modx->controller && isset($modx->controller->resource) && $modx->controller->resource instanceof modResource) {
            $redactor->setResource($modx->controller->resource);
        }

        // Make sure global assets are loaded
        $redactor->initialize();

        $set = (int)$redactor->getOption(\'redactor.configuration_set\', null, 1, true);
        if (isset($resource)
            && ($resource instanceof modResource)
            && ($template = $resource->getOne(\'Template\'))
            && ($template instanceof modTemplate)
        ) {
            $props = $template->getProperties();
            $templateSet = array_key_exists(\'redactor.configuration_set\', $props) ? (int)$props[\'redactor.configuration_set\'] : 0;
            if ($templateSet > 0) {
                $set = $templateSet;
            }
        }

        $major = (int)$modx->getVersionData()[\'version\'];
        $html = <<<HTML
<script type="text/javascript">
document.documentElement.className += \' redactor-modx{$major}\';
var RedactorConfigurationSet = $set;
</script>
HTML;

        $modx->event->output($html);
        break;

    case \'ContentBlocks_RegisterInputs\':
        /**
         * @var modX $modx
         * @var ContentBlocks $contentBlocks
         * @var array $scriptProperties
         */
        if (class_exists(\'cbBaseInput\')) {
            require_once($corePath . \'elements/inputs/redactor_input.class.php\');
            $modx->event->output([
                \'redactor\' => new RedactorInput($contentBlocks)
            ]);
        }
        break;

    case \'FredBeforeRender\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        $assetsUrl = $redactor->config[\'assetsUrl\'];

        $version = \'?v=\' . $this->redactor->version;
        $css = <<<HTML
<link rel="stylesheet" href="{$assetsUrl}vendor/imperavi/redactor/redactor.min.css{$version}">
<link rel="stylesheet" href="{$assetsUrl}vendor/codemirror/codemirror.css{$version}">
<link rel="stylesheet" href="{$assetsUrl}dist/modxredactor.min.css{$version}">
HTML;
        if ($customCss = $redactor->getOption(\'redactor.css\')) {
            $customCss = array_filter(array_map(\'trim\', explode(\',\', $customCss)));
            foreach ($customCss as $url) {
                $css .= \'<link rel="stylesheet" href="\' . $url . $version . \'">\';
            }
        }

        $js = <<<HTML
<script type="text/javascript" src="{$assetsUrl}dist/imperavi/redactor.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}dist/plugins.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}dist/codemirror.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}js/fredactor.js{$version}"></script>
HTML;
        if ($customJs = $redactor->getOption(\'redactor.js\')) {
            $customJs = array_filter(array_map(\'trim\', explode(\',\', $customJs)));
            foreach ($customJs as $url) {
                $js .= \'<script type="text/javascript" src="\' . $url . $version . \'"></script>\';
            }
        }
        // Primary redactor scripts and the generated configuration sets
        $js .= \'<script type="text/javascript" src="\' . $assetsUrl . \'dist/modxredactor.min.js\' . $version . \'"></script>\';
        $js .= $redactor->getGeneratedConfigurationSets([Redactor::OPT_IS_FRED => true]);

        // Make the resource/wctx available
        if (isset($modx->resource) && $modx->resource instanceof modResource) {
            $redactor->setResource($modx->resource);
        }

        // Get the default configuration set to use from template or setting. This can be overriden with a Fred RTE Config.
        $set = (int)$redactor->getOption(\'redactor.configuration_set\', null, 1, true);
        if (isset($modx->resource)
            && ($modx->resource instanceof modResource)
            && ($template = $modx->resource->getOne(\'Template\'))
            && ($template instanceof modTemplate)
        ) {
            $props = $template->getProperties();
            $templateSet = array_key_exists(\'redactor.configuration_set\', $props) ? (int)$props[\'redactor.configuration_set\'] : 0;
            if ($templateSet > 0) {
                $set = $templateSet;
            }
        }
        $js .= \'<script type="text/javascript">var RedactorConfigurationSet = \' . $set . \';</script>\';

        // Instruct Fred that we offer a "Fredactor" function as "Redactor" RTE.
        $beforeRender = \'
    this.registerRTE("Redactor", Fredactor);
\';
        // Output it all. Woof.
        $modx->event->_output = [
            \'includes\' => $css.$js,
            \'beforeRender\' => $beforeRender,
            \'lexicons\' => [\'redactor:default\']
        ];
        return true;
}

return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Redactor WYSIWYG Editor Plugin
 *
 * Events: OnManagerPageBeforeRender, OnRichTextEditorRegister, OnRichTextBrowserInit, OnDocFormPrerender
 *
 * @author JP DeVries <mail@devries.jp>
 *
 * @package redactor
 */

$corePath = $modx->getOption(\'redactor.core_path\', null, $modx->getOption(\'core_path\').\'components/redactor/\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tvs/input/\');
        break;

    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tvs/inputoptions/\');
        break;

    case \'OnRichTextEditorRegister\':
        $modx->event->output(\'Redactor\');
        break;

    case \'OnFileManagerFileRename\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }
        $redactor->renames[] = $path;

        break;

    case \'OnRichTextEditorInit\':
        /**
         * @var string $editor
         * @var array $elements
         *
         * Only load up the editor if the editor is Redactor, and use_editor is enabled.
         */
        $rte = isset($editor) ? $editor : $modx->getOption(\'which_editor\', null, \'\');
        if ($rte !== \'Redactor\' || !$modx->getOption(\'use_editor\', null, true)) {
            return;
        }

        /**
         * Attempt to load the Redactor service class. Log error and halt processing if it fails.
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        if (isset($resource) && $resource instanceof modResource) {
            $redactor->setResource($resource);
        }
        elseif ($modx->resource && $modx->resource instanceof modResource) {
            $redactor->setResource($modx->resource);
        }
        elseif ($modx->controller && isset($modx->controller->resource) && $modx->controller->resource instanceof modResource) {
            $redactor->setResource($modx->controller->resource);
        }

        // Make sure global assets are loaded
        $redactor->initialize();

        $set = (int)$redactor->getOption(\'redactor.configuration_set\', null, 1, true);
        if (isset($resource)
            && ($resource instanceof modResource)
            && ($template = $resource->getOne(\'Template\'))
            && ($template instanceof modTemplate)
        ) {
            $props = $template->getProperties();
            $templateSet = array_key_exists(\'redactor.configuration_set\', $props) ? (int)$props[\'redactor.configuration_set\'] : 0;
            if ($templateSet > 0) {
                $set = $templateSet;
            }
        }

        $major = (int)$modx->getVersionData()[\'version\'];
        $html = <<<HTML
<script type="text/javascript">
document.documentElement.className += \' redactor-modx{$major}\';
var RedactorConfigurationSet = $set;
</script>
HTML;

        $modx->event->output($html);
        break;

    case \'ContentBlocks_RegisterInputs\':
        /**
         * @var modX $modx
         * @var ContentBlocks $contentBlocks
         * @var array $scriptProperties
         */
        if (class_exists(\'cbBaseInput\')) {
            require_once($corePath . \'elements/inputs/redactor_input.class.php\');
            $modx->event->output([
                \'redactor\' => new RedactorInput($contentBlocks)
            ]);
        }
        break;

    case \'FredBeforeRender\':
        /**
         * @var string $path
         */
        $redactor = $modx->getService(\'redactor\', \'Redactor\', $corePath . \'model/redactor/\');
        if (!($redactor instanceof Redactor)) {
            $modx->log(modX::LOG_LEVEL_ERROR, \'[Redactor] Error loading Redactor service class.\');
            return;
        }

        $assetsUrl = $redactor->config[\'assetsUrl\'];

        $version = \'?v=\' . $this->redactor->version;
        $css = <<<HTML
<link rel="stylesheet" href="{$assetsUrl}vendor/imperavi/redactor/redactor.min.css{$version}">
<link rel="stylesheet" href="{$assetsUrl}vendor/codemirror/codemirror.css{$version}">
<link rel="stylesheet" href="{$assetsUrl}dist/modxredactor.min.css{$version}">
HTML;
        if ($customCss = $redactor->getOption(\'redactor.css\')) {
            $customCss = array_filter(array_map(\'trim\', explode(\',\', $customCss)));
            foreach ($customCss as $url) {
                $css .= \'<link rel="stylesheet" href="\' . $url . $version . \'">\';
            }
        }

        $js = <<<HTML
<script type="text/javascript" src="{$assetsUrl}dist/imperavi/redactor.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}dist/plugins.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}dist/codemirror.min.js{$version}"></script>
<script type="text/javascript" src="{$assetsUrl}js/fredactor.js{$version}"></script>
HTML;
        if ($customJs = $redactor->getOption(\'redactor.js\')) {
            $customJs = array_filter(array_map(\'trim\', explode(\',\', $customJs)));
            foreach ($customJs as $url) {
                $js .= \'<script type="text/javascript" src="\' . $url . $version . \'"></script>\';
            }
        }
        // Primary redactor scripts and the generated configuration sets
        $js .= \'<script type="text/javascript" src="\' . $assetsUrl . \'dist/modxredactor.min.js\' . $version . \'"></script>\';
        $js .= $redactor->getGeneratedConfigurationSets([Redactor::OPT_IS_FRED => true]);

        // Make the resource/wctx available
        if (isset($modx->resource) && $modx->resource instanceof modResource) {
            $redactor->setResource($modx->resource);
        }

        // Get the default configuration set to use from template or setting. This can be overriden with a Fred RTE Config.
        $set = (int)$redactor->getOption(\'redactor.configuration_set\', null, 1, true);
        if (isset($modx->resource)
            && ($modx->resource instanceof modResource)
            && ($template = $modx->resource->getOne(\'Template\'))
            && ($template instanceof modTemplate)
        ) {
            $props = $template->getProperties();
            $templateSet = array_key_exists(\'redactor.configuration_set\', $props) ? (int)$props[\'redactor.configuration_set\'] : 0;
            if ($templateSet > 0) {
                $set = $templateSet;
            }
        }
        $js .= \'<script type="text/javascript">var RedactorConfigurationSet = \' . $set . \';</script>\';

        // Instruct Fred that we offer a "Fredactor" function as "Redactor" RTE.
        $beforeRender = \'
    this.registerRTE("Redactor", Fredactor);
\';
        // Output it all. Woof.
        $modx->event->_output = [
            \'includes\' => $css.$js,
            \'beforeRender\' => $beforeRender,
            \'lexicons\' => [\'redactor:default\']
        ];
        return true;
}

return;',
    ),
  ),
  'aa14bd12f9e19cb99147863b3e8e326f' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'OnRichTextEditorRegister',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'OnRichTextEditorRegister',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '3863cd8a22c9607535333f8990387aed' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '4d2f50b9d5055d7362e46e6ec12d1ee8' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'f04181e73268673ec849580daa9183c4' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'OnRichTextEditorInit',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'OnRichTextEditorInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '8622ec8e391a598ef3bb1231908638c8' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'OnFileManagerFileRename',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'OnFileManagerFileRename',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '576aa31962406b02ae37ff03ff3bfa67' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'ContentBlocks_RegisterInputs',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'ContentBlocks_RegisterInputs',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ada3b343b5232510e3395d26bf3d2e75' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 10,
      'event' => 'FredBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 10,
      'event' => 'FredBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);