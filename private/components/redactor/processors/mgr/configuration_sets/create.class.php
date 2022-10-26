<?php
/**
 * Creates a redConfigurationSet object.
 */
class redConfigurationSetCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'redConfigurationSet';
    public $languageTopics = ['redactor:default'];
    public $permission = ['redactor_configurator' => true, 'redactor_sets_create' => true, 'redactor_sets_save' => true];

    /**
     * @return bool
     */
    public function beforeSet() {
        return parent::beforeSet();
    }
}
return 'redConfigurationSetCreateProcessor';
