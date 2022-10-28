<?php
/**
 * Get List Services
 *
 * @package consentfriend
 * @subpackage processors
 */

use TreehillStudio\ConsentFriend\Processors\ObjectGetListProcessor;

/**
 * Class ConsentfriendServicesGetListProcessor
 */
class ConsentfriendServicesGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'ConsentfriendServices';
    public $objectType = 'consentfriend.services';

    /**
     * {@inheritDoc}
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $valuesQuery = $this->getProperty('valuesqry');
        $query = (!$valuesQuery) ? $this->getProperty('query') : '';
        if (!empty($query)) {
            $c->where([
                $this->classKey . '.name:LIKE' => '%' . $query . '%',
                'OR:' . $this->classKey . '.title:LIKE' => '%' . $query . '%'
            ]);
        }

        if (!$this->getProperty('combo', false)) {
            $c->leftJoin('ConsentfriendServicePurposes', 'ServicePurposes');
            $c->leftJoin('ConsentfriendPurposes', 'Purpose', ['ServicePurposes.purpose_id = Purpose.id']);

            $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
            $c->select($this->modx->getSelectColumns('ConsentfriendPurposes', 'Purpose', 'purpose_', ['key', 'title', 'sortindex']));
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
        return $list;
    }

    /**
     * {@inheritDoc}
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);

        if (!$this->getProperty('combo', false)) {
            $ta['purposes_formatted'] = [];
            $ta['purposes'] = [];
            $ta['contexts_formatted'] = [];
            $ta['contexts'] = [];

            $c = $this->modx->newQuery('ConsentfriendServicePurposes');
            $c->leftJoin('ConsentfriendPurposes', 'Purpose');
            $c->where([
                'service_id' => $ta['id']
            ]);
            $c->sortby($this->defaultSortField, $this->defaultSortDirection);

            /** @var ConsentfriendServicePurposes[] $servicePurposes */
            $servicePurposes = $this->modx->getIterator('ConsentfriendServicePurposes', $c);
            foreach ($servicePurposes as $servicePurpose) {
                /** @var ConsentfriendPurposes $purpose */
                $purpose = $servicePurpose->getOne('Purpose');
                if ($purpose->get('title')) {
                    $ta['purposes_formatted'][] = $purpose->get('title');
                } else {
                    $ta['purposes_formatted'][] = $this->modx->lexicon('consent' . 'friend.purposes.' . $purpose->get('key') . '.title');
                }
                $ta['purposes'][] = $purpose->get('id');
            }
            $ta['purposes_formatted'] = implode(', ', $ta['purposes_formatted']);
            $ta['purposes'] = implode('|', $ta['purposes']);

            $d = $this->modx->newQuery('ConsentfriendServiceContexts');
            $d->leftJoin('modContext', 'Context');
            $d->where([
                'service_id' => $ta['id']
            ]);
            $d->sortby('Context.rank');
            $d->sortby('Context.key');

            /** @var ConsentfriendServiceContexts[] $serviceContexts */
            $serviceContexts = $this->modx->getIterator('ConsentfriendServiceContexts', $d);
            foreach ($serviceContexts as $serviceContext) {
                /** @var modContext $context */
                $context = $serviceContext->getOne('Context');
                $ta['contexts_formatted'][] = ($context->get('name')) ? $context->get('name') : $context->get('key');
                $ta['contexts'][] = $context->get('key');
            }
            $ta['contexts_formatted'] = implode(', ', $ta['contexts_formatted']);
            $ta['contexts'] = implode('|', $ta['contexts']);
        }

        if ($ta['title']) {
            $ta['title_formatted'] = $ta['title'];
            $ta['title_translated'] = ($this->getBooleanProperty('combo', false)) ? $ta['title'] : '';
        } else {
            if ($this->modx->lexicon($this->objectType . '.' . $ta['name'] . '.title') !== $this->objectType . '.' . $ta['name'] . '.title') {
                $ta['title_formatted'] = '<span class="green">' . $this->modx->lexicon($this->objectType . '.' . $ta['name'] . '.title') . '</span>';
                $ta['title_translated'] = $this->modx->lexicon($this->objectType . '.' . $ta['name'] . '.title');
            } else {
                $ta['title_formatted'] = '<span class="red">' . $this->objectType . '.' . $ta['name'] . '.title' . '</span>';
                $ta['title_translated'] = ($this->getProperty('combo')) ? '(' . $ta['name'] . ')' : '';
            }
        }
        if (!$ta['description']) {
            $ta['description_translated'] = $this->modx->lexicon($this->objectType . '.' . $ta['name'] . '.description');
        }

        return $ta;
    }
}

return 'ConsentfriendServicesGetListProcessor';
