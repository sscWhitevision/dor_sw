<?php

require_once dirname(__FILE__, 2) . '/dropdown/getlist.class.php';

/**
 * Gets a list of available options for the multi-select input
 */
class ContentMultiSelectGetListProcessor extends ContentSelectGetListProcessor {
    protected $fieldKey = 'multi_select';

}
return 'ContentMultiSelectGetListProcessor';
