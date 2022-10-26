<?php
/**
 * Update Context
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectUpdateProcessor;

/**
 * Class ConsentfriendContextsUpdateProcessor
 */
class ConsentfriendContextsUpdateProcessor extends ObjectUpdateProcessor
{
    public $classKey = 'modContext';
    public $objectType = 'context';
    public $primaryKeyField = 'key';

    protected $required = [
        'key', 'name'
    ];

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave()
    {
        if ($this->modx->getCount($this->classKey, [
            'name' => $this->getProperty('name'),
            'key:<>' => $this->getProperty('key')
        ])
        ) {
            $this->addFieldError('name', $this->modx->lexicon('consentfriend.context_err_name_ae'));
        }

        return parent::beforeSave();
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function afterSave()
    {
        return $this->handleContexts();
    }

    /**
     * Handle context to service assignments.
     *
     * @return bool
     */
    private function handleContexts()
    {
        $serviceIds = $this->getProperty('service_ids');
        $serviceIds = (!empty($serviceIds)) ? array_map('intval', explode(',', $serviceIds)) : [];

        /** @var ConsentfriendServiceContexts[] $existingServiceContexts */
        $existingServiceContexts = $this->modx->getIterator('ConsentfriendServiceContexts', [
            'context_key' => $this->object->get('key')
        ]);
        foreach ($existingServiceContexts as $existingServiceContext) {
            $serviceId = (string)$existingServiceContext->get('service_id');
            if (!in_array($serviceId, $serviceIds)) {
                // Remove not assigned service ids
                if (!$existingServiceContext->remove()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.context_err_servicecontext_remove'));
                    return false;
                }
            } else {
                // Ignore assigned context ids
                $serviceIds = array_diff($serviceIds, [$serviceId]);
            }
        }
        // Add new context ids
        foreach ($serviceIds as $serviceId) {
            /** @var ConsentfriendServices $service */
            $service = $this->modx->getObject('ConsentfriendServices', [
                'id' => $serviceId
            ]);
            if ($service) {
                /** @var ConsentfriendServiceContexts $serviceContext */
                $serviceContext = $this->modx->newObject('ConsentfriendServiceContexts');
                $serviceContext->fromArray([
                    'service_id' => $serviceId,
                    'context_key' => $this->object->get('key')
                ]);
                if (!$serviceContext->save()) {
                    $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.context_err_servicecontext_save'));
                    return false;
                }
            } else {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, $this->modx->lexicon('consentfriend.context_err_servicecontext_nf'));
                return false;
            }
        }
        return true;
    }
}

return 'ConsentfriendContextsUpdateProcessor';
