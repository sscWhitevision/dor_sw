<?php
/**
 * Update Service
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectUpdateProcessor;

/**
 * Class ConsentfriendServicesUpdateProcessor
 */
class ConsentfriendServicesUpdateProcessor extends ObjectUpdateProcessor
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

        /** @var ConsentfriendServicePurposes[] $existingServicePurposes */
        $existingServicePurposes = $this->modx->getIterator('ConsentfriendServicePurposes', [
            'service_id' => $this->object->get('id')
        ]);
        foreach ($existingServicePurposes as $existingServicePurpose) {
            $purposeId = (string)$existingServicePurpose->get('purpose_id');
            if (!in_array($purposeId, $purposeIds)) {
                // Remove not assigned purpose ids
                if (!$existingServicePurpose->remove()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_remove'));
                    return false;
                }
            } else {
                // Ignore assigned purpose ids
                $purposeIds = array_diff($purposeIds, [$purposeId]);
            }
        }
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

        /** @var ConsentfriendServiceContexts[] $existingServiceContexts */
        $existingServiceContexts = $this->modx->getIterator('ConsentfriendServiceContexts', [
            'service_id' => $this->object->get('id')
        ]);
        foreach ($existingServiceContexts as $existingServiceContext) {
            $contextKey = (string)$existingServiceContext->get('context_key');
            if (!in_array($contextKey, $contextKeys)) {
                // Remove not assigned context ids
                if (!$existingServiceContext->remove()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicecontext_remove'));
                    return false;
                }
            } else {
                // Ignore assigned context ids
                $contextKeys = array_diff($contextKeys, [$contextKey]);
            }
        }
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

return 'ConsentfriendServicesUpdateProcessor';
