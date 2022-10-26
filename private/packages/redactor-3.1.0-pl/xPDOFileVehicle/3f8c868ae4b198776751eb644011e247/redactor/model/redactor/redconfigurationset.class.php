<?php
class redConfigurationSet extends xPDOSimpleObject
{
    /** @var Redactor */
    protected $redactor;

    public function __construct(xPDO $xpdo)
    {
        parent::__construct($xpdo);

        $corePath = $this->xpdo->getOption('redactor.core_path', null, $this->xpdo->getOption('core_path').'components/redactor/');
        $this->redactor = $this->xpdo->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
    }

    /**
     * Return the output of the set, which is a function to initialise Redactor with the provided options.
     *
     * @param array $options
     * @return string
     */
    public function getOutput(array $options = []): string
    {
        $values = [
            'content' => json_encode($this->getProcessedOptions($options)),
            'id' => $this->get('id')
        ];
        return $this->redactor->getTpl('sets/basic.js', $values);
    }

    public function getOutputAsJS(array $options = []): string
    {
        $content = json_encode($this->getProcessedOptions($options));

        return "RedactorConfigurationSets[{$this->get('id')}] = function (element) {
    \$R('#' + element, {$content});
}";
    }

    public function getConfiguredOption($key, $default = null, $processed = false)
    {
        $options = $processed ? $this->getProcessedOptions() : $this->getOptions();
        if (array_key_exists($key, $options)) {
            return $options[$key];
        }
        return $default;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        $defaults = $this->getDefaultOptions();

        $options = $this->get('content');
        $options = json_decode($options, true);
        if (!is_array($options)) {
            $options = [];
        }

        // Merge the options on top of the defaults
        $options = array_merge($defaults, $options);

        // Use the option callbacks to process the value (i.e. cast them to the right type, like bool)
        $settings = $this->redactor->getOptions();
        foreach ($settings as $key => $setting) {
            if (array_key_exists($key, $options)) {
                $options[$key] = $setting->call($options[$key]);
            }
        }

        return $options;
    }

    /**
     * Gets the processed options for this configuration set. This basically means an array of key => value for
     * the different redactor options, where the values are cast to the proper type (bool, int, array etc).
     *
     * This also gets the default options and uses those.
     *
     * @param array $options
     * @return array
     */
    public function getProcessedOptions(array $options = []): array
    {
        $options = array_merge($this->getOptions(), $options);
        return $this->processOptions($options);
    }

    /**
     * @return array
     */
    public function getDefaultOptions(): array
    {
        $defaults = [];
        $options = $this->redactor->getOptionGroups();
        foreach ($options as $group) {
            $settings = $group->getSettings();
            foreach ($settings as $setting) {
                $defaults[$setting->getName()] = $setting->getDefault();
            }
        }

        return $defaults;
    }

    protected function processOptions(array $options): array
    {
        $options['lang'] = $this->xpdo->getOption('manager_language', $_SESSION);
        if (!array_key_exists('plugins', $options)) {
            $options['plugins'] = [];
        }

        // Automatically load plugins used by buttons
        $buttons = $options['buttons'];
        $simpleButtonPlugins = ['divider', 'alignment', 'fontcolor', 'fontfamily', 'fontsize', 'fullscreen', 'properties',
            'specialchars', 'table', 'textdirection', 'video', 'widget', 'download', 'inlinestyle',
        ];
        foreach ($simpleButtonPlugins as $plugin) {
            if (in_array($plugin, $buttons, true)) {
                $options['plugins'][] = $plugin;
            }
        }
        if (in_array('inline', $buttons, true)) {
            $options['plugins'][] = 'inlinestyle';
        }

        // Sort plugins by the order they appear in the toolbar; this resolves positioning (#519) and insertion (S24844) issues
        $options['plugins'] = array_values( // make sure we have a clean flat (non associative) array
            array_unique( // ignore duplicates, in particular divider button can occur multiples
                array_intersect($options['buttons'], $options['plugins']) // sorts plugins by buttons, but drops plugins not in buttons
                +
                array_diff($options['plugins'], $options['buttons']) // adds buttons that are not same-named plugins to the end
            )
        );

        // Additional plugins loaded based buttons or other options
        if (in_array('image', $buttons, true)) {
            $options['plugins'][] = 'better_imagemanager';
        }
        if (in_array('file', $buttons, true)) {
            $options['plugins'][] = 'better_filemanager';
        }
        if (in_array('link', $buttons, true)) {
            $options['plugins'][] = 'better_links';
        }
        if (array_key_exists('clips', $options) && is_array($options['clips']) && count($options['clips']) > 0) {
            $options['plugins'][] = 'clips';
        }
        if (array_key_exists('imageStyles', $options) && is_array($options['imageStyles']) && count($options['imageStyles']) > 0) {
            $options['plugins'][] = 'imagestyle';
        }
        if (array_key_exists('linkStyles', $options) && is_array($options['linkStyles']) && count($options['linkStyles']) > 0) {
            $options['plugins'][] = 'linkstyle';
        }
        if (array_key_exists('counter', $options) && $options['counter']) {
            $options['plugins'][] = 'counter';
        }
        if (array_key_exists('limiter', $options) && $options['limiter'] > 0) {
            $options['plugins'][] = 'limiter';
        }
        if (array_key_exists('definedlinks', $options) && is_array($options['definedlinks']) && count($options['definedlinks']) > 0) {
            $options['plugins'][] = 'definedlinks';
        }
        if (array_key_exists('textexpander', $options) && is_array($options['textexpander']) && count($options['textexpander']) > 0) {
            $options['plugins'][] = 'textexpander';
        }
        if (array_key_exists('variables', $options) && is_array($options['variables']) && count($options['variables']) > 0) {
            $options['plugins'][] = 'variable';
        }
        if (array_key_exists('theme', $options) && $options['theme'] !== '') {
            $options['plugins'][] = 'theme';
        }
        if (array_key_exists('sourceBeautify', $options) && $options['sourceBeautify']) {
            $options['plugins'][] = 'source_beautify';
        }
        if (array_key_exists(Redactor::OPT_IS_FRED, $options) && $options[Redactor::OPT_IS_FRED]) {
            $options['plugins'][] = 'fredactor';
        }

        // Enabling codemirror source highlighting
        if (array_key_exists('sourceCodemirror', $options) && $options['sourceCodemirror']) {
            $options['source'] = ['codemirror' => [
//                'leaveSubmitMethodAlone' => true,
                'lineNumbers' => true,
                'lineWrapping' => true,
                'theme' => 'default',
                'mode' => 'text/html'
            ]];
            unset($options['sourceCodemirror']);
        }

        // Hack for modxcms/revolution#13711 when using Redactor with something like ContentBlocks
        $options['plugins'][] = 'noname';

        // Handle upload errors
        $options['plugins'][] = 'errors';

        // Add a MODX-optimised fixed toolbar
        $options['plugins'][] = 'fixed_toolbar';

        // Handle shift-tab within lists
        $options['plugins'][] = 'shifttab';

        // Add baseurls handling
        $options['plugins'][] = 'baseurls';
        $options['baseurlsMode'] = $options['baseurlsMode'] ?? 'relative';

        // Marking resources dirty
        $options['plugins'][] = 'markdirty';

        $extras = $options['additionalPlugins'] ?? '';
        $extras = array_filter(array_map('trim', explode(',', $extras)));
        foreach ($extras as $plugin) {
            $options['plugins'][] = $plugin;
        }
        unset($options['additionalPlugins']);

        $userToken = $this->redactor->modx->user->getUserToken('mgr');
        $options['modx'] = [
            'configuration_set' => $this->get('id'),
            'connector_url' => $this->redactor->config['assetsUrl'] . 'connector.php',
            'base_url' => $this->xpdo->getOption('base_url'),
            'site_url' => $this->xpdo->getOption('site_url'),
            'auth' => $userToken,
        ];

        // Image/upload handling
        $options['multipleUpload'] = true;
        $urlParams = [
            'configuration' => $this->get('id'),
            'HTTP_MODAUTH' => $userToken,
        ];
        if ($ctx = $this->redactor->getWorkingContext()) {
            $urlParams['context'] = $ctx->get('key');
        }
        if ($resource = $this->redactor->getWorkingResource()) {
            $urlParams['resource'] = $resource->get('id');
        }
        $urlParams = http_build_query($urlParams);
        $options['fileUpload'] = $this->redactor->config['assetsUrl'] . 'connector.php?action=media/upload&type=file&'.$urlParams;
        $options['imageUpload'] = $this->redactor->config['assetsUrl'] . 'connector.php?action=media/upload&'.$urlParams;
        $options['imageUploadParam'] = $options['fileUploadParam'] = 'upload';
        $options['linkResourceUrl'] = $this->redactor->config['assetsUrl'] . 'connector.php?action=resources/search&'.$urlParams;

        // Disables the built-in "image storage tracking" and adding data-image attributes to each image
        $options['imageObserve'] = false;

        return $options;
    }
}