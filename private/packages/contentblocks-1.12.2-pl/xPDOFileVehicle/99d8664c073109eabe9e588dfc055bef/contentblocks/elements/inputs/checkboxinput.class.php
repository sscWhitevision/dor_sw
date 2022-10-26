<?php

class CheckboxInput extends cbBaseInput {
    public $defaultIcon = 'checkbox';

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = [];
        $tpls[] = $this->contentBlocks->getCoreInputTpl('checkbox');
        return $tpls;
    }

}
