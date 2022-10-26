<?php
/**
 * Update processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Processors\ObjectUpdateProcessor;

/**
 * Class ConsentfriendPurposesUpdateProcessor
 */
class ConsentfriendPurposesUpdateProcessor extends ObjectUpdateProcessor
{
    public $classKey = 'ConsentfriendPurposes';
    public $objectType = 'consentfriend.purposes';

    protected $required = [
        'key'
    ];
    protected $empty = [
        'title', 'description'
    ];

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave(): bool
    {
        foreach ($this->empty as $empty) {
            $value = $this->getProperty($empty);
            if ($value == $this->modx->lexicon($this->objectType . '.' . $this->getProperty('key') . '.' . $empty)) {
                $this->object->set($empty, '');
            }
        }
        if ($this->modx->getCount($this->classKey, [
            'key' => $this->getProperty('key'),
            'id:<>' => $this->getProperty('id')
        ])
        ) {
            $this->addFieldError('key', $this->modx->lexicon('consentfriend.purpose_err_key_ae'));
        }

        return parent::beforeSave();
    }
}

return 'ConsentfriendPurposesUpdateProcessor';
