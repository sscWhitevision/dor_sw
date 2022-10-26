<?php
/**
 * Export processor
 *
 * @package consentfriend
 * @subpackage processor
 */

use TreehillStudio\ConsentFriend\Helper\Export;
use TreehillStudio\ConsentFriend\Processors\Processor;

/**
 * Class ConsentfriendConfigExportProcessor
 */
class ConsentfriendConfigExportProcessor extends Processor
{
    /**
     * Fetches the data, generates YAML and tells the browser to download it.
     */
    public function process()
    {
        $export = new Export($this->modx);

        $list = [
            'package' => 'consentfriend',
            'purposes' => $export->getPurposes(),
            'services' => $export->getServices(),
            'config' => $export->getConfig()
        ];

        $export->handleExport($list, 'config');
    }
}

return 'ConsentfriendConfigExportProcessor';
