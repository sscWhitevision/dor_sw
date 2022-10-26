<?php
/**
 * ConsentFriend Widget
 *
 * @package consentfriend
 * @subpackage widget
 */

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use TreehillStudio\ConsentFriend\Widgets\Widget;

class StatisticsWidget extends Widget
{
    public $cssBlockClass = 'dashboard-block-treehillstudio dashboard-block-treehillstudio-consentfriend-statistics" id="dashboard-block-treehillstudio-consentfriend-statistics';
}

return 'StatisticsWidget';
