<?php

class RedactorInput extends cbBaseInput {
    public $defaultIcon = 'richtext';
    public $defaultTpl = '[[+value]]';

    public function __construct(ContentBlocks $contentBlocks, array $options = array())
    {
        parent::__construct($contentBlocks, $options);

        $corePath = $this->modx->getOption('redactor.core_path', null, MODX_CORE_PATH . 'components/redactor/');
        $redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
    }

    public function getLexiconTopics(): array
    {
        return ['redactor:default', 'redactor:configuration'];
    }

    public function getName(): string
    {
        return $this->modx->lexicon('redactor.input_name');
    }

    public function getDescription(): string
    {
        return $this->modx->lexicon('redactor.input_description');
    }

    public function getFieldProperties(): array
    {
        return [
            [
                'key' => 'configuration_set',
                'fieldLabel' => $this->modx->lexicon('redactor.configuration_set'),
                'xtype' => 'redactor-configsets',
                'default' => '1',
                'description' => $this->modx->lexicon('redactor.configuration_set_desc')
            ]
        ];
    }

    /**
     * @return array
     */
    public function getJavaScripts(): array
    {
        $assetsUrl = $this->modx->getOption('redactor.assets_url', null, MODX_ASSETS_URL . 'components/redactor/');
        return [
            $assetsUrl . 'js/redactor.input.js',
            $assetsUrl . 'configuration/widgets/combo.configsets.js',
        ];
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        $templates = [];

        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('redactor.core_path', null, MODX_CORE_PATH . 'components/redactor/');
        $template = file_get_contents($corePath . 'templates/contentblocks_input.tpl');

        $templates[] = $this->contentBlocks->wrapInputTpl('redactor', $template);

        $assetsUrl = $this->modx->getOption('redactor.assets_url', null, MODX_ASSETS_URL . 'components/redactor/');
        $connectorUrl = $assetsUrl . 'connector.php';
        $templates[] = <<<HTML
<script type="text/javascript">
if (!window.RedactorConfiguration) {
    window.RedactorConfiguration =  {
        config: {
            connectorUrl: '{$connectorUrl}'
        }
    }
}
</script>
HTML;

        return $templates;
    }
}