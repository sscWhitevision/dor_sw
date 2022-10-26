<?php
/**
 * Abstract get list processor
 *
 * @package consentfriend
 * @subpackage processor
 */

namespace TreehillStudio\ConsentFriend\Processors;

use ConsentFriend;
use modObjectGetListProcessor;
use modX;
use xPDOQuery;

/**
 * Class ObjectGetListProcessor
 */
abstract class ObjectGetListProcessor extends modObjectGetListProcessor
{
    public $languageTopics = ['consentfriend:default', 'consentfriend:web', 'consentfriend:services'];
    public $defaultSortField = 'sortindex';
    public $defaultSortDirection = 'ASC';

    /** @var ConsentFriend */
    public $consentfriend;

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    function __construct(modX & $modx, array $properties = []) {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend =& $this->modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/');
    }

    /**
     * {@inheritDoc}
     * @return string[]
     */
    public function getLanguageTopics(): array
    {
        if (file_exists($this->consentfriend->getOption('corePath') . 'lexicon/' . $this->modx->getOption('manager_language', [], 'en') . '/custom.inc.php')) {
            $this->languageTopics[] = 'consentfriend:custom';
        }
        return $this->languageTopics;
    }

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryAfterCount(xPDOQuery $c): xPDOQuery
    {
        $valuesQuery = $this->getProperty('valuesqry');
        $id = (!$valuesQuery) ? $this->getProperty('id') : $this->getProperty('query');
        if (!empty($id)) {
            $c->where([
                $this->classKey . '.id:IN' => array_map('intval', explode('|', $id))
            ]);
        }
        return $c;
    }
}
