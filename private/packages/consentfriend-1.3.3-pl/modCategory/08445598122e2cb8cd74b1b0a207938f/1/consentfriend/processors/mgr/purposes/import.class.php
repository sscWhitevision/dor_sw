<?php
/**
 * Import processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Helper\Import;
use TreehillStudio\ConsentFriend\Processors\Processor;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConsentfriendPurposesImportProcessor
 */
class ConsentfriendPurposesImportProcessor extends Processor
{
    /**
     * Open the uploaded file, parse YAML and import the data.
     *
     * @return array|string
     */
    public function process()
    {
        $file = $_FILES['file'];
        $yaml = false;
        if (!empty($file['tmp_name']) && file_exists($file['tmp_name'])) {
            $xml = simplexml_load_file($file['tmp_name'], 'SimpleXMLElement', LIBXML_NOCDATA);
            if ($xml) {
                $data = [];
                foreach ($xml->purpose as $object) {
                    // Turn $object into an array
                    $a = [];
                    foreach ($object as $key => $value) {
                        $a[(string)$key] = (string)$value;
                    }
                    $data[] = $a;
                }
                $yaml = [
                    'package' => (string)$xml->attributes()->{'package'},
                    'purposes' => $data
                ];
            } else {
                try {
                    $yaml = Yaml::parseFile($file['tmp_name']);
                } catch (ParseException $e) {
                    return $this->failure($this->modx->lexicon('consentfriend.purpose_err_yaml') . $e->getMessage());
                }
            }
        }

        if (!$yaml) {
            return $this->failure($this->modx->lexicon('consentfriend.service_err_importing_file'));
        }

        // Make sure this is a consentfriend export
        if ($yaml['package'] !== 'consentfriend' || !isset($yaml['purposes'])) {
            return $this->failure($this->modx->lexicon('consentfriend.purpose_err_not_an_export'));
        }

        $mode = $this->getProperty('mode', 'replace');
        if (!in_array($mode, ['append', 'update', 'replace'])) {
            $mode = 'replace';
        }

        $import = new Import($this->modx);

        if ($mode === 'replace') {
            $import->removeData('purposes');
        }

        try {
            $import->setPurposes($yaml['purposes'], $mode);
        } catch (Exception $e) {
            return $this->failure($e->getMessage());
        }

        return $this->success();
    }
}

return 'ConsentfriendPurposesImportProcessor';
