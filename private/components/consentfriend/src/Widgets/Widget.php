<?php
/**
 * ConsentFriend Widget
 *
 * @package consentfriend
 * @subpackage widget
 */

namespace TreehillStudio\ConsentFriend\Widgets;

use ConsentFriend;
use modDashboardWidget;
use modDashboardWidgetInterface;
use modManagerController;
use xPDO;

// Compatibility between 2.x/3.x
if (!class_exists('modDashboardWidget')) {
    class_alias(\MODX\Revolution\modDashboardWidget::class, \modDashboardWidget::class);
}

abstract class Widget extends modDashboardWidgetInterface
{
    /** @var $consentfriend ConsentFriend */
    public $consentfriend;

    public $cssBlockClass = 'dashboard-block-treehillstudio';

    /**
     * modDashboardWidgetLogrequest constructor.
     * @param xPDO $modx
     * @param modDashboardWidget $widget
     * @param modManagerController $controller
     */
    public function __construct(xPDO &$modx, modDashboardWidget &$widget, modManagerController &$controller)
    {
        parent::__construct($modx, $widget, $controller);

        $corePath = $this->modx->getOption('consentfriend.core_path', null, $this->modx->getOption('core_path') . 'components/consentfriend/');
        $this->consentfriend = $this->modx->getService('consentfriend', 'ConsentFriend', $corePath . 'model/consentfriend/', [
            'core_path' => $corePath
        ]);

        $this->controller->addLexiconTopic($this->widget->get('lexicon'));

        $this->cssBlockClass = 'modx' . $this->consentfriend->getOption('modxversion') . ' ' . $this->cssBlockClass;
    }

    /**
     * Renders the content of the block in the appropriate size
     * @return string
     */
    public function process()
    {
        $output = $this->render();
        if (!empty($output)) {
            $widgetArray = $this->widget->toArray();
            $widgetArray['content'] = $output;
            $widgetArray['class'] = $this->cssBlockClass;
            $widgetArray['name_trans'] .= '<span class="treehillstudio-widget-about"><img width="91" height="25" src="' . $this->consentfriend->getOption('assetsUrl') . 'img/mgr/treehill-studio-mini.png" srcset="' . $this->consentfriend->getOption('assetsUrl') . 'img/mgr/treehill-studio-mini@2x.png 2x" alt="Treehill Studio"></span>';
            $output = $this->getFileChunk('dashboard/block.tpl', $widgetArray);
            $output = preg_replace('/\[\[([^\[\]]++|(?R))*?]]/s', '', $output);
        }
        return $output;
    }

    /**
     * @param $type string
     * @return string
     */
    public function render()
    {
        $assetsUrl = $this->consentfriend->getOption('assetsUrl');
        $jsUrl = $this->consentfriend->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->consentfriend->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';
        $nodeUrl = $assetsUrl . '../../../node_modules/';

        if ($this->consentfriend->getOption('debug') && ($this->consentfriend->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/consentfriend/')) {
            $this->controller->addJavascript($jsSourceUrl . 'consentfriend.js?v=v' . $this->consentfriend->version);
            $this->controller->addJavascript($jsSourceUrl . 'helper/combo.js?v=v' . $this->consentfriend->version);
            $this->controller->addJavascript($jsSourceUrl . 'widgets/widget.panel.js?v=v' . $this->consentfriend->version);
            $this->controller->addJavascript($jsSourceUrl . 'widgets/widget.grid.js?v=v' . $this->consentfriend->version);
            $this->controller->addJavascript($jsSourceUrl . 'widgets/statistics.grid.js?v=v' . $this->consentfriend->version);
            $this->controller->addJavascript($nodeUrl . 'chart.js/dist/chart.js?v=v' . $this->consentfriend->version);
            $this->controller->addCss($cssSourceUrl . 'consentfriend.css?v=v' . $this->consentfriend->version);
        } else {
            $this->controller->addJavascript($jsUrl . 'consentfriend.min.js?v=v' . $this->consentfriend->version);
            $this->controller->addCss($cssUrl . 'consentfriend.min.css?v=v' . $this->consentfriend->version);
        }
        $this->modx->controller->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            ConsentFriend.config = ' . json_encode($this->consentfriend->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
            MODx.load({
                xtype: "consentfriend-panel-widget",
                renderTo: "consentfriend-panel-widget"
            });
        });
        </script>');
        return $this->getFileChunk($this->consentfriend->getOption('templatesPath') . 'widget.tpl');
    }
}
