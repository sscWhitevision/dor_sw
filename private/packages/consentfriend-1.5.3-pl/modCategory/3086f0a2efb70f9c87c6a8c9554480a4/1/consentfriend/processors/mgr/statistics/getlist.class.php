<?php
/**
 * Get Rank
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectGetListProcessor;

class ConsentFriendStatisticsGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'ConsentfriendLogs';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'consentfriend.logs';

    /*** @var array $translatedServices */
    private $translatedServices = [];

    public function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        /** @var modProcessorResponse $response */
        $response = $this->modx->runProcessor('mgr/services/getlist', [], array(
            'processors_path' => $this->consentfriend->getOption('processorsPath')
        ));
        if ($response) {
            $services = json_decode($response->getResponse(), true);
            if ($services && !empty($services['results'])) {
                foreach ($services['results'] as $service) {
                    if ($service['title_translated']) {
                        $this->translatedServices[$service['name']] = $service['title_translated'];
                    }
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey, '', ['id', 'first_visit', 'last_visit', 'user_ip', 'services']));

        if ($this->getProperty('type') === 'enabled') {
            $c->where(['services:<>' => '']);
        }
        if ($this->getProperty('start_date') !== 'false') {
            $c->where([
                'first_visit:>=' => strtotime($this->getProperty('start_date')),
                'OR:last_visit:>=' => strtotime($this->getProperty('start_date')),
            ]);
        }
        $c->sortby('first_visit', 'DESC');
        $c->sortby('last_visit', 'DESC');

        return $c;
    }

    /**
     * {@inheritDoc}
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);

        $services = json_decode($ta['services'], true);
        if ($services) {
            $allowedServices = [];
            foreach ($services as $service => $allowed) {
                if (!in_array($service, ['consentFriend', 'session'])) {
                    if ($allowed) {
                        $allowedServices[] = $this->translatedServices[$service] ?? $service;
                    }
                }
            }
            sort($allowedServices);
            $allowedServices = ($allowedServices) ? implode(', ', $allowedServices) : $this->modx->lexicon('consentfriend.logged_active');
        } else {
            $allowedServices = $this->modx->lexicon('consentfriend.logged_inactive');
        }
        $ta['services'] = $allowedServices;

        $visit = max($ta['last_visit'], $ta['first_visit']);
        $ta['visit'] = ($visit) ? strftime('%Y-%m-%d %H:%M:%S', $visit) : '';


        return $ta;
    }
}

return 'ConsentFriendStatisticsGetListProcessor';