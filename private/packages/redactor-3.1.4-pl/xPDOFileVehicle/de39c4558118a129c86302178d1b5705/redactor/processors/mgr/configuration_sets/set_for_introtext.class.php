<?php

/**
 * Class RedactorImportProcessor
 */
class SetForIntrotextProcessor extends modProcessor
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

        $setting = $this->modx->getObject('modSystemSetting', ['key' => 'redactor.introtext.configuration_set']);
        if (!$setting) {
            return $this->failure('redactor.introtext.configuration_set setting doesn\'t exist');
        }
        $setting->set('value', $setId);
        $setting->save();

        // Make sure the introtext setting is also enabled, otherwise it wont show up.
        if (!$this->modx->getOption('redactor.introtext')) {
            $setting = $this->modx->getObject('modSystemSetting', ['key' => 'redactor.introtext']);
            if (!$setting) {
                return $this->failure('redactor.introtext setting doesn\'t exist');
            }
            $setting->set('value', true);
            $setting->save();
        }

        // Refresh system setting cache to make it take effect
        $this->modx->getCacheManager()->refresh([
            'system_settings' => [],
        ]);

        return $this->success();
    }
}

return SetForIntrotextProcessor::class;