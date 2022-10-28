<?php
/**
 * Create Service
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectCreateProcessor;

/**
 * Class ConsentfriendServicesCreateProcessor
 */
class ConsentfriendServicesCreateProcessor extends ObjectCreateProcessor
{
    public $classKey = 'ConsentfriendServices';
    public $objectType = 'consentfriend.services';

    protected $required = [
        'name'
    ];
    protected $empty = [
        'title', 'description'
    ];

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave()
    {
        foreach ($this->empty as $empty) {
            $value = $this->getProperty($empty);
            if ($value == $this->modx->lexicon($this->objectType . '.' . $this->getProperty('name') . '.' . $empty)) {
                $this->object->set($empty, '');
            }
        }
        if ($this->modx->getCount($this->classKey, [
            'name' => $this->getProperty('name'),
            'id:<>' => $this->getProperty('id')
        ])
        ) {
            $this->addFieldError('name', $this->modx->lexicon('consentfriend.service_err_name_ae'));
        }

        return parent::beforeSave();
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function afterSave()
    {
        $success = $this->handlePurposes();
        return $success && $this->handleContexts();
    }

    /**
     * Handle purpose to service assignments.
     *
     * @return bool
     */
    private function handlePurposes()
    {
        $purposeIds = $this->getProperty('purpose_ids');
        $purposeIds = (!empty($purposeIds)) ? array_map('trim', explode(',', $purposeIds)) : [];

        // Add new purpose ids
        foreach ($purposeIds as $purposeId) {
            /** @var ConsentfriendPurposes $purpose */
            $purpose = $this->modx->getObject('ConsentfriendPurposes', [
                'id' => $purposeId
            ]);
            if ($purpose) {
                /** @var ConsentfriendServicePurposes $servicePurpose */
                $servicePurpose = $this->modx->newObject('ConsentfriendServicePurposes');
                $servicePurpose->fromArray([
                    'service_id' => $this->object->get('id'),
                    'purpose_id' => $purposeId
                ]);
                if (!$servicePurpose->save()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_save'));
                    return false;
                }
            } else {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_nf'));
                return false;
            }
        }
        return true;
    }

    /**
     * Handle context to service assignments.
     *
     * @return bool
     */
    private function handleContexts()
    {
        $contextKeys = $this->getProperty('context_keys');
        $contextKeys = (!empty($contextKeys)) ? array_map('trim', explode(',', $contextKeys)) : [];

        // Add new context ids
        foreach ($contextKeys as $contextKey) {
            /** @var modContext $context */
            $context = $this->modx->getObject('modContext', [
                'key' => $contextKey
            ]);
            if ($context) {
                /** @var ConsentfriendServiceContexts $serviceContext */
                $serviceContext = $this->modx->newObject('ConsentfriendServiceContexts');
                $serviceContext->fromArray([
                    'service_id' => $this->object->get('id'),
                    'context_key' => $contextKey
                ]);
                if (!$serviceContext->save()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicecontext_save'));
                    return false;
                }
            } else {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicecontext_nf'));
                return false;
            }
        }
        return true;
    }
}

return 'ConsentfriendServicesCreateProcessor';
