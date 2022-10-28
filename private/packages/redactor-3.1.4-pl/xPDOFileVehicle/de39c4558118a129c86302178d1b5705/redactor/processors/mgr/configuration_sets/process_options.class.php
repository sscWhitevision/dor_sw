<?php

class RedactorConfigurationProcessOptionsProcessor extends modProcessor {
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy(['redactor_configurator' => true, 'redactor_sets_view' => true]);
    }

    public function process()
    {
        $options = $this->getProperty('options');
        $array = json_decode($options, true);
        /** @var redConfigurationSet $set */
        $set = $this->modx->newObject('redConfigurationSet');
        $set->set('content', $options);
        $set->set('id', (int)$array['id']);
        $options = $set->getProcessedOptions();
        return $this->success('', array('options' => $options));
    }
}

return 'RedactorConfigurationProcessOptionsProcessor';
