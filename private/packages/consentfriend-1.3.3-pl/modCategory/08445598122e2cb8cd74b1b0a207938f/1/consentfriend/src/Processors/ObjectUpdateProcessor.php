<?php
/**
 * Abstract update processor
 *
 * @package consentfriend
 * @subpackage processor
 */

namespace TreehillStudio\ConsentFriend\Processors;

use ConsentFriend;
use modObjectUpdateProcessor;
use modX;
use PDO;

/**
 * Class ObjectUpdateProcessor
 */
abstract class ObjectUpdateProcessor extends modObjectUpdateProcessor
{
    public $languageTopics = ['consentfriend:default', 'consentfriend:web', 'consentfriend:services'];

    /** @var ConsentFriend */
    public $consentfriend;
    protected $required = [];
    protected $empty = [];

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
     * @return bool
     */
    public function beforeSave(): bool
    {
        foreach ($this->required as $required) {
            $value = $this->getProperty($required);
            if (empty($value)) {
                $this->addFieldError($required, $this->modx->lexicon('field_required'));
            }
        }

        $this->clearCache();

        return parent::beforeSave();
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
