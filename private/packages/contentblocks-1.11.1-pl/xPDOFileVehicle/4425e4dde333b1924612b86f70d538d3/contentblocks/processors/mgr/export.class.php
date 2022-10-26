<?php

/**
 * Class ContentBlocksExportProcessor
 */
abstract class ContentBlocksExportProcessor extends modProcessor
{
    public $classKey;
    public $sortKey = 'sortorder';
    public $items;
    /** @var ContentBlocks */
    public $contentBlocks;
    protected $exportRelatedObjects = ['Category'];

    /**
     * @return bool|null|string
     */
    public function initialize() {
        $corePath = $this->modx->getOption('contentblocks.core_path', null, $this->modx->getOption('core_path') . 'components/contentblocks/');
        $this->contentBlocks =& $this->modx->getService('contentblocks', 'ContentBlocks', $corePath . 'model/contentblocks/');

        $items = $this->getProperty('items');
        if(!empty($items)) {
            $this->items = array_map('trim', explode(',', $items));
        }
        return true;
    }

    /**
     * Fetches the data, generates XML and tells the browser to download it.
     *
     * @return mixed
     */
    public function process()
    {
        $c = $this->modx->newQuery($this->classKey);
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->sortby($this->sortKey, 'ASC');
        if($this->items) {
            $c->where(array('id:in' => $this->items));
        }

        $category = (int)$this->getProperty('category', 0);
        if ($category > 0) {
            $c->where(array('category' => $category));
        }

//        if (array_key_exists('category', $this->modx->getFieldMeta($this->classKey, true))) {
//            $c->leftJoin(cbCategory::class, 'Category');
//            $c->select($this->modx->getSelectColumns(cbCategory::class, 'Category', 'category_'));
//        }

        $this->prepareQueryBeforeIterate($c);

        $collection = $this->modx->getCollection($this->classKey, $c);
        $xml = $this->generateXml($collection);
        $name = $this->classKey . '_' . strtolower(str_replace(' ', '-', $this->contentBlocks->getOption('site_name'))) . '_' .  date('Y-m-d@H-i-s') . '.xml';

        if ($this->getProperty('save', false)) {
            file_put_contents(MODX_CORE_PATH . 'export/' . $name, $xml);
            return array (
                'success' => true,
                'message' => 'Created export in core/export/' . $name,
                'total' => 0,
                'errors' => array(),
                'object' => array('file' => MODX_CORE_PATH . 'export/' . $name),
            );
        }
        else {
            header('Content-Disposition: attachment; filename="' . $name);
            header('Content-Type: text/xml');
            return $xml;
        }
    }

    /**
     * Allows implementations to alter the query before it's sent.
     *
     * @param xPDOQuery $c
     */
    public function prepareQueryBeforeIterate(xPDOQuery $c): void { }

    /**
     * Takes a collection of xPDOObject's and writes it to nice XML.
     *
     * @param array $collection
     * @return string
     */
    public function generateXml(array $collection = array())
    {
        $total = 0;
        $itemsXml = array();
        foreach ($collection as $object) {
            /** @var xPDOObject $object */
            $objectArray = $object->toArray();
            $type = $object->_class;

            foreach ($this->exportRelatedObjects as $alias) {
                if (array_key_exists($alias, $object->_aggregates)) {
                    $spec =  ['type' => 'aggregate'] + $object->_aggregates[$alias];
                }
                elseif (array_key_exists($alias, $object->_composites)) {
                    $spec = ['type' => 'composite'] + $object->_composites[$alias];
                }
                if (empty($spec)) {
                    continue;
                }

                /** @var xPDOObject|xPDOObject[] $relatedObjects */
                $relatedObjects = ($spec['cardinality'] === 'one' ? $object->getOne($alias) : $object->getMany($alias)) ?? [];
                $objectArray[$alias] = [];
                if ($relatedObjects instanceof xPDOObject) {
                    $relatedObjects = [$relatedObjects];
                }

                foreach ($relatedObjects as $relatedObject) {
                    $relatedObjectArray = $relatedObject->toArray();
                    $relatedObjectArray['class_key'] = $spec['class'];
                    $objectArray[$alias][] = $relatedObjectArray;
                }

                if (count($objectArray[$alias]) > 0) {
                    $objectArray[$alias]['attributes'] = '';
                    foreach ($spec as $key => $value) {
                        $objectArray[$alias]['attributes'] .= "{$key}=\"{$value}\" ";
                    }
                }
            }

            $objectXml = $this->toXml($objectArray);
            $itemsXml[] = "<{$type}>\n\t{$objectXml}\n</{$type}>";
            $total++;
        }
        $itemsXml = implode("\n", $itemsXml);

        $time = date('Y-m-d@H:i:s');
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<data package="contentblocks" exported="$time" total="$total">
$itemsXml
</data>
XML;
        return $xml;
    }

    public function toXml(array $array, int $depth = 1): string
    {
        $xml = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $attributes = '';
                if (isset($value['attributes'])) {
                    $attributes = $value['attributes'];
                    unset($value['attributes']);
                }
                if (is_numeric($key) && isset($value['class_key'])) {
                    $key = $value['class_key'];
                    unset($value['class_key']);
                }
                $xml[] = "<{$key} {$attributes}>\n" . str_repeat("\t", $depth + 1) . $this->toXml($value, $depth + 1) . "\n" . str_repeat("\t", $depth) . "</{$key}>";
            }
            elseif (!is_numeric($value) && !is_bool($value) && !is_null($value)) {
                // Escape any "]]>" occurences inside the value per http://en.wikipedia.org/wiki/CDATA#Nesting
                $value = str_replace(']]>', ']]]]><![CDATA[>', $value);
                $xml[] = "<{$key}><![CDATA[{$value}]]></{$key}>";
            }
            else {
                $xml[] = "<{$key}>{$value}</{$key}>";
            }
        }
        $xml = implode("\n" . str_repeat("\t", $depth), $xml);
        return $xml;
    }
}
