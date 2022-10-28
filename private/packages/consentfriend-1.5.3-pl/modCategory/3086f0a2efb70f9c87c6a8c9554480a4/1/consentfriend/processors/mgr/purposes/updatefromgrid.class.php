<?php
/**
 * Update Purpose From Grid
 *
 * @package consentfriend
 * @subpackage processors
 */

require_once(dirname(__FILE__) . '/update.class.php');

/**
 * Class ConsentFriendPurposesUpdateFromGridProcessor
 */
class ConsentFriendPurposesUpdateFromGridProcessor extends ConsentFriendPurposesUpdateProcessor
{
    /**
     * {@inheritDoc}
     * @return bool|string
     */
    public function initialize()
    {
        $data = $this->getProperty('data');
        if (empty($data)) {
            return $this->modx->lexicon('consentfriend.purpose_err_invalid_data');
        }
        $data = json_decode($data, true);
        if (empty($data)) {
            return $this->modx->lexicon('consentfriend.purpose_err_invalid_data');
        }
        $this->setProperties($data);
        $this->unsetProperty('data');

        return parent::initialize();
    }
}

return 'ConsentFriendPurposesUpdateFromGridProcessor';
