<?php
/**
 * Redactor custom Template Variable
 *
 * Class RedactorInputRender
 */
class RedactorInputRender extends modTemplateVarInputRender {
    /** @var Redactor */
    protected $redactor;

    public function __construct($tv, array $config = array())
    {
        parent::__construct($tv, $config);

        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        $this->redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
        if (!($this->redactor instanceof Redactor)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[RedactorInputRender] Error loading Redactor service class.');
            return;
        }

        if ($this->modx->resource) {
            $this->redactor->setResource($this->modx->resource);
        }

        $this->redactor->initialize();
    }

    /**
     * Get lexicon topics for this TV.
     * @return array
     */
    public function getLexiconTopics() {
        return array('redactor:default');
    }
    /**
     * @param string $value
     * @param array $params
     * @return mixed
     */
    public function render($value, array $params = array()) {
        // Determine the configuration set to use
        $this->setPlaceholder('configSet', $this->getConfigSetID($params));

        return parent::render($value, $params);
    }

    /**
     * Returns the template path to load.
     * @return string
     */
    public function getTemplate() {
        $corePath = $this->redactor->getOption('redactor.core_path', null, $this->redactor->getOption('core_path').'components/redactor/');
        return $corePath . 'elements/tvs/tpl/input.tpl';
    }

    /**
     * @param array $params
     * @return mixed
     */
    protected function getConfigSetID(array $params)
    {
        $configSet = $this->redactor->getOption('redactor.configuration_set', null, 1, true);
        if (array_key_exists('configuration_set', $params)) {
            $configSet = $params['configuration_set'];
        }
        return $configSet;
    }
}
return 'RedactorInputRender';
