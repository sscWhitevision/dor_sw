<?php

/**
 * Class ContentBlocksImportProcessor
 */
abstract class ContentBlocksImportProcessor extends modProcessor
{
    public $classKey;
    public $mode = 'insert';
    /** @var ContentBlocks */
    public $contentBlocks;

    protected $allowedRelations = ['Category', 'Children'];

    public function initialize() {
        $corePath = $this->modx->getOption('contentblocks.core_path', null, $this->modx->getOption('core_path') . 'components/contentblocks/');
        $this->contentBlocks =& $this->modx->getService('contentblocks', 'ContentBlocks', $corePath . 'model/contentblocks/');

        $mode = $this->getProperty('mode');
        if (in_array($mode, array('insert', 'overwrite', 'replace'))) {
            $this->mode = $mode;
        }

        $this->modx->setLogLevel(modX::LOG_LEVEL_DEBUG);
        $this->backup();

        return parent::initialize();
    }

    /**
     * Fetches the data, generates XML and tells the browser to download it.
     *
     * @return mixed
     */
    public function process()
    {
        $file = $_FILES['file'];
        $xml = false;
        if (!empty($file['tmp_name']) && file_exists($file['tmp_name'])) {
            $xml = simplexml_load_file($file['tmp_name'], 'SimpleXMLElement', LIBXML_NOCDATA);
        }

        if (!$xml) {
            return $this->failure($this->modx->lexicon('contentblocks.error.xml_not_loaded'));
        }

        // Make sure this is a contentblocks export
        $package = (string) $xml->attributes()->{'package'};
        if ($package !== 'contentblocks') {
            return $this->failure($this->modx->lexicon('contentblocks.error.not_an_export'));
        }

        $data = $this->fromXML($xml);
        if (empty($data)) {
            return $this->failure($this->modx->lexicon('contentblocks.error.not_an_export') . ' - no data found in file.');
        }

        if (!array_key_exists($this->classKey, $data) || !is_array($data[$this->classKey])) {
            return $this->failure($this->modx->lexicon('contentblocks.error.not_an_export') . ' - no data of type ' . $this->classKey . ' found in file.');
        }

        if ($this->mode === 'replace') {
            $this->removeCollection();
        }

        foreach ($data[$this->classKey] as $row) {
            /** @var xPDOObject $importedObject */
            $importedObject = false;
            switch ($this->mode) {
                case 'overwrite':
                    $importedObject = $this->modx->getObject($this->classKey, (int)$row['id']);
                    break;

                case 'insert':
                    unset($row['id']);
                    break;
            }

            if (!$importedObject) {
                $importedObject = $this->modx->newObject($this->classKey);
            }

            $importedObject->fromArray($row, '', true);
            if (!$importedObject->save()) {
                return $this->failure($this->modx->lexicon('contentblocks.error.importing_row') . $importedObject->toJSON());
            }

            // Handle relations, if any.
            foreach ($this->allowedRelations as $relation) {
                if (array_key_exists($relation, $row)) {
                    $this->importRelatedObjects($importedObject, $relation, $row[$relation]);
                }
            }
        }


        return $this->success();
    }


    private function importRelatedObjects(xPDOObject $importedObject, $alias, $data)
    {
        $attributes = $data['@attributes'];
        $class = $attributes['class'];
        $rows = (array)($data[$class] ?? []);

        $this->modx->log(modX::LOG_LEVEL_DEBUG, "Adding related {$alias} ({$class}) to {$importedObject->get('id')}: " . print_r($rows, true));

        // If we're overwriting data and have a composite relationship, first wipe all current assigned objects
        // Without this it's _really_ hard to figure out how to update or insert changes to an overwrite import
        if ($this->mode === 'overwrite' && $attributes['type'] === 'composite') {
            $this->modx->removeCollection($class, [
                $attributes['foreign'] => $importedObject->get($attributes['local'])
            ]);
        }

        // Loop over each related object of this type
        foreach ($rows as $row) {
            $related = null;

            // Fetch categories by name
            if ($attributes['class'] === cbCategory::class) {
                $related = $this->modx->getObject(cbCategory::class, [
                    'name' => $row['name']
                ]);
            }

            // Fetch one-to-one relations by foreign key
            elseif ($attributes['cardinality'] === 'one') {
                $related = $this->modx->getObject($class, [
                    $attributes['foreign'] => $importedObject->get($attributes['local']),
                ]);
            }

            // Don't fetch one-to-many relations; create new object instead
            if (!$related) {
                $related = $this->modx->newObject($class);
            }

            // Remove ID and foreign key (may be the same thing to avoid overwriting that
            unset($row['id'], $row[$attributes['foreign']]);
            $related->fromArray($row);

            $attributes['cardinality'] === 'one'
                ? $importedObject->addOne($related, $alias)
                : $importedObject->addMany($related, $alias);

            $importedObject->save();

            $this->modx->log(modX::LOG_LEVEL_DEBUG, "Added related {$class} to {$importedObject->get('id')}: " . print_r($related->toArray(), true));
        }
    }

    /**
     * Removes existing records in "replace" mode
     */
    public function removeCollection()
    {
        $this->modx->removeCollection($this->classKey, array());
    }

    abstract public function backup();

    private function fromXML(SimpleXMLElement $xml)
    {
        $value = trim((string)$xml);
        if (!empty($value)) {
            return $value;
        }


        $return = [];
        foreach ($xml as $key => $node) {
            $key = $node->getName();
            $children = [];
            if ($node->children()) {
                foreach ($node->children() as $childKey => $child) {
                    $children[$childKey] = $this->fromXML($child);
                }
            }
            else {
                $return[$key] = (string)$node;
            }

            if (count($children) > 0) {
                $return[$key][] = $children;
            }
            $nodeAttributes = [];
            foreach($node->attributes() as $name => $attribute) {
                $nodeAttributes[$name] = trim((string)$attribute);
            }
            if (count($nodeAttributes) > 0) {
                $return[$key]['@attributes'] = $nodeAttributes;
            }
        }

        if (count($return) === 0) {
            return null;
        }

        $attributes = [];
        foreach($xml->attributes() as $name => $node) {
            $attributes[$name] = trim((string)$node);
        }
        if (!empty($attributes)) {
            $return['@attributes'] = $attributes;
        }

        return $return;
    }
}
