<?php

class ColorPickerInput extends cbBaseInput {
    public $defaultIcon = 'snippet_B';
    public $defaultTpl = '[[+value]]';

    /**
     * @return array
     */
    public function getJavaScripts() {
        if ($this->contentBlocks->debug) {
            return [
                $this->contentBlocks->config['assetsUrl'] . 'js/inputs/color-picker.js',
                $this->contentBlocks->config['assetsUrl'] . 'node_modules/@jaames/iro/dist/iro.min.js'
            ];
        }
        return [
            $this->contentBlocks->config['assetsUrl'] . 'dist/inputs/color-picker-min.js',
        ];
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = [];
        $tpls[] = $this->contentBlocks->getCoreTpl('inputs/modals/color_picker_modal','contentblocks-color-picker-modal');
        $tpls[] = $this->contentBlocks->getCoreInputTpl('color_picker');
        return $tpls;
    }

    public function getFieldProperties()
    {
        $output = [];
        $output[] = [
            'key' => 'swatch_colors',
            'fieldLabel' => $this->modx->lexicon('contentblocks.color_picker.preset_swatch_colors'),
            'xtype' => 'textarea',
            'default' => $this->modx->getOption('contentblocks.color_picker_defaults'),
            'description' => $this->modx->lexicon('contentblocks.color_picker.property_desc')
        ];

        return $output;
    }

}