<?php
require_once __DIR__ . '/redconfigurationset.class.php';

class redAdvancedConfigurationSet extends redConfigurationSet
{
    /**
     * Return the output of the set, which is a function to initialise Redactor with the provided options.
     *
     * @param array $options
     * @return string
     */
    public function getOutput(array $options = []): string
    {
        $values = [
            'content' => $this->get('content'),
            'id' => $this->get('id')
        ];
        return $this->redactor->getTpl('sets/advanced.js', $values);
    }

    public function getOutputAsJS(array $options = []): string
    {
        $content = $this->get('content');
        return "RedactorConfigurationSets[{$this->get('id')}] = function (element) {
    {$content}
}";
    }
}
