<?php
/**
 * Removes a redConfigurationSet object.
 */
class redConfigurationSetRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'redConfigurationSet';
    public $objectType = 'redConfigurationSet';
    public $permission = ['redactor_configurator' => true, 'redactor_sets_delete' => true];
}
return 'redConfigurationSetRemoveProcessor';
