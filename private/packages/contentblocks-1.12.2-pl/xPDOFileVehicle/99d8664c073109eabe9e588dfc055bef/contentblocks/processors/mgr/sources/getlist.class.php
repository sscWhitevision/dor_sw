<?php
/**
 * Gets a list of sources.modMediaSource objects.
 */
class ContentBlocksMediaSourceGetListProcessor extends modProcessor {
    public function process()
    {
        $this->setProperty('showNone', 1);

        $action = 'Source/GetList';
        if (version_compare($this->modx->getOption('settings_version'), '3.0.0-alpha1') < 1) {
            $action = 'source/getlist';
        }
        $response = $this->modx->runProcessor($action, $this->getProperties());

        return $response->getResponse();
    }
}
return 'ContentBlocksMediaSourceGetListProcessor';
