<?php
/**
 * Get Chart
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectGetListProcessor;

class ConsentFriendStatisticsGetChartProcessor extends ObjectGetListProcessor
{
    public $classKey = 'ConsentfriendLogs';
    public $defaultSortField = 'count';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'consentfriend.logs';
    public $palette = [
        'rgb(203,216,66)',
        'rgb(158,150,89)',
        'rgb(0,198,87)',
        'rgb(120,120,67)',
        'rgb(119,205,64)',
        'rgb(16,99,76)',
        'rgb(173,194,63)',
        'rgb(0,184,170)',
        'rgb(139,142,0)',
        'rgb(0,143,112)',
        'rgb(106,158,0)',
        'rgb(137,198,155)',
        'rgb(14,109,0)',
        'rgb(190,189,97)',
        'rgb(55,209,121)',
        'rgb(62,91,0)',
        'rgb(107,205,108)',
        'rgb(103,137,90)',
        'rgb(0,152,48)',
        'rgb(145,198,131)',
        'rgb(0,173,91)'
    ];

    /*** @var array $translatedServices */
    private $translatedServices = [];

    public function process()
    {
        $c = $this->modx->newQuery($this->classKey);
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey, '', ['services']));
        $c->select('COUNT(*) AS count');
        if ($this->getProperty('type') === 'enabled') {
            $c->where(['services:<>' => '']);
        }
        if ($this->getProperty('start_date') !== 'false') {
            $c->where([
                'first_visit:>=' => strtotime($this->getProperty('start_date')),
                'OR:last_visit:>=' => strtotime($this->getProperty('start_date')),
            ]);
        }
        $c->sortby('count', 'DESC');
        $c->groupby($this->classKey . '.services');

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

        if ($c->prepare()) {
            $cq = new xPDOCriteria($this->modx, "SELECT COUNT(*) FROM ({$c->toSQL(false)}) cq", $c->bindings, $c->cacheFlag);
            $total = ($cq->stmt && $cq->stmt->execute()) ? intval($cq->stmt->fetchColumn()) : 0;

            $c->limit($this->getProperty('limit', 10), $this->getProperty('offset', 0));
            if ($c->prepare()) {
                $list = [];
                $i = 0;
                if ($c->stmt->execute()) {
                    while ($data = $c->stmt->fetch(PDO::FETCH_OBJ)) {
                        $services = json_decode($data->services, true);
                        $allowedServices = [];
                        if ($services) {
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
                        $list[] = [
                            'label' => $allowedServices,
                            'value' => $data->count,
                            'color' => $this->palette[$i]
                        ];
                        $i++;
                    }
                }
                return $this->outputArray($list, $total);
            }
        }
        return $this->failure('Could not retrieve data');
    }

    /**
     * {@inheritDoc}
     * @param array $array An array of data objects.
     * @param mixed $count The total number of objects. Not used here.
     * @return string The JSON output.
     */
    public function outputArray(array $array, $count = false)
    {
        $values = [];
        $labels = [];
        $colors = [];
        foreach ($array as $item) {
            $values[] = $item['value'];
            $labels[] = $item['label'];
            $colors[] = $item['color'];
        }

        $output = json_encode([
            'success' => true,
            'data' => [
                'datasets' => [
                    (object)[
                        'data' => $values,
                        'backgroundColor' => $colors,
                        'label' => $this->modx->lexicon('consentfriend.widget.services')
                    ]
                ],
                'labels' => $labels
            ]
        ]);
        if ($output === false) {
            $this->modx->log(xPDO::LOG_LEVEL_ERROR, 'Processor failed creating output array due to JSON error ' . json_last_error());
            return json_encode([
                'success' => false
            ]);
        }
        return $output;
    }
}

return 'ConsentFriendStatisticsGetChartProcessor';