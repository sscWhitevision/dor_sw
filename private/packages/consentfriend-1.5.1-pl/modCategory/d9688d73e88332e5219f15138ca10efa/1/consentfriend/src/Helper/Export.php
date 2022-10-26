<?php
/**
 * Export classfile
 *
 * @package consentfriend
 * @subpackage classfile
 */

namespace TreehillStudio\ConsentFriend\Helper;

use ConsentFriend;
use ConsentfriendPurposes;
use ConsentfriendServices;
use modSystemSetting;
use modX;
use Symfony\Component\Yaml\Yaml;
use xPDOObject;

/**
 * Class ConsentFriend
 */
class Export extends ConsentFriend
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * Get purposes data.
     *
     * @return array
     */
    function getPurposes()
    {
        $result = [];

        $c = $this->modx->newQuery('ConsentfriendPurposes');
        $c->sortby('sortindex');

        /** @var ConsentfriendPurposes[] $purposes */
        $purposes = $this->modx->getIterator('ConsentfriendPurposes', $c);
        foreach ($purposes as $purpose) {
            $result[] = $this->prepareRow($purpose);
        }

        return $result;
    }

    /**
     * Get services data.
     *
     * @return array
     */
    function getServices()
    {
        $result = [];

        $c = $this->modx->newQuery('ConsentfriendServices');
        $c->leftJoin('ConsentfriendServicePurposes', 'ServicePurposes');
        $c->leftJoin('ConsentfriendPurposes', 'Purpose', ['ServicePurposes.purpose_id = Purpose.id']);
        $c->select($this->modx->getSelectColumns('ConsentfriendServices', 'ConsentfriendServices'));
        $c->select('GROUP_CONCAT(DISTINCT Purpose.key) AS purposes');
        if ($this->getOption('useContexts')) {
            $c->leftJoin('ConsentfriendServiceContexts', 'ServiceContexts');
            $c->leftJoin('modContext', 'Context', ['ServiceContexts.context_key = Context.key']);
            $c->select('GROUP_CONCAT(DISTINCT Context.key) AS contexts');
        }
        $c->groupby('ConsentfriendServices.id');
        $c->sortby('sortindex');

        /** @var ConsentfriendServices[] $services */
        $services = $this->modx->getIterator('ConsentfriendServices', $c);
        foreach ($services as $service) {
            $service = $this->prepareRow($service);
            $service['cookies'] = json_decode($service['cookies'], true);
            $result[] = $service;
        }

        return $result;
    }

    /**
     * Get config data.
     *
     * @return array
     */
    function getConfig()
    {
        $result = [];

        $c = $this->modx->newQuery('modSystemSetting');
        $c->select($this->modx->getSelectColumns('modSystemSetting', 'modSystemSetting', '', ['id', 'key', 'value']));
        $c->where([
            'namespace' => 'consentfriend',
            'area:!=' => 'Git Package Management Settings'
        ]);
        $c->sortby($this->modx->getSelectColumns('modSystemSetting', 'modSystemSetting', '', ['area']));
        $c->sortby($this->modx->getSelectColumns('modSystemSetting', 'modSystemSetting', '', ['key']));

        /** @var modSystemSetting[] $settings */
        $settings = $this->modx->getIterator('modSystemSetting', $c);
        foreach ($settings as $setting) {
            $result = array_merge($result, $this->prepareSetting($setting));
        }

        return $result;
    }

    /**
     * Prepare the row.
     *
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);
        unset($ta['id']);
        return $ta;
    }

    /**
     * Prepare the setting value on base of the setting xtype.
     *
     * @param xPDOObject $setting
     * @return array
     */
    public function prepareSetting(xPDOObject $setting)
    {
        switch ($setting->get('xtype')) {
            case 'combo-boolean':
                $value = (bool)$setting->get('value');
                break;
            case 'numberfield':
                $value = (int)$setting->get('value');
                break;
            default:
                $value = $setting->get('value');
                break;
        }

        return [substr($setting->get('key'), strlen('consentfriend.')) => $value];
    }

    /**
     * Handle the export to YAML.
     *
     * @param array $list
     * @param string $type
     * @param string $cookieName
     */
    public function handleExport(array $list, string $type, string $cookieName)
    {
        if (count($list)) {
            $yaml = Yaml::dump($list, 6, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

            header('Content-Type: application/x-yaml');
            header('Content-Disposition: attachment; filename="consenfriend_' . $type . '_' . strftime('%Y-%m-%d_%H-%M-%S') . '.yml"');
            if ($cookieName) {
                setcookie($cookieName, 'true', time() + 10, '/');
            }
            echo $yaml;
        }
        @session_write_close();
        exit;
    }
}
