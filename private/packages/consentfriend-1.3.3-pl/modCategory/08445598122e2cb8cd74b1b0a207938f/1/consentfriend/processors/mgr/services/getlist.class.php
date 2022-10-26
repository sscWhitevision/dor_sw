<?php
/**
 * Get list processor
 *
 * @package consentfriend
 * @subpackage processor
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
    public function prepareQueryBeforeCount(xPDOQuery $c): xPDOQuery
    {
        $valuesQuery = $this->getProperty('valuesqry');
        $query = (!$valuesQuery) ? $this->getProperty('query') : '';
        if (!empty($query)) {
            $c->where([
                $this->classKey . '.name:LIKE' => '%' . $query . '%',
                'OR:' . $this->classKey . '.title:LIKE' => '%' . $query . '%'
            ]);
        }
        $c->where([
            'Purpose.active' => true,
            'OR:Purpose.active:IS' => null
        ]);

        $c->leftJoin('ConsentfriendServicePurposes', 'ServicePurposes');
        $c->leftJoin('ConsentfriendPurposes', 'Purpose', ['ServicePurposes.purpose_id = Purpose.id']);

        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->select($this->modx->getSelectColumns('ConsentfriendPurposes', 'Purpose', 'purpose_', ['key', 'title', 'sortindex']));

        return $c;
    }

    /**
     * {@inheritDoc}
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object): array
    {
        $ta = $object->toArray('', false, true);
        $ta['purposes_formatted'] = [];
        $ta['purposes'] = [];

        $c = $this->modx->newQuery('ConsentfriendServicePurposes');
        $c->leftJoin('ConsentfriendPurposes', 'Purpose');
        $c->where([
            'service_id' => $ta['id'],
            [
                'Purpose.active' => true,
                'OR:Purpose.active:IS' => null
            ]
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
                $ta['purposes_formatted'][] = $this->modx->lexicon('consentfriend.purposes.' . $purpose->get('key') . '.title');
            }
            $ta['purposes'][] = $purpose->get('id');
        }
        $ta['purposes_formatted'] = implode(', ', $ta['purposes_formatted']);
        $ta['purposes'] = implode('|', $ta['purposes']);

        if ($ta['title']) {
            $ta['title_formatted'] = $ta['title'];
            $ta['title_translated'] = ($this->getProperty('combo')) ? $ta['title'] : '';
        } else {
            if ($this->modx->lexicon('consentfriend.services.' . $ta['name'] . '.title') !== 'consentfriend.services.' . $ta['name'] . '.title') {
                $ta['title_formatted'] = '<span class="green">' . $this->modx->lexicon('consentfriend.services.' . $ta['name'] . '.title') . '</span>';
                $ta['title_translated'] = $this->modx->lexicon('consentfriend.services.' . $ta['name'] . '.title');
            } else {
                $ta['title_formatted'] = '<span class="red">' . 'consentfriend.services.' . $ta['name'] . '.title' . '</span>';
                $ta['title_translated'] = '';
            }
        }
        if (!$ta['description']) {
            $ta['description_translated'] = $this->modx->lexicon('consentfriend.services.' . $ta['name'] . '.description');
        }

        return $ta;
    }
}

return 'ConsentfriendServicesGetListProcessor';
