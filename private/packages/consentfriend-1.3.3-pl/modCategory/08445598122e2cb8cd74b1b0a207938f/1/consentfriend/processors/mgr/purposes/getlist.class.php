<?php
/**
 * Get list processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Processors\ObjectGetListProcessor;

/**
 * Class ConsentfriendPurposesGetListProcessor
 */
class ConsentfriendPurposesGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'ConsentfriendPurposes';
    public $objectType = 'consentfriend.purposes';

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
                $this->classKey . '.key:LIKE' => '%' . $query . '%',
                'OR:' . $this->classKey . '.title:LIKE' => '%' . $query . '%'
            ]);
        }

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

        if ($ta['title']) {
            $ta['title_formatted'] = $ta['title'];
            $ta['title_translated'] = ($this->getProperty('combo')) ? $ta['title'] : '';
        } else {
            if ($this->modx->lexicon('consentfriend.purposes.' . $ta['key'] . '.title') !== 'consentfriend.purposes.' . $ta['key'] . '.title') {
                $ta['title_formatted'] = '<span class="green">' . $this->modx->lexicon('consentfriend.purposes.' . $ta['key'] . '.title') . '</span>';
                $ta['title_translated'] = $this->modx->lexicon('consentfriend.purposes.' . $ta['key'] . '.title');
            } else {
                $ta['title_formatted'] = '<span class="red">' . 'consentfriend.purposes.' . $ta['key'] . '.title' . '</span>';
                $ta['title_translated'] = '';
            }
        }
        if (!$ta['description']) {
            $ta['description_translated'] = $this->modx->lexicon('consentfriend.purposes.' . $ta['key'] . '.description');
        }

        return $ta;
    }
}

return 'ConsentfriendPurposesGetListProcessor';
