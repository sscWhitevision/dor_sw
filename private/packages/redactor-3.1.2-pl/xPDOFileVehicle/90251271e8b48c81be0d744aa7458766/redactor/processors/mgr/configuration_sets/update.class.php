<?php
/**
 * Updates a redConfigurationSet object
 */
class redConfigurationSetUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'redConfigurationSet';
    public $languageTopics = ['redactor:default'];
    public $permission = ['redactor_configurator' => true, 'redactor_sets_save' => true];

    public function beforeSet()
    {
        $content = $this->getProperty('content');
        if (empty($content) && $this->object->get('class_key') === 'redConfigurationSet') {
            $content = $this->getProperties();

            // Clean up some stray keys we don't need
            $unsetKeys = array('id', 'action', 'HTTP_MODAUTH');
            foreach ($unsetKeys as $key) {
                if (array_key_exists($key, $content)) {
                    unset ($content[$key]);
                }
            }

            foreach ($content as $key => $value) {
                $this->unsetProperty($key);
            }

            $content = json_encode($content);
            $this->setProperty('content', $content);
        }

        return parent::beforeSet();
    }
}
return 'redConfigurationSetUpdateProcessor';
