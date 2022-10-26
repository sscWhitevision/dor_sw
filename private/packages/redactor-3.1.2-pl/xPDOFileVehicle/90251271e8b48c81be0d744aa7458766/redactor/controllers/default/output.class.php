<?php

class RedactorOutputManagerController extends modExtraManagerController
{
    public $loadHeader = false;
    public $loadFooter = false;

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
        return $this->modx->hasPermission('frames'); // generic permission to the manager
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

    public function process(array $scriptProperties = array())
    {
        header('Content-Type: text/javascript; charset=UTF-8');
        @session_write_close();

        $sets = $this->modx->getCollection('redConfigurationSet');
        foreach ($sets as $set) {
            echo "/**
 * Set {$set->get('id')}
 */
{$set->getOutputAsJS()}

";
        }
        exit();
    }
}
