<?php
/**
 * ConsentFriend
 *
 * Copyright 2020-2022 by Thomas Jakobi <office@treehillstudio.com>
 *
 * @package consentfriend
 * @subpackage classfile
 */

namespace TreehillStudio\ConsentFriend;

use ConsentfriendLogs;
use ConsentfriendPurposes;
use ConsentfriendServicePurposes;
use ConsentfriendServices;
use modManagerController;
use modRestResponse;
use modTransportPackage;
use modTransportProvider;
use modX;
use Psr\Http\Message\ResponseInterface;
use xPDO;
use xPDOCacheManager;

/**
 * Class ConsentFriend
 */
class ConsentFriend
{
    /**
     * A reference to the modX instance
     * @var modX $modx
     */
    public $modx;

    /**
     * The namespace
     * @var string $namespace
     */
    public $namespace = 'consentfriend';

    /**
     * The package name
     * @var string $packageName
     */
    public $packageName = 'ConsentFriend';

    /**
     * The version
     * @var string $version
     */
    public $version = '1.5.3';

    /**
     * The class options
     * @var array $options
     */
    public $options = [];

    /**
     * The cache options
     * @var array $cacheOptions
     */
    public $cacheOptions;

    /**
     * ConsentFriend constructor
     *
     * @param modX $modx A reference to the modX instance.
     * @param array $options An array of options. Optional.
     */
    public function __construct(modX &$modx, $options = [])
    {
        $this->modx =& $modx;
        $this->namespace = $this->getOption('namespace', $options, $this->namespace);

        $corePath = $this->getOption('core_path', $options, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/' . $this->namespace . '/');
        $assetsPath = $this->getOption('assets_path', $options, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/' . $this->namespace . '/');
        $assetsUrl = $this->getOption('assets_url', $options, $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/' . $this->namespace . '/');
        $modxversion = $this->modx->getVersionData();

        // Load some default paths for easier management
        $this->options = array_merge([
            'namespace' => $this->namespace,
            'version' => $this->version,
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'vendorPath' => $corePath . 'vendor/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'pagesPath' => $corePath . 'elements/pages/',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'pluginsPath' => $corePath . 'elements/plugins/',
            'controllersPath' => $corePath . 'controllers/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'imagesUrl' => $assetsUrl . 'images/',
            'connectorUrl' => $assetsUrl . 'connector.php'
        ], $options);

        $lexicon = $this->modx->getService('lexicon', 'modLexicon');
        $lexicon->load($this->namespace . ':default');

        $this->packageName = $this->modx->lexicon('consentfriend');

        // Add default options
        $this->options = array_merge($this->options, [
            'debug' => (bool)$this->modx->getOption($this->namespace . '.debug', null, '0') == 1,
            'modxversion' => $modxversion['version'],
            'is_admin' => $this->modx->user && ($modx->hasPermission('settings') || $modx->hasPermission($this->namespace . '_settings')),
            'check' => (bool)$this->modx->getOption($this->namespace . '.check', null, '0') == 1,
            'enable' => (bool)$this->modx->getOption($this->namespace . '.enable', null, '1') == 1,
            'logUsage' => (bool)$this->modx->getOption($this->namespace . '.log_usage', null, '0') == 1,
            'useContexts' => (bool)$this->modx->getOption($this->namespace . '.use_contexts', null, '0') == 1,
            'elementID' => $this->modx->getOption($this->namespace . '.element_id', null, 'consentfriend'),
            'noAutoLoad' => (bool)$this->modx->getOption($this->namespace . '.no_autoLoad', null, '0') == 1,
            'htmlTexts' => (bool)$this->modx->getOption($this->namespace . '.html_texts', null, '0') == 1,
            'embedded' => (bool)$this->modx->getOption($this->namespace . '.embedded', null, '0') == 1,
            'groupByPurpose' => (bool)$this->modx->getOption($this->namespace . '.group_by_purpose', null, '1') == 1,
            'storageMethod' => $this->modx->getOption($this->namespace . '.storage_method', null, 'cookie'),
            'cookieName' => $this->modx->getOption($this->namespace . '.cookie_name', null, 'consentfriend'),
            'cookieExpiresAfterDays' => (int)$this->modx->getOption($this->namespace . '.cookie_expires_after_days', null, '365'),
            'cookieDomain' => $this->modx->getOption($this->namespace . '.cookie_domain', null, ''),
            'privacyPolicyId' => $this->modx->getOption($this->namespace . '.privacy_policy_id', null, $modx->getOption('site_start'), true),
            'default' => (bool)$this->modx->getOption($this->namespace . '.default', null, '0') == 1,
            'mustConsent' => (bool)$this->modx->getOption($this->namespace . '.must_consent', null, '0') == 1,
            'acceptAll' => (bool)$this->modx->getOption($this->namespace . '.accept_all', null, '1') == 1,
            'hideDeclineAll' => (bool)$this->modx->getOption($this->namespace . '.hide_decline_all', null, '0') == 1,
            'hideLearnMore' => (bool)$this->modx->getOption($this->namespace . '.hide_learn_more', null, '0') == 1,
            'noticeAsModal' => (bool)$this->modx->getOption($this->namespace . '.notice_as_modal', null, '0') == 1,
            'hidePoweredBy' => (bool)$this->modx->getOption($this->namespace . '.hide_powered_by', null, '1') == 1,
            'theme' => $this->modx->getOption($this->namespace . '.theme', null, ''),
            'userAgentFilter' => $this->modx->getOption($this->namespace . '.user_agent_filter', null, 'Bot,DuckDuckGo,Googlebot,python-requests,petalbot,SiteDash,sogou,Robot', true),
        ]);

        $this->cacheOptions = [
            xPDO::OPT_CACHE_KEY => $this->namespace,
            xPDO::OPT_CACHE_HANDLER => $this->modx->getOption('cache_resource_handler', null, $this->modx->getOption(xPDO::OPT_CACHE_HANDLER)),
            xPDO::OPT_CACHE_FORMAT => (integer)$this->modx->getOption('cache_resource_format', null, $this->modx->getOption(xPDO::OPT_CACHE_FORMAT, null, xPDOCacheManager::CACHE_PHP)),
        ];

        $this->modx->addPackage($this->namespace, $this->getOption('modelPath'));

        if ($this->getOption('theme')) {
            $this->modx->setOption($this->namespace . '.css_url', $this->getOption('cssUrl') . 'web/consentfriend.' . $this->getOption('theme') . '.min.css');
        }
        if ($this->modx->getOption($this->namespace . '.css_url')) {
            $this->modx->setOption($this->namespace . '.js_url', $this->getOption('jsUrl') . 'web/consentfriend-no-css.js');
        } elseif (!$this->modx->getOption($this->namespace . '.js_url')) {
            $this->modx->setOption($this->namespace . '.js_url', $this->getOption('jsUrl') . 'web/consentfriend.js');
        }

        $versionHash = hash('crc32', $this->version);
        $this->options = array_merge($this->options, [
            'consentfriendCss' => $this->modx->getOption($this->namespace . '.css_url') ? $this->modx->getOption($this->namespace . '.css_url') . '?v=' . $versionHash : '',
            'consentfriendJs' => $this->modx->getOption($this->namespace . '.js_url') . '?v=' . $versionHash,
        ]);
    }

    /**
     * Get a local configuration option or a namespaced system setting by key.
     *
     * @param string $key The option key to search for.
     * @param array $options An array of options that override local options.
     * @param mixed $default The default value returned if the option is not found locally or as a
     * namespaced system setting; by default this value is null.
     * @return mixed The option value or the default value specified.
     */
    public function getOption($key, $options = [], $default = null)
    {
        $option = $default;
        if (!empty($key) && is_string($key)) {
            if ($options != null && array_key_exists($key, $options)) {
                $option = $options[$key];
            } elseif (array_key_exists($key, $this->options)) {
                $option = $this->options[$key];
            } elseif (array_key_exists("$this->namespace.$key", $this->modx->config)) {
                $option = $this->modx->getOption("$this->namespace.$key");
            }
        }
        return $option;
    }

    /**
     * Get a lexicon key, if it is available. Otherwise return an empty string
     *
     * @param $key
     * @return string
     */
    private function lexicon($key)
    {
        return ($this->modx->lexicon($key) !== $key) ? $this->modx->lexicon($key) : '';
    }

    /**
     * Set a local configuration option.
     *
     * @param string $key The option key to be set.
     * @param mixed $value The value.
     */
    public function setOption(string $key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * ConsentFriend License Check
     */
    public function ConsentFriend()
    {
        // Only run the license check, if we're in the manager
        if (!$this->modx->context || $this->modx->context->get('key') !== 'mgr') {
            return;
        }
        // Get the public key from the <namespace>.pub file contained in the package directory
        $check = false;
        $pubKeyFile = $this->getOption('core_path') . '.' . $this->namespace . '.pub';
        $pubTimestampFile = $this->getOption('core_path') . '.' . $this->namespace . '.ts';

        $key = file_exists($pubKeyFile) ? file_get_contents($pubKeyFile) : '';
        $host = $this->modx->getOption('http_host');
        $keySegments = explode('@@', $key);
        if (count($keySegments) !== 2) {
            $key = '';
            $check = true;
        } else {
            list($host, $key) = $keySegments;
        }
        if ($host !== $this->modx->getOption('http_host')) {
            $check = true;
        }

        $timestamp = file_exists($pubTimestampFile) ? file_get_contents($pubTimestampFile) : false;
        if (!$timestamp ||
            $timestamp < strtotime('-1 week') ||
            $timestamp > time()) {
            $check = true;
        }

        if ($check) {
            $provider = false;
            $c = $this->modx->newQuery('transport.modTransportPackage');
            $c->where([
                'signature:LIKE' => $this->namespace . '-%',
            ]);
            $c->sortby('installed', 'DESC');
            $c->limit(1);
            $package = $this->modx->getObject('transport.modTransportPackage', $c);
            if ($package instanceof modTransportPackage || $package instanceof MODX\Revolution\Transport\modTransportPackage) {
                $provider = $package->getOne('Provider');
            }
            if (!$provider) {
                $provider = $this->modx->getObject('transport.modTransportProvider', [
                    'service_url' => 'https://rest.modmore.com/'
                ]);
            }
            $warnMessage = '';
            if ($provider instanceof modTransportProvider || $provider instanceof MODX\Revolution\Transport\modTransportProvider) {
                $this->modx->setOption('contentType', 'default');
                $params = [
                    'key' => $key,
                    'package' => $this->namespace,
                ];
                // Validate the license
                /** @var modRestResponse|ResponseInterface $response */
                $response = $provider->request('license', 'GET', $params);
                if ($response) {
                    $xml = ($response instanceof modRestResponse) ? $response->toXml() : simplexml_load_string($response->getBody()->getContents());
                    $valid = (int)$xml->valid;
                    if ($valid) {
                        // Install a new public key if available
                        $updatePublicKey = (bool)$xml->update_pubkey;
                        if ($updatePublicKey) {
                            file_put_contents($pubKeyFile, $this->modx->getOption('http_host') . '@@' . $xml->pubkey);
                        }
                        file_put_contents($pubTimestampFile, time());
                        return;
                    }

                    // Display some warnings, if the public key is invalid.
                    $message = (string)$xml->message;
                    $caseAge = (int)$xml->case_age;
                    $caseUrl = (string)$xml->case_url;
                    if (!$caseUrl) {
                        $warnMessage = "The $this->packageName license on this site is invalid.<br><br>Message: $message";
                    } elseif ($caseAge >= 7 || $caseAge == 0) {
                        $warnMessage = "The $this->packageName license on this site is invalid. Please click the button to correct the problem.<br>Message: $message";
                    } elseif ($caseAge >= 2) {
                        $warnMessage = "There is an issue with the $this->packageName license. Did your site recently moved to a new domain or was the license reset? Please click the button or contact your development team to correct the problem.";
                    }
                } else {
                    $caseUrl = '';
                    $warnMessage = "Unable to verify the $this->packageName license. The license check at the package provider did not run!";
                }
            } else {
                $caseUrl = '';
                $warnMessage = "Unable to verify the $this->packageName license. The package provider was not found!";
            }
            if ($warnMessage) {
                $this->modx->log(xPDO::LOG_LEVEL_ERROR, $warnMessage, '', $this->modx->lexicon($this->namespace));
                $output = <<<HTML
    <script type="text/javascript">
        Ext.onReady(function(){
            const caseUrl = '$caseUrl';
            Ext.Msg.show({
                title: '$this->packageName $this->version',
                msg: '$warnMessage',
                buttons: (caseUrl) ? { yes: 'Fix the licence', no: 'Cancel' } : { ok: 'Ok' },
                icon: Ext.MessageBox.WARNING,
                minWidth: 250,
                maxWidth: 350,
                closable: false,
                fn: function(btn){
                    if (btn === 'yes'){
                        let win = window.open(caseUrl, '_blank');
                        win.focus();
                    }
                }
            })
        });
    </script>
HTML;
                if ($this->modx->controller instanceof modManagerController) {
                    $this->modx->controller->addHtml($output);
                } else {
                    $this->modx->regClientHTMLBlock($output);
                }
            }
        }
    }

    /**
     * Prepends the configuration and the css/javascript at HEAD tag
     */
    public function addConsentFriend()
    {
        $config = [
            'version' => '1',
            'elementID' => $this->getOption('elementID'),
            'noAutoLoad' => (bool)$this->getOption('noAutoLoad'),
            'htmlTexts' => (bool)$this->getOption('htmlTexts'),
            'embedded' => (bool)$this->getOption('embedded'),
            'groupByPurpose' => (bool)$this->getOption('groupByPurpose'),
            'storageMethod' => $this->getOption('storageMethod'),
            'cookieName' => $this->getOption('cookieName'),
            'cookieExpiresAfterDays' => (int)$this->getOption('cookieExpiresAfterDays'),
            'cookieDomain' => $this->getOption('cookieDomain') ? $this->getOption('cookieDomain') : null,
            'default' => (bool)$this->getOption('default'),
            'mustConsent' => (bool)$this->getOption('mustConsent'),
            'acceptAll' => (bool)$this->getOption('acceptAll'),
            'hideDeclineAll' => $this->getOption('hideDeclineAll'),
            'hideLearnMore' => (bool)$this->getOption('hideLearnMore'),
            'noticeAsModal' => (bool)$this->getOption('noticeAsModal'),
            'poweredBy' => 'https://modmore.com/consentfriend',
            'disablePoweredBy' => (bool)$this->getOption('hidePoweredBy'),
            'additionalClass' => 'consentfriend',
            'lang' => $this->modx->getOption('cultureKey'),
            'theme' => $this->getOption('theme') ? $this->getOption('theme') : null,
        ];
        foreach ($config as $k => $v) {
            if (is_null($v)) {
                unset($config[$k]);
            }
        }

        $config['translations'] = $this->getTranslations();
        $config['services'] = $this->getServices();

        $link = '';
        if ($this->getOption('consentfriendCss')) {
            $link .= '<link rel="stylesheet" href="' . $this->getOption('consentfriendCss') . '">' . "\n";
        }

        $script = '';
        if ($this->getOption('consentfriendJs')) {
            $config = ($this->getOption('debug')) ? json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : json_encode($config, JSON_UNESCAPED_SLASHES);
            $config = str_replace(['"#regex#', '#/regex#"'], '', $config);
            $config = preg_replace_callback('/#callback#(.*?)#\/callback#/m', function ($treffer) {
                return str_replace(['\n', '\"'], ["\n", '"'], $treffer[0]);
            }, $config);
            $config = str_replace(['"#callback#', '#/callback#"'], '', $config);
            $script .= "\n" . '<script type="application/javascript">window.consentFriendConfig = ' . $config . ';</script>';
            $script .= "\n" . '<script defer data-klaro-config="consentFriendConfig" type="application/javascript" src="' . $this->getOption('consentfriendJs') . '"></script>';
        }

        $output = &$this->modx->resource->_output;
        // Emulate regClient for the stylesheet
        $output = preg_replace_callback('#</head>#', function ($match) use ($link) {
            return $link . "\n" . $match[0];
        }, $output);
        // Emulate regClient for the javascript
        $output = preg_replace_callback('#<head((\s)[^>]*)*>#', function ($match) use ($script) {
            return $match[0] . "\n" . $script;
        }, $output);
    }

    /**
     * Get the ConsentFriend translations
     *
     * @return array
     */
    private function getTranslations()
    {
        $cacheKey = $this->modx->getOption('cultureKey') . '/translations';
        $result = $this->modx->cacheManager->get($cacheKey, $this->cacheOptions);
        if (!$result) {
            // Load the Klaro and the custom lexicon
            $this->modx->lexicon->load($this->namespace . ':web', $this->namespace . ':services');
            if (file_exists($this->getOption('corePath') . 'lexicon/' . $this->modx->getOption('manager_language', [], 'en') . '/custom.inc.php')) {
                $this->modx->lexicon->load($this->namespace . ':custom');
            }
            $result = [
                'zz' => [
                    'privacyPolicyUrl' => $this->modx->makeUrl($this->getOption('privacyPolicyId'), '', '', 'full')
                ],
                $this->modx->getOption('cultureKey') => [
                    'privacyPolicy' => [
                        'name' => $this->modx->lexicon('consentfriend.privacyPolicy.name'),
                        'text' => $this->modx->lexicon('consentfriend.privacyPolicy.text'),
                    ],
                    'consentModal' => [
                        'title' => $this->modx->lexicon('consentfriend.consentModal.title'),
                        'description' => $this->modx->lexicon('consentfriend.consentModal.description'),
                    ],
                    'consentNotice' => [
                        'testing' => $this->modx->lexicon('consentfriend.consentNotice.testing'),
                        'changeDescription' => $this->modx->lexicon('consentfriend.consentNotice.changeDescription'),
                        'description' => $this->modx->lexicon('consentfriend.consentNotice.description'),
                        'learnMore' => $this->modx->lexicon('consentfriend.consentNotice.learnMore'),
                    ],
                    'purposes' => [
                        'functional' => [
                            'title' => $this->modx->lexicon('consentfriend.purposes.functional.title'),
                            'description' => $this->modx->lexicon('consentfriend.purposes.functional.description')
                        ],
                        'performance' => [
                            'title' => $this->modx->lexicon('consentfriend.purposes.performance.title'),
                            'description' => $this->modx->lexicon('consentfriend.purposes.performance.description')
                        ],
                        'marketing' => [
                            'title' => $this->modx->lexicon('consentfriend.purposes.marketing.title'),
                            'description' => $this->modx->lexicon('consentfriend.purposes.marketing.description')
                        ],
                        'advertising' => [
                            'title' => $this->modx->lexicon('consentfriend.purposes.advertising.title'),
                            'description' => $this->modx->lexicon('consentfriend.purposes.advertising.description')
                        ]
                    ],
                    'purposeItem' => [
                        'service' => $this->modx->lexicon('consentfriend.purposeItem.service'),
                        'services' => $this->modx->lexicon('consentfriend.purposeItem.services')
                    ],
                    'service' => [
                        'disableAll' => [
                            'title' => $this->modx->lexicon('consentfriend.service.disableAll.title'),
                            'description' => $this->modx->lexicon('consentfriend.service.disableAll.description')
                        ],
                        'optOut' => [
                            'title' => $this->modx->lexicon('consentfriend.service.optOut.title'),
                            'description' => $this->modx->lexicon('consentfriend.service.optOut.description')
                        ],
                        'required' => [
                            'title' => $this->modx->lexicon('consentfriend.service.required.title'),
                            'description' => $this->modx->lexicon('consentfriend.service.required.description')
                        ],
                        'purposes' => $this->modx->lexicon('consentfriend.service.purposes'),
                        'purpose' => $this->modx->lexicon('consentfriend.service.purpose')
                    ],
                    'contextualConsent' => [
                        'description' => $this->modx->lexicon('consentfriend.contextualConsent.description'),
                        'acceptOnce' => $this->modx->lexicon('consentfriend.contextualConsent.acceptOnce'),
                        'acceptAlways' => $this->modx->lexicon('consentfriend.contextualConsent.acceptAlways')
                    ],
                    'ok' => $this->modx->lexicon('consentfriend.ok'),
                    'save' => $this->modx->lexicon('consentfriend.save'),
                    'decline' => $this->modx->lexicon('consentfriend.decline'),
                    'close' => $this->modx->lexicon('consentfriend.close'),
                    'acceptAll' => $this->modx->lexicon('consentfriend.acceptAll'),
                    'acceptSelected' => $this->modx->lexicon('consentfriend.acceptSelected'),
                    'poweredBy' => $this->modx->lexicon('consentfriend.poweredBy')
                ]
            ];

            /** @var ConsentfriendPurposes[] $purposes */
            $purposes = $this->modx->getIterator('ConsentfriendPurposes', [
                'active' => true
            ]);
            foreach ($purposes as $purpose) {
                $purposeKey = $purpose->get('key');
                $purposeDescription = ($purpose->get('description')) ? $purpose->get('description') : $this->lexicon('consentfriend.purposes.' . $purposeKey . '.description');
                $purposeTitle = ($purpose->get('title')) ? $purpose->get('title') : $this->lexicon('consentfriend.purposes.' . $purposeKey . '.title');
                $purposeArray = [
                    'title' => ($purposeTitle) ?: $purposeKey
                ];
                if ($purposeDescription) {
                    $purposeArray['description'] = $purposeDescription;
                }
                $result[$this->modx->getOption('cultureKey')]['purposes'][$purposeKey] = $purposeArray;
            }

            $this->modx->cacheManager->set($cacheKey, $result, 0, $this->cacheOptions);
        }
        return $result;
    }

    /**
     * Get the ConsentFriend services
     *
     * @return array
     */
    private function getServices()
    {
        if ($this->getOption('useContexts')) {
            $cacheKey = $this->modx->getOption('cultureKey') . '_' . $this->modx->context->get('key') . '/services';
        } else {
            $cacheKey = $this->modx->getOption('cultureKey') . '/services';
        }
        $result = $this->modx->cacheManager->get($cacheKey, $this->cacheOptions);
        if (!$result || $this->getOption('debug')) {
            $result = [];

            // Load the Klaro and the custom lexicon
            $this->modx->lexicon->load($this->namespace . ':web', $this->namespace . ':services');
            if (file_exists($this->getOption('corePath') . 'lexicon/' . $this->modx->getOption('manager_language', [], 'en') . '/custom.inc.php')) {
                $this->modx->lexicon->load($this->namespace . ':custom');
            }

            $c = $this->modx->newQuery('ConsentfriendServices');
            $c->where(['ConsentfriendServices.active' => true]);
            $c->where(['Purpose.active' => true]);
            $c->distinct();
            $c->leftJoin('ConsentfriendServicePurposes', 'ServicePurposes');
            $c->leftJoin('ConsentfriendPurposes', 'Purpose', ['ServicePurposes.purpose_id = Purpose.id']);
            $c->sortby('ConsentfriendServices.sortindex');

            if ($this->getOption('useContexts')) {
                $c->leftJoin('ConsentfriendServiceContexts', 'ServiceContexts');
                $c->where(['ServiceContexts.context_key' => $this->modx->context->get('key')]);
            }

            /** @var ConsentfriendServices[] $services */
            $services = $this->modx->getIterator('ConsentfriendServices', $c);
            foreach ($services as $service) {
                $purposes = [];
                /** @var ConsentfriendServicePurposes[] $servicePurposes */
                $servicePurposes = $service->getMany('ServicePurposes');
                foreach ($servicePurposes as $servicePurpose) {
                    $purpose = $servicePurpose->getOne('Purpose');
                    $purposes[] = $purpose->get('key');
                }
                $cookies = json_decode($service->get('cookies'), true);
                $cookieArray = [];
                if ($cookies) {
                    foreach ($cookies as $cookie) {
                        $validRegex = @preg_match($cookie['cookie'], null) !== false;
                        // Mark valid regex
                        $cookieString = ($validRegex) ? '#regex#' . $cookie['cookie'] . '#/regex#' : $cookie['cookie'];
                        $cookiePath = ($cookie['path']) ?: '';
                        $cookieDomain = ($cookie['domain']) ?: '';
                        if ($cookie['path'] || $cookie['domain']) {
                            $cookieArray[] = [$cookieString, $cookiePath, $cookieDomain];
                        } else {
                            $cookieArray[] = $cookieString;
                        }
                    }
                }
                $callback = $service->get('callback');
                $callback = ($callback) ? '#callback#' . $callback . '#/callback#' : '';
                $onInit = $service->get('on_init');
                $onInit = ($onInit) ? '#callback#' . $onInit . '#/callback#' : '';
                $onAccept = $service->get('on_accept');
                $onAccept = ($onAccept) ? '#callback#' . $onAccept . '#/callback#' : '';
                $onDecline = $service->get('on_decline');
                $onDecline = ($onDecline) ? '#callback#' . $onDecline . '#/callback#' : '';

                $service = [
                    'name' => $service->get('name'),
                    'title' => ($service->get('title')) ? $service->get('title') : $this->lexicon('consentfriend.services.' . $service->get('name') . '.title'),
                    'description' => ($service->get('description')) ? $service->get('description') : $this->lexicon('consentfriend.services.' . $service->get('name') . '.description'),
                    'purposes' => $purposes,
                    'cookies' => $cookieArray,
                    'default' => $service->get('default') === true,
                    'callback' => $callback,
                    'onInit' => $onInit,
                    'onAccept' => $onAccept,
                    'onDecline' => $onDecline,
                    'required' => $service->get('required') === true,
                    'optOut' => $service->get('opt_out') === true,
                    'onlyOnce' => $service->get('only_once') === true,
                    'contextualConsentOnly' => $service->get('contextual_consent_only') === true
                ];
                foreach ($service as $k => $v) {
                    if ($v === '' || $v === false || $v === null || $v == []) {
                        unset($service[$k]);
                    }
                }
                $result[] = $service;
            }
            $this->modx->cacheManager->set($cacheKey, $result, 0, $this->cacheOptions);
        }
        return $result;
    }

    /**
     * Register the services code at the end of the body
     */
    public function addServices()
    {
        $c = $this->modx->newQuery('ConsentfriendServices');
        $c->where(['ConsentfriendServices.active' => true]);
        $c->where(['Purpose.active' => true]);
        $c->distinct();
        $c->leftJoin('ConsentfriendServicePurposes', 'ServicePurposes');
        $c->leftJoin('ConsentfriendPurposes', 'Purpose', ['ServicePurposes.purpose_id = Purpose.id']);
        $c->sortby('ConsentfriendServices.sortindex');

        if ($this->getOption('useContexts')) {
            $c->leftJoin('ConsentfriendServiceContexts', 'ServiceContexts');
            $c->where(['ServiceContexts.context_key' => $this->modx->context->get('key')]);
        }

        /** @var ConsentfriendServices[] $services */
        $services = $this->modx->getIterator('ConsentfriendServices', $c);
        foreach ($services as $service) {
            if ($service->get('code')) {
                $code = $service->get('code');
                foreach ($this->modx->config as $key => $value) {
                    if (is_string($value)) {
                        // @todo better system setting parsing
                        $code = str_replace('[[++' . $key . ']]', $value, $code);
                    }
                }
                $code = $this->transformCode($code, $service->get('name'));
                if ($service->get('code_section') == 1) {
                    $this->modx->regClientHTMLBlock($code);
                } else {
                    $this->modx->regClientStartupHTMLBlock($code);
                }
            }
        }

    }

    /**
     * @param $code
     * @param $name
     * @return string
     */
    private function transformCode($code, $name)
    {
        // Script tags
        $code = preg_replace_callback(
            '/<(script)([^>]*?)>/',
            function ($matches) use ($name) {
                if ($matches[2]) {
                    if (strpos($matches[2], ' type="') !== false) {
                        $matches[2] = preg_replace('/ type="([^"]*?)"/', ' data-type="$1"', $matches[2]);
                    } else {
                        $matches[2] = ' data-type="application/javascript"' . $matches[2];
                    }
                    if (strpos($matches[2], ' src="') !== false) {
                        $matches[2] = preg_replace('/ src="([^"]*?)"/', ' data-src="$1"', $matches[2]);
                    }
                } else {
                    $matches[2] = ' data-type="application/javascript"';
                }
                return '<' . $matches[1] . ' type="text/plain"' . $matches[2] . ' data-name="' . $name . '">';
            },
            $code
        );
        // Link and img tags
        $code = preg_replace_callback(
            '/<(link|img|iframe)([^>]*?)>/',
            function ($matches) use ($name) {
                if ($matches[2]) {
                    if ($matches[1] == 'link') {
                        if (strpos($matches[2], ' type="') !== false) {
                            $matches[2] = preg_replace('/ type="([^"]*?)"/', ' data-type="$1"', $matches[2]);
                        } else {
                            $matches[2] = ' data-type="text/css"' . $matches[2];
                        }
                    }
                    if (strpos($matches[2], ' src="') !== false) {
                        $matches[2] = preg_replace('/ src="([^"]*?)"/', ' data-src="$1"', $matches[2]);
                    }
                    if (strpos($matches[2], ' href="') !== false) {
                        $matches[2] = preg_replace('/ href="([^"]*?)"/', ' data-href="$1"', $matches[2]);
                    }
                }
                return '<' . $matches[1] . $matches[2] . ' data-name="' . $name . '">';
            },
            $code
        );

        return $code;
    }

    /**
     * Log the usage of ConsentFriend in the frontend
     */
    public function logUsage()
    {
        $sessionKey = $_COOKIE[$this->modx->getOption('session_name', null, 'PHPSESSID', true)];
        $userIp = $this->anonymizeIp($_SERVER['REMOTE_ADDR'] ?? '');
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $services = $_COOKIE[$this->getOption('cookie_name')] ?? '';

        if ($sessionKey && $this->userAgentCheck($userAgent)) {
            /** @var ConsentfriendLogs $logEntry */
            $c = $this->modx->newQuery('ConsentfriendLogs');
            $c->where([[
                'session_key' => $sessionKey,
                'user_ip' => $userIp
            ], [
                'OR:services:=' => '',
                'user_ip' => $userIp,
                'first_visit:>=' => strtotime('-1 hour')
            ]]);
            $logEntry = $this->modx->getObject('ConsentfriendLogs', $c);
            $save = false;
            if (!$logEntry) {
                $logEntry = $this->modx->newObject('ConsentfriendLogs');
                $logEntry->fromArray([
                    'session_key' => $sessionKey,
                    'user_ip' => $userIp,
                    'user_agent' => $userAgent,
                    'first_visit' => time(),
                    'services' => $services
                ]);
                $save = true;
            }
            if ($services && $logEntry->get('services') != $services) {
                $logEntry->fromArray([
                    'last_visit' => time(),
                    'services' => $services,
                    'user_agent' => $userAgent,
                ]);
                $save = true;
            }
            if ($save) {
                $logEntry->save();
            }
        }
    }

    /**
     * Anonymize an IP (Last byte of IPv4/ Last two IPv6)
     *
     * @param $ip
     * @return array|string|string[]|null
     */
    private function anonymizeIp($ip)
    {
        return preg_replace(['/\.\d*$/', '/[\da-f]*:[\da-f]*$/'], ['.XXX', 'XXXX:XXXX'], $ip);
    }

    /**
     * Check the user agent for filter words
     *
     * @param $agent
     * @return bool
     */
    private function userAgentCheck($agent)
    {
        $userAgentFilters = array_map('trim', explode(',', $this->getOption('userAgentFilter')));
        foreach ($userAgentFilters as $userAgentFilter) {
            if (!empty($agent) && !empty($userAgentFilter) && strpos($userAgentFilter, $agent) !== false) {
                return false;
            }
        }
        return true;
    }
}
