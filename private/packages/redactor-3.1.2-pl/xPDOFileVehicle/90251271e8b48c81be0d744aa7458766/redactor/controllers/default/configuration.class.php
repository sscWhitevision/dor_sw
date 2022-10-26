<?php

class RedactorConfigurationManagerController extends modExtraManagerController
{
    /** @var Redactor */
    protected $redactor;

    public function checkPermissions()
    {
        return $this->modx->hasPermission('redactor_configurator');
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
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/grid.sets.js' . $version);
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/window.sets.js' . $version);
        $this->addJavascript($this->redactor->config['assetsUrl'].'configuration/widgets/window.import.js' . $version);

        $this->addCss($this->redactor->config['assetsUrl'].'dist/modxredactor.min.css' . $version);

        $this->addLastJavascript($this->redactor->config['assetsUrl'].'configuration/sections/configuration.js' . $version);

        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            RedactorConfiguration.config = ' . $this->modx->toJSON($this->redactor->config) . ';
        });
        </script>');
    }


    public function process(array $scriptProperties = array())
    {

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
        return array('redactor:default', 'redactor:configuration');
    }
}