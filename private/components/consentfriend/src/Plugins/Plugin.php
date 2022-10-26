<?php
/**
 * Abstract plugin
 *
 * @package consentfriend
 * @subpackage plugin
 */

namespace TreehillStudio\ConsentFriend\Plugins;

use modX;
use ConsentFriend;

/**
 * Class Plugin
 */
abstract class Plugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var ConsentFriend $consentfriend */
    protected $consentfriend;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    /**
     * Plugin constructor.
     *
     * @param $modx
     * @param $scriptProperties
     */
    public function __construct($modx, &$scriptProperties)
    {
        $this->scriptProperties = &$scriptProperties;
        $this->modx =& $modx;
        $corePath = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend = $this->modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * Run the plugin event.
     */
    public function run()
    {
        $init = $this->init();
        if ($init !== true) {
            return;
        }

        $this->process();
    }

    /**
     * Initialize the plugin event.
     *
     * @return bool
     */
    public function init()
    {
        return true;
    }

    /**
     * Process the plugin event code.
     *
     * @return mixed
     */
    abstract public function process();

    /**
     * Get the enabled state of the current resource
     *
     * @return bool
     */
    protected function isEnabled()
    {
        // Get enabled/disabled templates system settings
        $enabledTemplates = $this->consentfriend->getOption('enabled_templates', null, '');
        $disabledTemplates = $this->consentfriend->getOption('disabled_templates', null, '');

        // Stop plugin on enabled/disabled templates
        $enabledTemplates = ($enabledTemplates) ? array_map('trim', explode(',', $enabledTemplates)) : [];
        $disabledTemplates = ($disabledTemplates) ? array_map('trim', explode(',', $disabledTemplates)) : [];
        $foundEnabled = !(!empty($enabledTemplates)) || in_array((isset($this->modx->resource)) ? $this->modx->resource->get('template') : 0, $enabledTemplates);
        $foundDisabled = !empty($disabledTemplates) && in_array((isset($this->modx->resource)) ? $this->modx->resource->get('template') : 0, $disabledTemplates);

        if (!$foundEnabled || $foundDisabled) {
            return false;
        }
        return true;
    }

}