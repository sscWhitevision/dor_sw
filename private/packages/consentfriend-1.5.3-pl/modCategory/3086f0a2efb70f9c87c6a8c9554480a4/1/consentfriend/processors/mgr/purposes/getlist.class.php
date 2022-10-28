<?php
/**
 * Get List Purposes
 *
 * @package consentfriend
 * @subpackage processors
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
    public function prepareQueryBeforeCount(xPDOQuery $c)
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
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);

        if ($ta['title']) {
            $ta['title_formatted'] = $ta['title'];
            $ta['title_translated'] = ($this->getBooleanProperty('combo', false)) ? $ta['title'] : '';
        } else {
            if ($this->modx->lexicon($this->objectType . '.' . $ta['key'] . '.title') !== $this->objectType . '.' . $ta['key'] . '.title') {
                $ta['title_formatted'] = '<span class="green">' . $this->modx->lexicon('consent'.'friend.purposes.' . $ta['key'] . '.title') . '</span>';
                $ta['title_translated'] = $this->modx->lexicon($this->objectType . '.' . $ta['key'] . '.title');
            } else {
                $ta['title_formatted'] = '<span class="red">' . $this->objectType . '.' . $ta['key'] . '.title' . '</span>';
                $ta['title_translated'] = '';
            }
        }
        if (!$ta['description']) {
            $ta['description_translated'] = $this->modx->lexicon($this->objectType . '.' . $ta['key'] . '.description');
        }

        return $ta;
    }
}

return 'ConsentfriendPurposesGetListProcessor';
