<?php

use modmore\Redactor\Group;
use modmore\Redactor\VersionObject;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

/**
 * The base class for Redactor.
 *
 * @package redactor
 */
final class Redactor
{
    public const OPT_IS_FRED = 'is_fred';

    /**
     * @var modX A reference to the modX object.
     */
    public $modx = null;

    /**
     * @var modContext A reference to the current working context object.
     */
    private $wctx = null;

    /**
     * @var array An array of configuration options
     */
    public $config = array();

    /**
     * @var VersionObject An array of version data
     */
    public $version;

    /**
     * @var array An array of variables to use in path resolving.
     */
    private $pathVariables = array();

    /**
     * @var modResource|false The current resource object
     */
    private $resource = false;

    /**
     * @var array An array of configuration options
     */
    private $chunks = array();

    /**
     * This array keeps track of renamed file uploads in order to make sure image links
     * don't break when something like FileSluggy is active on the site.
     *
     * @var array
     */
    public $renames = array();

    /**
     * @var bool A flag to prevent double script registering
     */
    private $assetsLoaded = false;

    /**
     * @var bool|Group[]
     */
    private $_option_groups = false;

    /**
     * @param modX $modx
     * @param array $config
     */
    public function __construct(modX $modx,array $config = array()) {
        $this->modx =& $modx;
        $this->version = new VersionObject(3, 1, 0, 'pl');

        $corePath = $this->modx->getOption('redactor.core_path',$config,$this->modx->getOption('core_path').'components/redactor/');
        $assetsUrl = $this->modx->getOption('redactor.assets_url',$config,$this->modx->getOption('assets_url').'components/redactor/');

        $this->config = array_merge(array(
            'version' => (string)$this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'templatePath' => $corePath.'templates/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl . 'connector.php',
            'permissions' => $this->getPermissions(),
        ),$config);

        $this->modx->lexicon->load('redactor:default');
        $this->modx->addPackage('redactor', $this->config['modelPath']);
        $this->modx->loadClass('redConfigurationSet', $this->config['modelPath'] . 'redactor/');
        $this->r();
    }

    /**
     * Ensures boolean values are properly returned. See https://github.com/modmore/Redactor/issues/266
     * @param string $name
     * @param array $options
     * @param bool $default
     * @return bool
     * @deprecated Cast to bool as needed
     */
    public function getBooleanOption($name, array $options = null, $default = null) {
        $value = $this->getOption($name, $options, $default);
        if (in_array(strtolower($value), array('false', 'no'), true)) {
            return false;
        }
        return (bool)$value;
    }

    /**
     * Loads the various required assets into the controller.
     */
    public function initialize() {
        if (!$this->assetsLoaded) {
            $version = '?v=' . $this->version;

            $this->modx->controller->addLexiconTopic('redactor:default');

            $this->modx->controller->addCss($this->config['assetsUrl'] . 'vendor/imperavi/redactor/redactor.min.css' . $version);
            $this->modx->controller->addCss($this->config['assetsUrl'] . 'dist/modxredactor.min.css' . $version);
            if ($customCss = $this->getOption('redactor.css')) {
                $customCss = array_filter(array_map('trim', explode(',', $customCss)));
                foreach ($customCss as $url) {
                    $this->modx->controller->addCss($url . $version);
                }
            }

            if (!$this->getOption('redactor.debug_imperavi', null, false)) {
                $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'dist/imperavi/redactor.min.js' . $version);
            }
            else {
                $sources = explode(' ', 'vendor/imperavi/redactor/redactor.js vendor/imperavi/redactor/_plugins/alignment/alignment.js vendor/imperavi/redactor/_plugins/beyondgrammar/beyondgrammar.js vendor/imperavi/redactor/_plugins/clips/clips.js vendor/imperavi/redactor/_plugins/counter/counter.js vendor/imperavi/redactor/_plugins/definedlinks/definedlinks.js vendor/imperavi/redactor/_plugins/filemanager/filemanager.js vendor/imperavi/redactor/_plugins/fontcolor/fontcolor.js vendor/imperavi/redactor/_plugins/fontfamily/fontfamily.js vendor/imperavi/redactor/_plugins/fontsize/fontsize.js vendor/imperavi/redactor/_plugins/fullscreen/fullscreen.js vendor/imperavi/redactor/_plugins/handle/handle.js vendor/imperavi/redactor/_plugins/imagemanager/imagemanager.js vendor/imperavi/redactor/_plugins/inlinestyle/inlinestyle.js vendor/imperavi/redactor/_plugins/limiter/limiter.js vendor/imperavi/redactor/_plugins/properties/properties.js vendor/imperavi/redactor/_plugins/specialchars/specialchars.js vendor/imperavi/redactor/_plugins/table/table.js vendor/imperavi/redactor/_plugins/textdirection/textdirection.js vendor/imperavi/redactor/_plugins/textexpander/textexpander.js vendor/imperavi/redactor/_plugins/variable/variable.js vendor/imperavi/redactor/_plugins/video/video.js vendor/imperavi/redactor/_plugins/widget/widget.js');
                foreach ($sources as $sourceFile) {
                    $this->modx->controller->addJavascript($this->config['assetsUrl'] . $sourceFile . $version);
                }
            }

            $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'dist/plugins.min.js' . $version);
            $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'dist/codemirror.min.js' . $version);
            if ($customJs = $this->getOption('redactor.js')) {
                $customJs = array_filter(array_map('trim', explode(',', $customJs)));
                foreach ($customJs as $url) {
                    $this->modx->controller->addJavascript($url . $version);
                }
            }

            $lang = $this->modx->getOption('manager_language', $_SESSION);
            $allowed = ['ar', 'cs', 'da', 'de', 'es', 'fa', 'fi', 'fr', 'he', 'hu', 'it', 'ja', 'ko', 'nl', 'no', 'pl', 'pt_br', 'ro', 'ru', 'sk', 'sl', 'sv', 'tr', 'zh_cn', 'zh_tw'];
            if (in_array(strtolower(trim($lang)), $allowed, true)) {
                $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'vendor/imperavi/redactor/_langs/' . $lang . '.js' . $version);
            }

            $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'connector.php?action=mgr/translations&HTTP_MODAUTH=' . $this->modx->user->getUserToken('mgr'));
            $this->modx->controller->addJavascript($this->config['assetsUrl'] . 'dist/modxredactor.min.js' . $version);

            $this->modx->controller->addHtml($this->getGeneratedConfigurationSets());
            $this->assetsLoaded = true;
        }
    }

    /**
     * Parses a path by replacing placeholders with dynamic values. This supports the following placeholders:
     * - [[+year]]
     * - [[+month]]
     * - [[+date]]
     * - [[+day]]
     * - [[+user]]
     * - [[+username]]
     * - [[++assets_url]]
     * - [[++site_url]]
     * - [[++base_url]]
     * - [[+<any resource field>]]
     * - [[+tv.<any template variable name>]]
     *
     * In $this->setResource, support is also added for the following through $this->setPathVariables:
     * - [[+parent_alias]]
     * - [[+ultimate_parent]]
     * - [[+ultimate_parent_alias]]
     *
     * @param $path
     * @return mixed
     */
    public function parsePathVariables($path) {
        $path = str_replace('[[+year]]', date('Y'), $path);
        $path = str_replace('[[+month]]', date('m'), $path);
        $path = str_replace('[[+date]]', date('d'), $path);
        $path = str_replace('[[+day]]', date('d'), $path);
        $path = str_replace('[[+user]]', $this->modx->getUser()->get('id'), $path);
        $path = str_replace('[[+username]]', $this->modx->getUser()->get('username'), $path);
        $path = str_replace('[[++assets_url]]', $this->getOption('assets_url', null, 'assets/'), $path);
        $path = str_replace('[[++site_url]]', $this->getOption('site_url', null, ''), $path);
        $path = str_replace('[[++base_url]]', $this->getOption('base_url', null, ''), $path);

        foreach ($this->pathVariables as $key => $value) {
            $path = str_replace('[[+'.$key.']]', $value, $path);
        }

        if ($this->resource) {
            // Match all placeholders in the string so we can replace it with the proper values.
            if (preg_match_all('/\[\[\+(.*?)\]\]/', $path, $matches) && !empty($matches[1])) {
                foreach ($matches[1] as $key) {
                    $ph = '[[+'.$key.']]';
                    if (strpos($key, 'tv.') === 0) {
                        $tvName = substr($key, 3);
                        $tvValue = $this->resource->getTVValue($tvName);
                        $path = str_replace($ph, $tvValue, $path);
                    }
                    elseif (array_key_exists($key, $this->resource->_fieldMeta)) {
                        $path = str_replace($ph, $this->resource->get($key), $path);
                    }
                    else {
                        $this->modx->log(modX::LOG_LEVEL_WARN, "Unknown placeholder '{$key}' in redactor path {$path}", '', __METHOD__, __FILE__, __LINE__);
                        $path = str_replace($ph, '', $path);
                    }
                }
            }
        }

        // Strip out any remaining placeholders
        $path = preg_replace('/\[\[\+(.*?)\]\]/', '', $path);

        $path = str_replace('://', '__:_/_/__', $path);
        $path = str_replace('//', '/', $path);
        $path = str_replace('__:_/_/__', '://', $path);
        return $path;
    }

    /**
    * Gets a file-based template.
    *
    * @author Shaun McCormick
    * @access public
    * @param string $name The name of the Chunk
    * @param array $properties The properties for the Chunk
    * @return string The processed content of the Chunk
    */
    public function getTpl($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
     * @return Group[]
     */
    public function getOptionGroups(): array
    {
        if (!$this->_option_groups) {
            $modx = $this->modx;
            $redactor = $this;
            /** @var Group[] $options */
            $this->_option_groups = include dirname(dirname(__DIR__)) . '/options.php';
        }
        return $this->_option_groups;
    }

    /**
     * @return \modmore\Redactor\Setting[]
     */
    public function getOptions(): array
    {
        $groups = $this->getOptionGroups();
        $options = [];
        foreach ($groups as $group) {
            foreach ($group->getSettings() as $setting) {
                $options[$setting->getName()] = $setting;
            }
        }
        return $options;
    }

    /**
     * Returns a <style> tag for the custom styles.
     *
     * @return bool|string
     * @todo Re-implement with config sets?
     */
    public function getCustomStyles() {
        $stylesJson = $this->getOption('redactor.formattingAdd',null,'');
        $styles = $this->modx->fromJSON($stylesJson);
        if(!$styles || (count($styles) < 1))  return false;

        $inlineStyle = '<style type="text/css">';
        foreach($styles as $style) {
            $className = '.redactor-dropdown-' . $style['tag'] . '-' . $style['class'];
            if (array_key_exists('style', $style)) {
                $cssProps = $style['style'];
                $inlineStyle .= ".redactor-dropdown $className { $cssProps }";
            }
        }
        $inlineStyle .= '</style>';

        return $inlineStyle;
    }

    /**
    * Returns a modChunk object from a template file.
    *
    * @author Shaun McCormick
    * @access private
    * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
    * @param string $postFix The postfix to append to the name
    * @return modChunk/boolean Returns the modChunk object if found, otherwise
    * false.
    */
    private function _getTplChunk($name,$postFix = '.tpl') {
        $chunk = false;
        $f = $this->config['templatePath'].strtolower($name).$postFix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            /* @var modChunk $chunk */
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }

    /**
     * @param int|modResource $resource
     */
    public function setResource($resource): void
    {
        if (is_numeric($resource)) {
            $resource = $this->modx->getObject('modResource', $resource);
        }

        if ($resource instanceof modResource) {
            $this->resource = $resource;
            $this->setWorkingContext($resource->get('context_key'));

            // Make sure the resource is also added to $modx->resource if there's nothing set there
            // This provides compatibility for dynamic media source paths using snippets relying on $modx->resource
            if (!$this->modx->resource) {
                $this->modx->resource =& $resource;
            }

            if($this->getBooleanOption('redactor.parse_parent_path',null,true) && $parent = $resource->getOne('Parent')) {
                $this->setPathVariables(array(
                    'parent_alias' => $parent->get('alias'),
                ));
                $pids = $this->modx->getParentIds($resource->get('id'), (int)$this->getOption('redactor.parse_parent_path_height', null,10), array('context' => $resource->get('context_key')));
                $pidx = count($pids) - 2;
                if ($pidx >= 0 && $ultimateParent = $this->modx->getObject('modResource', $pids[$pidx])) {
                    $this->setPathVariables(array(
                        'ultimate_parent' => $ultimateParent->get('id'),
                        'ultimate_parent_alias' => $ultimateParent->get('alias'),
                        'ultimate_alias' => $ultimateParent->get('alias'),
                    ));
                } else {
                    $this->setPathVariables(array(
                        'ultimate_parent' => '',
                        'ultimate_parent_alias' => '',
                        'ultimate_alias' => ''
                    ));
                }
            } else {
                $this->setPathVariables(array(
                    'parent_alias' => '',
                    'ultimate_parent' => '',
                    'ultimate_parent_alias' => '',
                    'ultimate_alias' => ''
                ));
            }
        }
    }

    /**
     * Generates the HTML (typically script tags) for all configured configuration
     * sets on this installation, making them available to be initialised with
     * the `MODx.loadRedactorConfigurationSet` method.
     *
     * @param array $options
     * @return string
     */
    public function getGeneratedConfigurationSets(array $options = []): string
    {
        $output = array();

        $outputUrl = MODX_MANAGER_URL. '?namespace=redactor&a=output';
        if (array_key_exists(self::OPT_IS_FRED, $options) && $options[self::OPT_IS_FRED]) {
            $outputUrl .= '&' . self::OPT_IS_FRED . '=1';
        }
        $output[] = '<script src="' . $outputUrl . '" type="text/javascript"></script>';

        $introtext = (bool)$this->getOption('redactor.introtext', null, false)
            ? (int)$this->getOption('redactor.introtext.configuration_set', null, 1)
            : 0;

        if ($introtext > 0) {
            $output[] = <<<HTML
<script type="text/javascript">
    // Prevent instantiating the editor more than once
    (function() {
        var init = false;
        MODx.on('ready', function(){
            if (init) {
                return;
            }
            init = true;
            if (document.getElementById('modx-resource-introtext')) {
                MODx.loadRedactorConfigurationSet('modx-resource-introtext', {$introtext});
            }
        });
    })();
</script>   
HTML;
        }

        return implode("\n", $output);
    }

    /**
     * Sets path variables which are processed in the upload/browse paths.
     * @param array $array
     */
    public function setPathVariables(array $array = array()): void
    {
        $this->pathVariables = array_merge($this->pathVariables, $array);
    }

    /**
     * Grabs the setting by its key, looking at the current working context (see setWorkingContext) first.
     *
     * @param $key
     * @param null $options
     * @param null $default
     * @param bool $skipEmpty
     * @return mixed
     */
    public function getOption($key, $options = null, $default = null, $skipEmpty = false)
    {
        if ($this->wctx) {
            $value = $this->wctx->getOption($key, $default, $options);
            if ($skipEmpty && $value == '') {
                return $default;
            }
            return $value;
        }
        return $this->modx->getOption($key, $options, $default, $skipEmpty);
    }

    /**
     * Set the internal working context for grabbing context-specific options.
     *
     * @param $key
     * @return void
     */
    public function setWorkingContext($key): void
    {
        if ($key instanceof modResource) {
            $key = $key->get('context_key');
        }

        if (empty($key)) {
            return;
        }

        $this->wctx = $this->modx->getContext($key);
        if (!$this->wctx) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error loading working context ' . $key, '', __METHOD__, __FILE__, __LINE__);
        }
    }

    /**
     * Sanitises and transliterates a value for use as paths.
     *
     * @param $value
     * @return string
     */
    public function sanitize(string $value): string
    {
        $iconv = function_exists('iconv');
        $charset = strtoupper((string)$this->getOption('modx_charset', null, 'UTF-8'));
        $translit = $this->getOption('redactor.translit', null,
            $this->getOption('friendly_alias_translit', null, 'none'), true);
        $translitClass = $this->getOption('redactor.translit_class', null,
            $this->getOption('friendly_alias_translit_class', null, 'translit.modTransliterate'), true);
        $translitClassPath = $this->getOption('redactor.translit_class_path', null,
            $this->getOption('friendly_alias_translit_class_path', null,
                $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/'), true);
        switch ($translit) {
            case '':
            case 'none':
                // no transliteration
                break;
            case 'iconv':
                // if iconv is available, use the built-in transliteration it provides
                if ($iconv) {
                    $value = iconv($charset, 'ASCII//TRANSLIT//IGNORE', $value);
                }
                break;
            default:
                // otherwise look for a transliteration service class (i.e. Translit package) that will accept named transliteration tables
                if ($this->modx instanceof \modX) {
                    if ($transliterate = $this->modx->getService('translit', $translitClass, $translitClassPath)) {
                        $value = $transliterate->translate($value, $translit);
                    }
                }
                break;
        }
        $replace = $this->getOption('redactor.sanitize_replace', null, '_');
        $pattern = $this->getOption('redactor.sanitize_pattern', null, '/([[:alnum:]_\.-]*)/');
        $value = str_replace(str_split(preg_replace($pattern, $replace, $value)), $replace, $value);
        $value = preg_replace('/[\/_|+ -]+/', $replace, $value);
        $value = trim(trim($value, $replace));
        return $value;
    }

    public function r(): void
    {
        // Only run if we're in the manager
        if (!$this->modx->context || $this->modx->context->get('key') !== 'mgr') {
            return;
        }
        // Get the public key from the .pubkey file contained in the package directory
        $pubKeyFile = $this->config['corePath'] . '.pubkey';
        $key = file_exists($pubKeyFile) ? file_get_contents($pubKeyFile) : '';
        $domain = $this->modx->getOption('http_host');
        if (strpos($key, '@@') !== false) {
            $pos = strpos($key, '@@');
            $domain = substr($key, 0, $pos);
            $key = substr($key, $pos + 2);
        }
        $check = false;
        // No key? That's a really good reason to check :)
        if (empty($key)) {
            $check = true;
        }
        // Doesn't the domain in the key file match the current host? Then we should get that sorted out.
        if ($domain !== $this->modx->getOption('http_host')) {
            $check = true;
        }
        // the .pubkey_c file contains a unix timestamp saying when the pubkey was last checked
        $modified = file_exists($pubKeyFile . '_c') ? file_get_contents($pubKeyFile . '_c') : false;
        if (!$modified ||
            $modified < (time() - (60 * 60 * 24 * 7)) ||
            $modified > time()) {
            $check = true;
        }
        if ($check) {
            $provider = false;
            $c = $this->modx->newQuery('transport.modTransportPackage');
            $c->where(array(
                'signature:LIKE' => 'redactor-%',
            ));
            $c->sortby('installed', 'DESC');
            $c->limit(1);
            $package = $this->modx->getObject('transport.modTransportPackage', $c);
            if ($package instanceof modTransportPackage) {
                $provider = $package->getOne('Provider');
            }
            if (!$provider) {
                $provider = $this->modx->getObject('transport.modTransportProvider', array(
                    'service_url' => 'https://rest.modmore.com/'
                ));
            }
            if ($provider instanceof modTransportProvider) {
                $this->modx->setOption('contentType', 'default');
                // The params that get sent to the provider for verification
                $params = array(
                    'version' => (string)$this->version,
                    'key' => $key,
                    'package' => 'redactor',
                );
                // Fire it off and see what it gets back from the XML..
                $response = $provider->request('license', 'GET', $params);
                $xml = $response->toXml();
                $valid = (int)$xml->valid;
                // If the key is found to be valid, set the status to true
                if ($valid) {
                    // It's possible we've been given a new public key (typically for dev licenses or when user has unlimited)
                    // which we will want to update in the pubkey file.
                    $updatePublicKey = (bool)$xml->update_pubkey;
                    if ($updatePublicKey > 0) {
                        file_put_contents($pubKeyFile,
                            $this->modx->getOption('http_host') . '@@' . (string)$xml->pubkey);
                    }
                    file_put_contents($pubKeyFile . '_c', time());
                    return;
                }
                // If the key is not valid, we have some more work to do.
                $message = addslashes((string)$xml->message);
                $age = (int)$xml->case_age;
                $url = (string)$xml->case_url;
                $warning = false;
                if ($age >= 7) {
                    $warning = <<<HTML
    var warning = '<div style="width: 100%;border: 1px solid #dd0000;background-color: #F9E3E3;padding: 1em; font-weight: bold; box-sizing: border-box;">';
    warning += '<a href="$url" style="float:right; margin-left: 1em;" target="_blank">Fix the license</a>The Redactor license on this site is invalid. Please click the button on the right to correct the problem. Error: {$message}';
    warning += '</div>';
HTML;
                } elseif ($age >= 2) {
                    $warning = <<<HTML
    var warning = '<div style="width: 100%;border: 1px solid #dd0000;background-color: #F9E3E3;padding: 1em; box-sizing: border-box;">';
    warning += '<a href="$url" style="float:right; margin-left: 1em;" target="_blank">Fix the license</a>Oops, there is an issue with the Redactor license. Perhaps your site recently moved to a new domain, or the license was reset? Either way, please click the button on the right or contact your development team to correct the problem.';
    warning += '</div>';
HTML;
                }
                if ($warning) {
                    $output = <<<HTML
    <script type="text/javascript">
    {$warning}
    var warningDom = document.createElement('div');
    warningDom.innerHTML = warning;
    console.error(warning);
    function showRedactorWarning() {
        setTimeout(function() {
            if ((typeof window.\$R !== 'undefined') && document.querySelectorAll('.redactor-toolbar').length) {
                document.querySelectorAll('.redactor-toolbar').forEach(function(toolbar) {
                    toolbar.append(warningDom);
                }
            }
            else {
                setTimeout(showRedactorWarning, 300);
            }
        }, 300);
    }
    showRedactorWarning();
    </script>
HTML;
                    if ($this->modx->controller instanceof modManagerController) {
                        $this->modx->controller->addHtml($output);
                    } else {
                        $this->modx->regClientHTMLBlock($output);
                    }
                }
            }
            else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'UNABLE TO VERIFY MODMORE LICENSE - PROVIDER NOT FOUND!');
            }
        }
    }

    private function getPermissions(): array
    {
        $access = [];
        $perms = [
            'redactor_configurator',
            'redactor_sets_view',
            'redactor_sets_create',
            'redactor_sets_save',
            'redactor_sets_export',
            'redactor_sets_import',
            'redactor_sets_delete',
            'settings'
        ];
        foreach ($perms as $p) {
            $access[$p] = $this->modx->hasPermission($p);
        }
        return $access;
    }

    /**
     * @return modContext|null
     */
    public function getWorkingContext()
    {
        return $this->wctx;
    }

    /**
     * @return modResource|false|null
     */
    public function getWorkingResource()
    {
        return $this->resource;
    }
}
