<?php
/**
 * Searches modResources.
 */
class RedactorResourceSearchProcessor extends modObjectGetListProcessor {
    public $classKey = 'modResource';
    public $languageTopics = array('resource');
    public $defaultSortField = 'pagetitle';
    public $includeIntrotext = true;

    protected $_resourceNames = array();
    protected $_contextNames = array();
    /**
     * @var string The context key to limit to
     */
    protected $context;
    protected $limitToContext = false;
    /**
     * @var Redactor
     */
    protected $redactor;
    /**
     * @var redConfigurationSet
     */
    protected $configurationSet;

    public function initialize() {
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        $this->redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
        if (!($this->redactor instanceof Redactor)) {
            return 'Could not load Redactor';
        }

        $configSetId = (int)$this->getProperty('configuration');
        $configSet = $this->modx->getObject('redConfigurationSet', ['id' => $configSetId]);
        if (!($configSet instanceof redConfigurationSet)) {
            return 'Configuration set not found.';
        }
        $this->configurationSet = $configSet;

        $this->limitToContext = $this->configurationSet->getConfiguredOption('linkResourceLimitToContext', false);
        $ctxKey = (string)$this->getProperty('context', 'web');
        if ($context = $this->modx->getObject('modContext', ['key' => $ctxKey])) {
            $this->redactor->setWorkingContext($context->get('key'));
            $this->context = $context->get('key');
        }

        $this->includeIntrotext = $this->configurationSet->getConfiguredOption('linkResourceIncludeIntrotext', true);
        return parent::initialize();
    }

    /**
     * Adjust the query prior to the COUNT statement to only get top contenders.
     *
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        $c->where([
            'deleted' => false,
        ]);

        /**
         * Limit results to the resource
         */
        if ($this->limitToContext && $this->context) {
            $c->andCondition(array(
                'context_key' => $this->context
            ));
        }

        /**
         * Preview and Workflow stores additional copies of resources under specific resources. This block of code
         * ensures that those revision copies don't show up in the link search.
         */
        $previewContainers = $this->modx->getOption('preview.resourceHolder');
        if (!empty($previewContainers)) {
            $pcs = $this->modx->fromJSON($previewContainers);
            $containerIds = array_values($pcs);
            if (!empty($containerIds)) {
                $c->andCondition([
                    'parent:NOT IN' => $containerIds,
                    'and:id:NOT IN' => $containerIds
                ]);
            }
        }

        // Run the actual search based on the provided query
        if (empty($query)) {
            $actualSearch = [
                'parent' => 0,
                'published' => true,
                'hidemenu' => false,
            ];
        }
        elseif (is_numeric($query)) {
            $actualSearch = [
                'id' => (int)$query,
            ];
        }
        else {
            $actualSearch = [
                'pagetitle:LIKE' => "%$query%",
                'OR:longtitle:LIKE' => "%$query%",
                'OR:menutitle:LIKE' => "%$query%",
                'OR:introtext:LIKE' => "%$query%",
            ];
        }

        $c->andCondition($actualSearch);

        $c->select($this->modx->getSelectColumns('modResource', 'modResource', '', [
            'id',
            'pagetitle',
            'introtext',
            'context_key'
        ]));

        // For multiple contexts, group the results
        if (!$this->limitToContext) {
            $c->sortby('context_key', 'ASC');
        }
        $c->sortby('pagetitle', 'ASC');
        $c->sortby('menuindex', 'ASC');

        return $c;
    }

    /**
     * Prepare the row into an array.
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $objectArray = $object->toArray('', false, true);
        $objectArray['id'] = (string)$objectArray['id']; // JS library needs strings for values
        $objectArray['pagetitle'] = $this->_escape($objectArray['pagetitle']);
        $objectArray['introtext'] = $this->includeIntrotext ? $this->_escape(strip_tags($objectArray['introtext'])) : '';

        $crumbs = [];
        if (!$this->limitToContext) {
            $crumbs[] = $this->_getContextName($object->get('context_key'));
        }

        // Get the parents
        $parents = $this->modx->getParentIds($object->get('id'), 10, array('context' => $object->get('context_key')));
        // Flip the order so we to top > bottom
        $parents = array_reverse($parents);
        foreach ($parents as $id) {
            $crumb = $this->_getResourceTitle($id);
            if (!empty($crumb)) {
                $crumbs[] = $crumb;
            }
        }

        $objectArray['crumbs'] = implode(' &raquo; ', $crumbs);

        return $objectArray;
    }

    /**
     * Return arrays of objects (with count) converted to JSON.
     *
     * The JSON result includes two main elements, total and results. This format is used for list
     * results.
     *
     * @access public
     * @param array $array An array of data objects.
     * @param mixed $count The total number of objects. Used for pagination.
     * @return string The JSON output.
     */
    public function outputArray(array $array,$count = false)
    {
        return $this->modx->toJSON($array);
    }

    protected function _getContextName($key)
    {
        if (array_key_exists($key, $this->_contextNames)) {
            return $this->_contextNames[$key];
        }

        // Create a (safe) query for the context
        $c = $this->modx->newQuery('modContext');
        $c->select($this->modx->getSelectColumns('modContext', 'modContext', '', array('key', 'name')));
        $c->where(array(
            'key' => $key
        ));

        // Run it as a PDO statement; this bypasses ACLs and is also faster for this purpose.
        $c->prepare();
        $stmt = $this->modx->query($c->toSQL());
        if ($stmt->execute() && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = $this->_escape($row['name']);
            $this->_contextNames[$row['key']] = $name;
            return $name;
        }
        return $key;
    }

    protected function _getResourceTitle($id)
    {
        if ($id < 1) {
            return '';
        }
        if (array_key_exists($id, $this->_resourceNames)) {
            return $this->_resourceNames[$id];
        }

        // Create a (safe) query for the resource
        $c = $this->modx->newQuery('modResource');
        $c->select($this->modx->getSelectColumns('modResource', 'modResource', '', array('id', 'pagetitle')));
        $c->where(array(
            'id' => $id
        ));

        // Run it as a PDO statement; this bypasses ACLs and is also faster for this purpose.
        $c->prepare();
        $stmt = $this->modx->query($c->toSQL());
        if ($stmt->execute() && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pagetitle = $this->_escape($row['pagetitle']);
            $this->_resourceNames[$row['id']] = $pagetitle;
            return $pagetitle;
        }
        return '#' . $id;
    }

    private function _escape($string): string
    {
        $charset = $this->redactor->getOption('modx_charset', null, 'UTF-8');
        return htmlentities($string, ENT_COMPAT, $charset);
    }
}
return 'RedactorResourceSearchProcessor';
