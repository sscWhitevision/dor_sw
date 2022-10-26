<?php

class RedactorSetManagerController extends modExtraManagerController
{
    /**
     * @var Redactor
     */
    protected $redactor;
    /**
     * @var redConfigurationSet
     */
    protected $record;

    public function checkPermissions()
    {
        return $this->modx->hasPermission(['redactor_configurator' => true, 'redactor_sets_view' => true]);
    }

    public function initialize()
    {
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        $this->redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
        if (!($this->redactor instanceof Redactor)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[Redactor] Error loading Redactor service class.');
            return false;
        }

        $this->modx->lexicon->load('redactor:configuration');
        return true;
    }
    
    public function loadCustomCssJs() 
    {
        $version = '?v=' . $this->redactor->version;
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/redactor.class.js' . $version);
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/combos.js' . $version);
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/panel.set.advanced.js' . $version);
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/panel.set.basic.js' . $version);

        $this->addLastJavascript($this->redactor->config['assetsUrl'].'configuration/sections/set.js' . $version);

        // Load the preview text from a chunk, or the default tpl.
        $dummyText = $this->modx->getChunk('redactor_configurator_preview');
        if (empty($dummyText)) {
            $dummyText = file_get_contents($this->redactor->config['corePath'] . 'templates/default/dummytext.tpl');
        }
        $dummyText = str_replace(['[[+redactor.assets_url]]'], [$this->redactor->config['assetsUrl']], $dummyText);

        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            RedactorConfiguration.config = ' . $this->modx->toJSON($this->redactor->config) . ';
        });
        </script>
        <meta id="redactor-dummy-text" content="' . htmlentities($dummyText, ENT_QUOTES, 'UTF-8') .'">');
    }


    public function process(array $scriptProperties = array())
    {
        if (!array_key_exists('id', $scriptProperties) || !is_numeric($scriptProperties['id'])) {
            $this->failure($this->modx->lexicon('redactor.error.set_ns'));
            return;
        }

        $id = (int)$scriptProperties['id'];
        $this->record = $this->modx->getObject('redConfigurationSet', ['id' => $id]);
        if (!($this->record instanceof redConfigurationSet)) {
            $this->failure($this->modx->lexicon('redactor.error.set_nf'));
            return;
        }

        $this->loadRichTextEditor();

        $array = $this->record->toArray();
        if ($this->record->get('class_key') === 'redConfigurationSet') {
            $array['content'] = $this->record->getOptions();

            $formDefinition = [];
            $options = $this->redactor->getOptionGroups();
            foreach ($options as $group) {
                $settings = $group->getSettings();
                $items = [];
                foreach ($settings as $setting) {
                    $name = $setting->getName();
                    $xtype = $setting->getXType();
                    $labelKey = $xtype === 'xcheckbox' ? 'boxLabel' : 'fieldLabel';
                    $item = [
                        'xtype' => $setting->getXType(),
                        'name' => $name,
                        $labelKey => $this->modx->lexicon('redactor.' . $name),
                        'value' => $setting->getDefault()
                    ];
                    if ($xtype === 'textarea') {
                        $item['grow'] = true;
                    }
                    elseif (strpos($xtype, 'combo') !== false) {
                        $item['hiddenName'] = $item['name'];
                    }

                    $items[] = $item;

                    $description = $this->modx->lexicon('redactor.' . $name . '.desc');
                    if ($description !== 'redactor.' . $name . '.desc') {
                        $items[] = [
                            'xtype' => 'panel',
                            'html' => '<p class="redactor-option-description">' . $description . '</p>',
                        ];
                    }
                }
                $formDefinition[] = [
                    'title' => $this->modx->lexicon('redactor.group.' . $group->getName()),
                    'layout' => 'form',
                    'labelAlign' => 'top',
                    'defaults' => [
                        'anchor' => '100%',
                    ],
                    'items' => $items,
                ];
            }

            $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                RedactorConfiguration.record = ' . json_encode($array) . ';
                RedactorConfiguration.formDefinition = ' . json_encode($formDefinition) . ';
            });
            </script>');
        }
        else {
            $this->addHtml('<script type="text/javascript">
            Ext.onReady(function() {
                RedactorConfiguration.record = ' . json_encode($array) . ';
            });
            </script>');
        }
    }

    /**
     * @todo refactor this (and the redactor initialisation in general?) to not be dependent on the plugin, as this
     * might also initiate TinyMCE for example, which is not what we want in the CMP.
     */
    public function loadRichTextEditor()
    {
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');
        if ($useEditor && !empty($whichEditor)) {
            // invoke the OnRichTextEditorInit event
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit',array(
                'editor' => $whichEditor, // Not necessary for Redactor
                'elements' => array('foo'), // Not necessary for Redactor
            ));
            if (is_array($onRichTextEditorInit)) {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }
            $this->setPlaceholder('onRichTextEditorInit', $onRichTextEditorInit);
        }
    }

    public function getPageTitle()
    {
        return $this->modx->lexicon('redactor.configuration');
    }

    public function getTemplateFile()
    {
        return 'configuration.tpl';
    }

    /**
     * Defines the lexicon topics to load in our controller.
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('redactor:default', 'redactor:configuration', 'redactor:settings');
    }
}