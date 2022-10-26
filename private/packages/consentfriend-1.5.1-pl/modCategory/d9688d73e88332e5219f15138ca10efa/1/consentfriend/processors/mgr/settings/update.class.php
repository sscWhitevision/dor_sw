<?php
/**
 * Update a system setting
 *
 * @package consentfriend
 * @subpackage processors
 */

// Compatibility between 2.x/3.x
if (file_exists(MODX_PROCESSORS_PATH . 'system/settings/update.class.php')) {
    require_once MODX_PROCESSORS_PATH . 'system/settings/update.class.php';
} elseif (!class_exists('modSystemSettingsUpdateProcessor')) {
    class_alias(\MODX\Revolution\Processors\System\Settings\Update::class, \modSystemSettingsUpdateProcessor::class);
}

class ConsentFriendSystemSettingsUpdateProcessor extends modSystemSettingsUpdateProcessor
{
    public $checkSavePermission = false;
    public $languageTopics = ['setting', 'namespace', 'consentfriend:setting'];

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave()
    {
        $this->setProperty('namespace', 'consentfriend');
        $this->checkForBooleanValue();
        $this->checkCanSave();
        return parent::beforeSave();
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function afterSave()
    {
        $this->updateTranslations($this->getProperties());
        $this->clearCache();
        return parent::afterSave();
    }

    /**
     * Verify the Namespace passed is a valid Namespace
     */
    protected function checkCanSave()
    {
        $key = $this->getProperty('key');
        if (strpos($key, 'consentfriend.') !== 0) {
            $this->addFieldError('key', $this->modx->lexicon('consentfriend.systemsetting_key_err_nv'));
        }
        if (!$this->modx->hasPermission('settings') && !$this->modx->hasPermission('consentfriend_settings')) {
            $this->addFieldError('usergroup', $this->modx->lexicon('consentfriend.systemsetting_usergroup_err_nv'));
        }
    }
}

return 'ConsentFriendSystemSettingsUpdateProcessor';
