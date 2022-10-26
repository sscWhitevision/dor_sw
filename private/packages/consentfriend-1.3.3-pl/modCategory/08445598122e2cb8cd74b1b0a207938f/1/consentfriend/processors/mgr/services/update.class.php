<?php
/**
 * Update processor
 *
 * @package consentfriend
 * @subpackage processor
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
    public function beforeSave(): bool
    {
        foreach ($this->empty as $empty) {
            $value = $this->getProperty($empty);
            if ($value == $this->modx->lexicon($this->objectType . '.' . $this->getProperty('name') . '.' . $empty)) {
                $this->object->set($empty, '');
            }
        }
        if ($this->modx->getCount($this->classKey, [
            'name' => $this->getProperty('key'),
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
    public function afterSave(): bool
    {
        return $this->handlePurposes();
    }

    /**
     * Handle purpose to service assignments.
     *
     * @return bool
     */
    private function handlePurposes(): bool
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
                if ($existingServicePurpose->remove() == false) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_remove'));
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
                    $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_save'));
                    return false;
                }
            } else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.service_err_servicepurpose_nf'));
                return false;
            }
        }
        return true;
    }
}

return 'ConsentfriendServicesUpdateProcessor';
