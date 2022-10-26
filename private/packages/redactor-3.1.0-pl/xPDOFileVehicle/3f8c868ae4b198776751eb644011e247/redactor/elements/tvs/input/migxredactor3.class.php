<?php
require_once __DIR__ . '/redactor.class.php';

class Redactor3ForMIGXInputRender extends RedactorInputRender {
    protected function getConfigSetID(array $params)
    {
        $configSet = $this->redactor->getOption('redactor.configuration_set', null, 1, true);
        if (array_key_exists('configs', $params) && is_numeric($params['configs'])) {
            $configSet = $params['configs'];
        }
        return $configSet;
    }

    public function getTemplate()
    {
        $corePath = $this->redactor->getOption('redactor.core_path', null, $this->redactor->getOption('core_path').'components/redactor/');
        return $corePath . 'elements/tvs/tpl/migxredactor3.tpl';
    }
}
return Redactor3ForMIGXInputRender::class;