<?php
require_once dirname(dirname(__FILE__)) . '/export.class.php';
/**
 * Class cbFieldExportProcessor
 */
class cbFieldExportProcessor extends ContentBlocksExportProcessor
{
    public $classKey = 'cbField';
    protected $exportRelatedObjects = ['Children', 'Category'];

    /**
     * Checks if the user has sufficient permissions to perform this action.
     *
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy('contentblocks_fields_export');
    }

    public function prepareQueryBeforeIterate(xPDOQuery $c): void
    {
        $parent = (int)$this->getProperty('parent', 0);
        $parent = $parent > 0 ? $parent : 0;
        $c->where(['parent' => $parent]);
    }
}

return 'cbFieldExportProcessor';
