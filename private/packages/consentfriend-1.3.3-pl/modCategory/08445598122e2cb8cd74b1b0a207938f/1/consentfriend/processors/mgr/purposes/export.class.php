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
 * Class ConsentfriendPurposesExportProcessor
 */
class ConsentfriendPurposesExportProcessor extends Processor
{
    /**
     * Fetches the data, generates YAML and tells the browser to download it.
     */
    public function process()
    {
        $export = new Export($this->modx);

        $list = [
            'package' => 'consentfriend',
            'services' => $export->getPurposes()
        ];

        $export->handleExport($list, 'purposes');
    }
}

return 'ConsentfriendPurposesExportProcessor';
