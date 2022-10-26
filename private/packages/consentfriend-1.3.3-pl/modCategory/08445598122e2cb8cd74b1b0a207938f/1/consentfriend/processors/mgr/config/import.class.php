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
 * Class ConsentfriendConfigImportProcessor
 */
class ConsentfriendConfigImportProcessor extends Processor
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
            try {
                $yaml = Yaml::parseFile($file['tmp_name']);
            } catch (ParseException $e) {
                return $this->failure($this->modx->lexicon('consentfriend.config_err_yaml') . $e->getMessage());
            }
        }

        if (!$yaml) {
            return $this->failure($this->modx->lexicon('consentfriend.service_err_importing_file'));
        }

        // Make sure this is a consentfriend export
        if ($yaml['package'] !== 'consentfriend' || !isset($yaml['purposes']) || !isset($yaml['services'])) {
            return $this->failure($this->modx->lexicon('consentfriend.config_err_not_an_export'));
        }
        if (!isset($yaml['services'])) {
            $yaml['services'] = [];
        }

        $mode = 'replace';

        $import = new Import($this->modx);

        if ($mode === 'replace') {
            $import->removeData();
        }

        try {
            $import->setPurposes($yaml['purposes'], $mode);
            $import->setServices($yaml['services'], $mode);
            $import->setConfig($yaml['config'], $mode);
        } catch (Exception $e) {
            return $this->failure($e->getMessage());
        }

        return $this->success();
    }
}

return 'ConsentfriendConfigImportProcessor';
