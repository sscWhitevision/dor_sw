<?php

/**
 * Class RedactorExportProcessor
 */
abstract class RedactorExportProcessor extends modProcessor
{
    public $classKey;
    public $sortKey = 'name';
    public $items;
    /** @var Redactor */
    public $redactor;

    /**
     * Checks if the user has sufficient permissions to perform this action.
     *
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy(['redactor_configurator' => true, 'redactor_sets_export' => true]);
    }

    /**
     * @return bool|null|string
     */
    public function initialize() {
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path') . 'components/redactor/');
        $this->redactor =& $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');

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
        $c->sortby($this->sortKey, 'ASC');
        if($this->items) {
            $c->where(array('id:in' => $this->items));
        }

        $parent = $this->getProperty('parent', 0);
        if ($this->classKey === 'cbField' && $parent > 0) {
            $c->where(array('parent' => $parent));
        }

        $collection = $this->modx->getCollection($this->classKey, $c);
        $xml = $this->generateXml($collection);
        $name = $this->classKey . '_' . strtolower(str_replace(' ', '-', $this->redactor->getOption('site_name'))) . '_' .  date('Y-m-d@H:i:s') . '.xml';

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
            header('Content-Disposition: attachment; filename="' . $name . '"');
            header('Content-Type: text/xml');
            return $xml;
        }
    }

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
            $type = $this->classKey;

            $objectXml = array();
            foreach ($objectArray as $key => $value) {
                if (!is_numeric($value) && !is_bool($value) && !is_null($value)) {
                    // Escape any "]]>" occurences inside the value per http://en.wikipedia.org/wiki/CDATA#Nesting
                    $value = str_replace(']]>', ']]]]><![CDATA[>', $value);
                    $objectXml[] = "<{$key}><![CDATA[{$value}]]></{$key}>";
                } else {
                    $objectXml[] = "<{$key}>{$value}</{$key}>";
                }
            }
            $objectXml = implode("\n\t", $objectXml);
            $itemsXml[] = "<{$type}>\n\t{$objectXml}\n</{$type}>";
            $total++;
        }
        $itemsXml = implode("\n", $itemsXml);

        $time = date('Y-m-d@H:i:s');
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<data package="redactor" exported="$time" total="$total">
$itemsXml
</data>
XML;
        return $xml;
    }
}
