<?php
/**
 * Gets a list of redConfigurationSet objects.
 */
class redConfigurationSetGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'redConfigurationSet';
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $languageTopics = array('redactor:configuration');
    private $tvMap = [];
    private $templateMap = [];
    private $cbFieldMap = [];

    /**
     * {@inheritDoc}
     * @return boolean
     */
    public function initialize() {
        $showNone = $this->getProperty('showNone');
        $this->setProperty('showNone', $showNone !== 'false');

        /** @var modTemplateVar $tv */
        foreach ($this->modx->getIterator('modTemplateVar', ['type' => 'redactor']) as $tv) {
            $properties = $tv->get('input_properties');
            if (is_array($properties) && isset($properties['configuration_set'])) {
                $set = (int)$properties['configuration_set'];
                if (!array_key_exists($set, $this->tvMap)) {
                    $this->tvMap[$set] = [];
                }
                $this->tvMap[$set][] = $tv->get('name');
            }
        }
        /** @var modTemplate $template */
        foreach ($this->modx->getIterator('modTemplate') as $template) {
            $properties = $template->getProperties();
            if (is_array($properties) && isset($properties['redactor.configuration_set'])) {
                $set = (int)$properties['redactor.configuration_set'];
                if (!array_key_exists($set, $this->templateMap)) {
                    $this->templateMap[$set] = [];
                }
                $this->templateMap[$set][] = $template->get('templatename');
            }
        }


        $corePath = $this->modx->getOption('contentblocks.core_path', null, MODX_CORE_PATH . 'components/contentblocks/');
        if (file_exists($corePath)
            && $cb = $this->modx->getService('contentblocks', 'ContentBlocks', $corePath . 'model/contentblocks/')
        ) {
            /** @var cbField $field */
            foreach ($this->modx->getIterator('cbField', ['input' => 'redactor']) as $field) {
                $properties = json_decode($field->get('properties'), true);
                $set = (int)($properties['configuration_set'] ?? 0);
                if (!array_key_exists($set, $this->cbFieldMap)) {
                    $this->cbFieldMap[$set] = [];
                }
                $this->cbFieldMap[$set][] = $field->get('name');
            }
        }
        return parent::initialize();
    }

    public function beforeIteration(array $list) {
        if ($this->getProperty('showNone')) {
            $list[] = array(
              'id' => 0,
              'class_key' => 'redConfigurationSet',
              'name' => '('.$this->modx->lexicon('none').')',
              'description' => '',
              'content' => '',
            );
        }
        return $list;
    }

    public function prepareRow(xPDOObject $object) {
        $arr = $object->toArray();
        $id = $object->get('id');

        $usage = [];
        $arr['is_default'] = false;
        if ((int)$this->modx->getOption('redactor.configuration_set') === $id) {
            $arr['is_default'] = true;
            $usage[] = '<b>' . $this->modx->lexicon('redactor.usage.system_default') . '</b>';
        }

        $arr['is_introtext'] = false;
        if ((bool)$this->modx->getOption('redactor.introtext')
            && ((int)$this->modx->getOption('redactor.introtext.configuration_set') === $id)) {
            $usage[] = $this->modx->lexicon('redactor.usage.introtext');
            $arr['is_introtext'] = true;
        }

        foreach ($this->modx->getIterator('modContextSetting', [
            'key' => 'redactor.configuration_set',
            'value' => $object->get('id')
        ]) as $contextSetting) {
            $key = htmlentities($contextSetting->get('context_key'), ENT_QUOTES, 'UTF-8');
            $usage[] = $this->modx->lexicon('redactor.usage.context', ['key' => $key]);
        }

        foreach ($this->modx->getIterator('modUserSetting', [
            'key' => 'redactor.configuration_set',
            'value' => $object->get('id')
        ]) as $userSetting) {
            $userId = $userSetting->get('user');
            if ($user = $this->modx->getObject('modUser', ['id' => $userId])) {
                $name = htmlentities($user->get('username'), ENT_QUOTES, 'UTF-8');
                $usage[] = $this->modx->lexicon('redactor.usage.user', ['username' => $name]);
            }
        }

        foreach ($this->modx->getIterator('modUserGroupSetting', [
            'key' => 'redactor.configuration_set',
            'value' => $object->get('id')
        ]) as $ugSetting) {
            $groupId = $ugSetting->get('group');
            if ($group = $this->modx->getObject('modUserGroup', ['id' => $groupId])) {
                $name = htmlentities($group->get('name'), ENT_QUOTES, 'UTF-8');
                $usage[] = $this->modx->lexicon('redactor.usage.usergroup', ['name' => $name]);
            }
        }

        if (array_key_exists($id, $this->tvMap)) {
            foreach ($this->tvMap[$id] as $tvName) {
                $tvName = htmlentities($tvName, ENT_QUOTES, 'UTF-8');
                $usage[] = $this->modx->lexicon('redactor.usage.tv', ['name' => $tvName]);
            }
        }

        if (array_key_exists($id, $this->cbFieldMap)) {
            foreach ($this->cbFieldMap[$id] as $fieldName) {
                $fieldName = htmlentities($fieldName, ENT_QUOTES, 'UTF-8');
                $usage[] = $this->modx->lexicon('redactor.usage.contentblocks', ['name' => $fieldName]);
            }
        }

        if (array_key_exists($id, $this->templateMap)) {
            foreach ($this->templateMap[$id] as $templateName) {
                $templateName = htmlentities($templateName, ENT_QUOTES, 'UTF-8');
                $usage[] = $this->modx->lexicon('redactor.usage.template', ['name' => $templateName]);
            }
        }

        $arr['usage'] = implode(', ', $usage);

        return $arr;
    }
}
return 'redConfigurationSetGetListProcessor';
