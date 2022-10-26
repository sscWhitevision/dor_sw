<?php
/**
 * Home controller
 *
 * @package consentfriend
 * @subpackage controller
 */

/**
 * Class ConsentfriendHomeManagerController
 */
class ConsentfriendHomeManagerController extends modExtraManagerController
{
    /** @var ConsentFriend $consentfriend */
    public $consentfriend;

    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $path = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend = $this->modx->getService('consentfriend', 'ConsentFriend', $path . 'model/consentfriend/', [
            'core_path' => $path
        ]);
        $this->consentfriend->ConsentFriend();

        parent::initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function loadCustomCssJs()
    {
        $assetsUrl = $this->consentfriend->getOption('assetsUrl');
        $jsUrl = $this->consentfriend->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->consentfriend->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->consentfriend->getOption('debug') && ($assetsUrl != MODX_ASSETS_URL . 'components/consentfriend/')) {
            $this->addCss($cssSourceUrl . 'consentfriend.css?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'consentfriend.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'helper/combo.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'helper/util.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'widgets/home.panel.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'widgets/services.grid.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'widgets/purposes.grid.js?v=v' . $this->consentfriend->version);
            $this->addJavascript($jsSourceUrl . 'widgets/contexts.grid.js?v=v' . $this->consentfriend->version);
            $this->addJavascript(MODX_MANAGER_URL . 'assets/modext/widgets/core/modx.grid.settings.js');
            $this->addJavascript($jsSourceUrl . 'widgets/settings.panel.js?v=v' . $this->consentfriend->version);
            $this->addLastJavascript($jsSourceUrl . 'sections/home.js?v=v' . $this->consentfriend->version);
        } else {
            $this->addCss($cssUrl . 'consentfriend.min.css?v=v' . $this->consentfriend->version);
            $this->addJavascript(MODX_MANAGER_URL . 'assets/modext/widgets/core/modx.grid.settings.js');
            $this->addLastJavascript($jsUrl . 'consentfriend.min.js?v=v' . $this->consentfriend->version);
        }
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            MODx.config.help_url = "https://docs.modmore.com/en/ConsentFriend/v1/Custom_Manager_Page/";
            ConsentFriend.config = ' . json_encode($this->consentfriend->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
            MODx.load({xtype: "consentfriend-page-home"});
        });
        </script>');
    }

    /**
     * {@inheritDoc}
     * @return string[]
     */
    public function getLanguageTopics()
    {
        return ['core:setting', 'consentfriend:default'];
    }

    /**
     * {@inheritDoc}
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = [])
    {
    }

    /**
     * {@inheritDoc}
     * @return string|null
     */
    public function getPageTitle(): ?string
    {
        return $this->modx->lexicon('consentfriend');
    }

    /**
     * {@inheritDoc}
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->consentfriend->getOption('templatesPath') . 'home.tpl';
    }
}
