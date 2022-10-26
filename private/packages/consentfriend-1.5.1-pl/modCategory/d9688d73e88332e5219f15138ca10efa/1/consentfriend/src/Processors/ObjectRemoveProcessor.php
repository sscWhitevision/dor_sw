<?php
/**
 * Abstract remove processor
 *
 * @package consentfriend
 * @subpackage processors
 */

namespace TreehillStudio\ConsentFriend\Processors;

use TreehillStudio\ConsentFriend\ConsentFriend;
use modObjectRemoveProcessor;
use modX;
use PDO;

/**
 * Class ObjectRemoveProcessor
 */
class ObjectRemoveProcessor extends modObjectRemoveProcessor
{
    public $languageTopics = ['consentfriend:default'];

    /** @var ConsentFriend */
    public $consentfriend;

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    public function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend = $this->modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/');
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function afterRemove()
    {
        $this->clearCache();

        return parent::afterRemove();
    }

    /**
     * Clear the context and the lexicon topics cache.
     */
    protected function clearCache()
    {
        $query = $this->modx->newQuery('modContext');
        $query->select($this->modx->escape('key'));
        if ($query->prepare() && $query->stmt->execute()) {
            $contextKeys = $query->stmt->fetchAll(PDO::FETCH_COLUMN);
        } else {
            $contextKeys = [];
        }

        $this->modx->cacheManager->refresh(
            [
                'lexicon_topics' => [],
                'resource' => ['contexts' => array_diff($contextKeys, ['mgr'])],
            ]
        );
    }
}
