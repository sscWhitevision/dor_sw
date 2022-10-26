<?php
/**
 * Get list Contexts
 *
 * @package consentfriend
 * @subpackage processors
 */

// Compatibility between 2.x/3.x
if (file_exists(MODX_PROCESSORS_PATH . 'context/getlist.class.php')) {
    require_once MODX_PROCESSORS_PATH . 'context/getlist.class.php';
} elseif (!class_exists('modContextGetListProcessor')) {
    class_alias(\MODX\Revolution\Processors\Context\GetList::class, \modContextGetListProcessor::class);
}

/**
 * Class ConsentFriendContextGetListProcessor
 */
class ConsentFriendContextGetListProcessor extends modContextGetListProcessor
{
    public $defaultSortField = 'key';

    /**
     * @return bool
     */
    public function initialize()
    {
        $initialized = parent::initialize();
        $this->setProperty('exclude', 'mgr');
        $this->canEdit = false;
        $this->canRemove = false;
        return $initialized;
    }

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);

        $c->sortby('rank');

        if (!$this->getProperty('combo', false)) {
            $c->select($this->modx->getSelectColumns($this->classKey, 'modContext'));
            $c->leftJoin('ConsentfriendServiceContexts', 'ServiceContexts', ['modContext.key = ServiceContexts.context_key']);
            $c->leftJoin('ConsentfriendServices', 'Service', ['ServiceContexts.service_id = Service.id']);
            $c->select($this->modx->getSelectColumns('ConsentfriendServices', 'Service', 'service_'));
        }

        return $c;
    }

    /**
     * {@inheritDoc}
     * @param array $list
     * @return array
     */
    public function beforeIteration(array $list)
    {
        if (!$this->getProperty('id') && ($this->getProperty('combo', false) === 'true' || $this->getProperty('combo', false) === '1')) {
            $empty = [
                'key' => '',
                'name' => $this->modx->lexicon('ext_emptygroup'),
            ];
            $list[] = $empty;
        }

        return $list;
    }

    /**
     * {@inheritDoc}
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray();

        $this->modx->lexicon->load('consentfriend:web', 'consentfriend:services');

        if ($this->getProperty('combo', false)) {
            $ta = [
                'key' => $ta['key'],
                'name' => ($ta['name']) ? $ta['name'] . ' (' . $ta['key'] . ')' : $ta['key'],
            ];
        } else {
            $ta['services_formatted'] = [];
            $ta['services'] = [];

            $c = $this->modx->newQuery('ConsentfriendServiceContexts');
            $c->leftJoin('ConsentfriendServices', 'Service');
            $c->where([
                'context_key' => $ta['key']
            ]);
            $c->sortby('Service.sortindex');

            /** @var ConsentfriendServiceContexts[] $serviceContexts */
            $serviceContexts = $this->modx->getIterator('ConsentfriendServiceContexts', $c);
            foreach ($serviceContexts as $serviceContext) {
                /** @var ConsentfriendServices $service */
                $service = $serviceContext->getOne('Service');
                if ($service->get('title')) {
                    $ta['services_formatted'][] = $service->get('title');
                } else {
                    $ta['services_formatted'][] = $this->modx->lexicon('consent' . 'friend.services.' . $service->get('name') . '.title');
                }
                $ta['services'][] = $service->get('id');
            }
            $ta['services_formatted'] = implode(', ', $ta['services_formatted']);
            $ta['services'] = implode('|', $ta['services']);
        }

        return $ta;
    }
}

return 'ConsentFriendContextGetListProcessor';
