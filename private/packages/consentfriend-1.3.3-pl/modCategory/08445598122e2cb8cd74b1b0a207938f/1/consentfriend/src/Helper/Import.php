<?php
/**
 * Import classfile
 *
 * @package consentfriend
 * @subpackage classfile
 */

namespace TreehillStudio\ConsentFriend\Helper;

use ConsentFriend;
use ConsentfriendPurposes;
use ConsentfriendServicePurposes;
use ConsentfriendServices;
use Exception;
use modSystemSetting;
use modX;
use PDO;
use xPDOObject;

/**
 * Class ConsentFriend
 */
class Import extends ConsentFriend
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * Set purposes data.
     *
     * @param array $data
     * @param string $mode
     *
     * @throws Exception
     */
    public function setPurposes(array $data, string $mode)
    {
        foreach ($data as $row) {
            /** @var ConsentfriendPurposes $purpose */
            $purpose = null;
            if (($mode == 'append' || $mode == 'setup' || $mode == 'essential') && $this->modx->getObject('ConsentfriendPurposes', ['key' => $row['key']])) {
                continue;
            } elseif ($mode == 'update') {
                // Update existing purposes only in update mode
                $purpose = $this->modx->getObject('ConsentfriendPurposes', ['key' => $row['key']]);
            }
            if (!$purpose) {
                $purpose = $this->modx->newObject('ConsentfriendPurposes');
            }
            $purpose->fromArray($row, '', true);
            if (!$purpose->save()) {
                throw new Exception($this->modx->lexicon('consentfriend.purpose_err_importing_row', ['row' => $purpose->toJSON()]));
            }
        }
    }

    /**
     * Set services data.
     *
     * @param array $data
     * @param string $mode
     *
     * @throws Exception
     */
    public function setServices(array $data, string $mode)
    {
        foreach ($data as $row) {
            $type = 'existing';
            /** @var ConsentfriendServices $service */
            $service = null;
            if (($mode == 'append' || $mode == 'setup') && $this->modx->getObject('ConsentfriendServices', ['name' => $row['name']])) {
                continue;
            } elseif ($mode == 'update') {
                $service = $this->modx->getObject('ConsentfriendServices', ['name' => $row['name']]);
                $type = 'update';
            } elseif ($mode == 'essential') {
                if (!(isset($row['essential']) && $row['essential'])) {
                    continue;
                } else {
                    $service = $this->modx->getObject('ConsentfriendServices', ['name' => $row['name']]);
                    $type = 'update';
                }
            }
            if (!$service) {
                $service = $this->modx->newObject('ConsentfriendServices');
                $type = 'new';
            }
            $service->fromArray($row);
            if (isset($row['cookies']) && !empty($row['cookies'])) {
                $row['cookies'] = (is_array($row['cookies'])) ? json_encode($row['cookies']) : $row['cookies'];
                $service->set('cookies', $row['cookies']);
            } else {
                $service->set('cookies', '[]');
            }
            if (!$service->save()) {
                throw new Exception($this->modx->lexicon('consentfriend.service_err_importing_row', ['row' => $service->toJSON()]));
            }

            if ($type == 'update' || $type == 'new') {
                $purposes = ($row['purposes'] != '') ? explode(',', $row['purposes']) : [];
                if (!$this->handlePurposes($service, $purposes)) {
                    throw new Exception($this->modx->lexicon('consentfriend.service_err_importing_purposes', ['purposes' => implode(',', $row['purposes'])]));
                }
            }
        }
    }

    /**
     * Set config data.
     *
     * @param array $data
     * @param string $mode
     *
     * @throws Exception
     */
    public function setConfig(array $data, string $mode)
    {
        foreach ($data as $key => $value) {
            /** @var modSystemSetting $setting */
            $setting = $this->modx->getObject('modSystemSetting', ['key' => 'consentfriend.' . $key]);
            if (!$setting || $mode == 'append') {
                // Don't create or append system settings
                continue;
            }
            if ($setting->get('value') != (string)$value) {
                // Don't update equal existing system setting values
                $value = $this->prepareValue($setting, $value);
                $setting->set('value', $value);
                if (!$setting->save()) {
                    throw new Exception($this->modx->lexicon('consentfriend.setting_err_importing_row', ['row' => $setting->toJSON()]));
                }
            }
        }
    }

    /**
     * Prepare the setting value on base of the setting xtype.
     *
     * @param xPDOObject $setting
     * @param $value
     * @return string
     */
    public function prepareValue(xPDOObject $setting, $value): string
    {
        switch ($setting->get('xtype')) {
            case 'combo-boolean':
                $value = $value ? '1' : '0';
                break;
            case 'numberfield':
                $value = (string)$value;
                break;
        }

        return $value;
    }

    /**
     * Handle purpose to service assignments.
     *
     * @param xPDOObject $service
     * @param array $purposeKeys
     * @return bool
     */
    private function handlePurposes(xPDOObject $service, array $purposeKeys): bool
    {
        $purposeIds = [];
        /** @var ConsentfriendPurposes[] $purposes */
        $purposes = $this->modx->getIterator('ConsentfriendPurposes', [
            'key:IN' => $purposeKeys
        ]);
        foreach ($purposes as $purpose) {
            $purposeIds[] = $purpose->get('id');
        }

        /** @var ConsentfriendServicePurposes[] $existingServicePurposes */
        $existingServicePurposes = $this->modx->getIterator('ConsentfriendServicePurposes', [
            'service_id' => $service->get('id')
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
                    'service_id' => $service->get('id'),
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

    /**
     * Remove existing data.
     * @param string $type
     */
    public function removeData($type = 'all')
    {
        if ($type == 'all' || $type == 'purposes') {
            /** @var ConsentfriendPurposes[] $collection */
            $collection = $this->modx->getIterator('ConsentfriendPurposes');
            foreach ($collection as $item) {
                $item->remove();
            }
        }
        if ($type == 'all' || $type == 'services') {
            /** @var ConsentfriendServices[] $collection */
            $collection = $this->modx->getIterator('ConsentfriendServices');
            foreach ($collection as $item) {
                $item->remove();
            }
        }
    }

    /**
     * Clear the context and the lexicon topics cache.
     */
    protected function clearCache()
    {
        $query = $this->modx->newQuery('modContext');
        $query->select($this->modx->escape('key'));
        if ($query->prepare() && $query->stmt->execute()) {
            $contextKeys = $query->stmt->fetchAll(PDO::FETCH_COLUMN);
        } else {
            $contextKeys = [];
        }

        $this->modx->cacheManager->refresh(
            [
                'lexicon_topics' => [],
                'resource' => ['contexts' => array_diff($contextKeys, ['mgr'])],
                'system_settings' => []
            ]
        );
    }
}
