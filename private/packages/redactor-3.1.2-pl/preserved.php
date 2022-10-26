<?php return array (
  '65719b3582db707616e79840a9f12f3f' => 
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
  'e70fc3bd58d11b34f7dd85c73f4ada0e' => 
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
  'b7165962dae810fff892bb0a87edef81' => 
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
  'a4b7d3723704406e8b26015eafb941bf' => 
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
  'f0f8fc975ffbf293d2a31fa04499c636' => 
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
  'fcee8075d660dfb803e3ce2ff73b6a32' => 
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
  'a64b14eb2a54670607d9694c66752354' => 
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
  '906474e2eb88c050e49271ac3cda43f4' => 
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
  'f591139321d3671486bb9b46a000a271' => 
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
  'b641e7dcb87687db0d46f978e910d910' => 
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
  '46b084c7939d5773a3aaf7264b64009f' => 
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
  'f1f02142eb6e06cbf9eaa161cc9423eb' => 
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
  '546675e508a269fdd8d5e338db2d4512' => 
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
  'a211c211df7fb139b6f9d896ee4d8eba' => 
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
  '39e5851275b7182d15ecd58d3fb8751b' => 
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
  'bcb420b64e3a3eb0722a8951597ffca0' => 
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
  'b9961eff6199100cce6f022fd265b680' => 
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
  '1e5a9f3a1dfbe58191a41bbb26e90bf0' => 
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
  '8fef7dcaa56beaee98f5d2558a218415' => 
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
  '7743fc94350a8399db78fc8284a658f1' => 
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
  '382fa2037dea789e0f7ccf5532c0de02' => 
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
      'data' => '{"redactor_configurator":true,"redactor_sets_view":true,"redactor_sets_create":true,"redactor_sets_save":true,"redactor_sets_export":true,"redactor_sets_import":true,"redactor_sets_delete":true}',
      'lexicon' => 'redactor:permissions',
    ),
  ),
  '87a2fd5e27558d41a8243f2ae02a808b' => 
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
  '08b69bf347a6f9785f9a29176e1cfa0f' => 
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
  'e713362c13b12202c21096de8d4526d6' => 
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
  '3b72dde6a7c6870fadf9292359aedc91' => 
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
  'a5203d3edcebfb2f3581824fc9953a9a' => 
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
  '1672be065499a926c09adb759bbbc1f6' => 
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
  'b196d3fc58d4b17936e04e57d1f4581f' => 
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
  '4267399d5434a4fcb595d45b084a0b23' => 
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