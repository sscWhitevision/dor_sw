<?php
/**
 * Creates a cbField object.
 *
 * @property cbField $object
 */
class cbFieldCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cbField';
    public $languageTopics = array('contentblocks:default');
    public $permission = array('contentblocks_fields_new' => true, 'contentblocks_fields_save' => true);

    /**
     * @return bool
     */
    public function beforeSet() {
        $prop = $this->getProperty('properties');
        if (empty($prop)) {
            $this->modx->contentblocks->loadInputs();
            if (isset($this->modx->contentblocks->inputs[$this->getProperty('input')])) {
                /** @var cbBaseInput $input */
                $input = $this->modx->contentblocks->inputs[$this->getProperty('input')];
                $fieldProps = $input->getFieldProperties();

                $prop = array();
                foreach ($fieldProps as $oneProp) {
                    $prop[$oneProp['key']] = $oneProp['default'];
                }
            }
        }
        $prop = $this->modx->toJSON($prop);
        $this->setProperty('properties', $prop);

        $parentProps = $this->getProperty('parent_properties');
        if (!empty($parentProps)) {
            $parentProps = $this->modx->toJSON($parentProps);
            $this->setProperty('parent_properties', $parentProps);
        }

        $sort = (int)$this->getProperty('sortorder', 0);
        if ($sort < 1) {
            $sort = $this->modx->getCount($this->classKey) + 1;
            $this->setProperty('sortorder', $sort);
        }
        return parent::beforeSet();
    }

    public function afterSave()
    {
        // If this is a duplicate...
        $duplicateOf = (int)$this->getProperty('duplicate_of');
        if ($duplicateOf > 0) {

            // Find all current subfields in the group (ie repeaters)
            $c = $this->modx->newQuery('cbField');
            $c->where([
                'parent' => $duplicateOf,
            ]);
            $c->sortby('sortorder', 'ASC');
            /** @var cbField[] $fields */
            $fields = $this->modx->getIterator('cbField', $c);
            foreach ($fields as $fld) {
                // Copy all the field data
                $data = $fld->toArray('', true);
                unset($data['id']);
                $data['parent'] = $this->object->get('id');

                // and create a new field from it
                /** @var cbField $newFld */
                $newFld = $this->modx->newObject('cbField');
                $newFld->fromArray($data, '', false, true);
                $newFld->save();
            }
        }
        return parent::afterSave();
    }
}
return 'cbFieldCreateProcessor';
