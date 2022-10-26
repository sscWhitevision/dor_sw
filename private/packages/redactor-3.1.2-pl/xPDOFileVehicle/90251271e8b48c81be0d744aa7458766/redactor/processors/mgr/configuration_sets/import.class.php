<?php
require_once dirname(dirname(__FILE__)) . '/import.class.php';
/**
 * Class redConfigurationSetImportProcessor
 */
class redConfigurationSetImportProcessor extends RedactorImportProcessor
{
    public $classKey = 'redConfigurationSet';

    /**
     * Checks if the user has sufficient permissions to perform this action.
     *
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy(['redactor_configurator' => true, 'redactor_sets_create' => true, 'redactor_sets_save' => true, 'redactor_sets_delete' => true, 'redactor_sets_import' => true]);
    }
}

return 'redConfigurationSetImportProcessor';
