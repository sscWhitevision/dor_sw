<?php

class SetDefaultProcessor extends modProcessor
{
    public function checkPermissions()
    {
        return $this->modx->hasPermission('settings');
    }

    public function process()
    {
        $setId = (int)$this->getProperty('set');
        if (!$this->modx->getObject('redConfigurationSet', ['id' => $setId])) {
            return $this->failure($this->modx->lexicon('redactor.error.set_nf'));
        }

        $setting = $this->modx->getObject('modSystemSetting', ['key' => 'redactor.configuration_set']);
        if (!$setting) {
            return $this->failure('redactor.configuration_set setting doesn\'t exist');
        }
        $setting->set('value', $setId);
        $setting->save();

        // Refresh system setting cache to make it take effect
        $this->modx->getCacheManager()->refresh([
            'system_settings' => [],
        ]);

        return $this->success();
    }
}

return SetDefaultProcessor::class;