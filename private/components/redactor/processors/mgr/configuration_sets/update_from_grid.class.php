<?php
/**
 */
class redConfigurationSetUpdateFromGridProcessor extends modProcessor {
    /** @var array $records */
    public $record;

    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy(['redactor_configurator' => true, 'redactor_sets_save' => true]);
    }

    /**
     * @return bool|null|string
     */
    public function initialize() {
        $data = $this->getProperty('data');
        if (empty($data)) return $this->modx->lexicon('invalid_data');
        $this->record = $this->modx->fromJSON($data);
        if (empty($this->record)) return $this->modx->lexicon('invalid_data');
        return true;
    }

    /**
     * @return array|string
     */
    public function process() {
        if (empty($this->record['id'])) {
            return $this->failure($this->modx->lexicon('redactor.error.missing_id'));
        }

        $object = $this->modx->getObject('redConfigurationSet', $this->record['id']);
        if (!$object) {
            return $this->failure($this->modx->lexicon('redactor.error.category_not_found'));
        }

        $object->fromArray($this->record);
        if ($object->save()) {
            return $this->success();
        }
        return $this->failure($this->modx->lexicon('redactor.error.error_saving_object'));
    }
}
return 'redConfigurationSetUpdateFromGridProcessor';
