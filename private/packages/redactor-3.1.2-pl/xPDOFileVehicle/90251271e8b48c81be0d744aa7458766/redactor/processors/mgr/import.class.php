<?php

/**
 * Class RedactorImportProcessor
 */
abstract class RedactorImportProcessor extends modProcessor
{
    public $classKey;
    public $mode = 'insert';
    /** @var Redactor */
    public $redactor;

    /**
     * Checks if the user has sufficient permissions to perform this action.
     *
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy([
            'redactor_configurator' => true,
            'redactor_sets_import' => true,
            'redactor_sets_create' => true,
            'redactor_sets_save' => true,
            'redactor_sets_delete' => true,
        ]);
    }

    public function initialize() {
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path') . 'components/redactor/');
        $this->redactor =& $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');

        $mode = $this->getProperty('mode');
        if (in_array($mode, array('insert', 'overwrite', 'replace'))) {
            $this->mode = $mode;
        }
        return parent::initialize();
    }

    /**
     * Fetches the data, generates XML and tells the browser to download it.
     *
     * @return mixed
     */
    public function process()
    {
        $file = $_FILES['file'];
        $xml = false;
        if (!empty($file['tmp_name']) && file_exists($file['tmp_name'])) {
            $xml = simplexml_load_file($file['tmp_name'], 'SimpleXMLElement', LIBXML_NOCDATA);
        }

        if (!$xml) {
            return $this->failure($this->modx->lexicon('redactor.error.xml_not_loaded'));
        }

        // Make sure this is a redactor export
        $package = (string) $xml->attributes()->{'package'};
        if ($package !== 'redactor') {
            return $this->failure($this->modx->lexicon('redactor.error.not_an_export'));
        }

        $data = array();
        foreach ($xml->{$this->classKey} as $object) {
            // Turn $object into an array
            $a = array();
            foreach ($object as $key => $value) {
                $a[(string)$key] = (string)$value;
            }
            $data[] = $a;
        }

        if ($this->mode === 'replace') {
            $this->removeCollection();
        }

        foreach ($data as $row) {
            /** @var xPDOObject $importedObject */
            $importedObject = false;
            switch ($this->mode) {
                case 'overwrite':
                    $importedObject = $this->modx->getObject($this->classKey, $row['id']);
                    break;

                case 'insert':
                    unset($row['id']);
                    break;
            }

            if (!$importedObject) {
                $importedObject = $this->modx->newObject($this->classKey);
            }

            $importedObject->fromArray($row, '', true);
            if (!$importedObject->save()) {
                return $this->failure($this->modx->lexicon('redactor.error.importing_row') . print_r($row, true));
            }
        }


        return $this->success();
    }

    /**
     * Removes existing records in "replace" mode
     */
    public function removeCollection()
    {
        $this->modx->removeCollection($this->classKey, array());
    }
}
