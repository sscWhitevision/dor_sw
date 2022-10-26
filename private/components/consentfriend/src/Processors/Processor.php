<?php
/**
 * Abstract processor
 *
 * @package consentfriend
 * @subpackage processors
 */

namespace TreehillStudio\ConsentFriend\Processors;

use TreehillStudio\ConsentFriend\ConsentFriend;
use modProcessor;
use modX;

/**
 * Class ConsentfriendConfigExportProcessor
 */
abstract class Processor extends modProcessor
{
    public $languageTopics = ['consentfriend:default'];

    /** @var ConsentFriend */
    public $consentfriend;

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend = $this->modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/');
    }

    abstract public function process();
}
