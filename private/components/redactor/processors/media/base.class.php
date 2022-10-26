<?php

/**
 * Class RedactorBaseProcessor
 *
 * Handles getting a Redactor instance and loading up the right media source
 */
abstract class RedactorMediaProcessor extends modProcessor {
    /** @var Redactor */
    public $redactor;

    /** @var modMediaSource|\MODX\Revolution\Sources\modMediaSource */
    public $source;

    /** @var redConfigurationSet */
    protected $configurationSet;
    protected $basePath = '';

    public function getLanguageTopics()
    {
        return ['core:file', 'redactor:default'];
    }

    /**
     * Prepare the processor by loading the media source
     *
     * @return boolean
     */
    public function initialize()
    {
        header('Content-Type: application/json');
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        /**
         * Attempt to load the Redactor service class. Log error and halt processing if it fails.
         */
        $this->redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
        if (!($this->redactor instanceof Redactor)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[Redactor] Error loading Redactor service class.');
            return false;
        }

        $configSetId = (int)$this->getProperty('configuration');
        $configSet = $this->modx->getObject('redConfigurationSet', ['id' => $configSetId]);
        if (!($configSet instanceof redConfigurationSet)) {
            return 'Configuration set not found.';
        }
        $this->configurationSet = $configSet;

        $context = (string)$this->getProperty('context');
        if (!empty($context)) {
            $this->redactor->setWorkingContext($context);
        }

        $resource = (int)$this->getProperty('resource');
        if ($resource > 0) {
            $this->redactor->setResource($resource);
        }

        return $this->initializeFromConfiguration();
    }

    /**
     * @param int $id
     * @return bool|null|string
     */
    protected function getSource($id = 0)
    {
        if (!$this->source) {
            $this->source = $this->modx->getObject('sources.modMediaSource', ['id' => $id]);
        }

        if (!$this->source || !$this->source->getWorkingContext()) {
            return $this->modx->lexicon('permission_denied');
        }

        $this->source->setRequestProperties($this->getProperties());
        if ($this->source && $this->source->initialize()) {
            return true;
        }
        return 'Media Source not found';
    }

    /**
     * Returns "file" or "image" for the upload type
     *
     * @return string
     */
    protected function getMediaType()
    {
        $type = $this->getProperty('type', false);
        if (!$type || !in_array($type, array('file', 'image'))) {
            $type = 'image';
        }

        return $type;
    }

    /**
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    public function formatBytes($bytes, $decimals = 2): string
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, $decimals) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, $decimals) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, $decimals) . ' KB';
        } elseif ($bytes > 1) {
            $bytes .= ' bytes';
        } elseif ($bytes === 1) {
            $bytes .= ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    protected function initializeFromConfiguration()
    {
        $options = $this->configurationSet->getProcessedOptions();
        $type = $this->getMediaType();
        switch ($type) {
            case 'file':
                $this->basePath = (string)$options['fileSimpleBrowserPath'];
                return $this->getSource((int)$options['fileSimpleBrowserSource']);

            case 'image':
            default:
                $this->basePath = (string)$options['imageSimpleBrowserPath'];
                return $this->getSource((int)$options['imageSimpleBrowserSource']);
        }
    }
}