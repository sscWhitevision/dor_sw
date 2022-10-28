<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a310b506ad18774a50fe5d608c14d2a
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TreehillStudio\\ConsentFriend\\' => 29,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TreehillStudio\\ConsentFriend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Symfony\\Component\\Yaml\\Command\\LintCommand' => __DIR__ . '/..' . '/symfony/yaml/Command/LintCommand.php',
        'Symfony\\Component\\Yaml\\Dumper' => __DIR__ . '/..' . '/symfony/yaml/Dumper.php',
        'Symfony\\Component\\Yaml\\Escaper' => __DIR__ . '/..' . '/symfony/yaml/Escaper.php',
        'Symfony\\Component\\Yaml\\Exception\\DumpException' => __DIR__ . '/..' . '/symfony/yaml/Exception/DumpException.php',
        'Symfony\\Component\\Yaml\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/yaml/Exception/ExceptionInterface.php',
        'Symfony\\Component\\Yaml\\Exception\\ParseException' => __DIR__ . '/..' . '/symfony/yaml/Exception/ParseException.php',
        'Symfony\\Component\\Yaml\\Exception\\RuntimeException' => __DIR__ . '/..' . '/symfony/yaml/Exception/RuntimeException.php',
        'Symfony\\Component\\Yaml\\Inline' => __DIR__ . '/..' . '/symfony/yaml/Inline.php',
        'Symfony\\Component\\Yaml\\Parser' => __DIR__ . '/..' . '/symfony/yaml/Parser.php',
        'Symfony\\Component\\Yaml\\Tag\\TaggedValue' => __DIR__ . '/..' . '/symfony/yaml/Tag/TaggedValue.php',
        'Symfony\\Component\\Yaml\\Unescaper' => __DIR__ . '/..' . '/symfony/yaml/Unescaper.php',
        'Symfony\\Component\\Yaml\\Yaml' => __DIR__ . '/..' . '/symfony/yaml/Yaml.php',
        'Symfony\\Polyfill\\Ctype\\Ctype' => __DIR__ . '/..' . '/symfony/polyfill-ctype/Ctype.php',
        'TreehillStudio\\ConsentFriend\\ConsentFriend' => __DIR__ . '/../..' . '/src/ConsentFriend.php',
        'TreehillStudio\\ConsentFriend\\Helper\\Export' => __DIR__ . '/../..' . '/src/Helper/Export.php',
        'TreehillStudio\\ConsentFriend\\Helper\\Import' => __DIR__ . '/../..' . '/src/Helper/Import.php',
        'TreehillStudio\\ConsentFriend\\Plugins\\Events\\OnHandleRequest' => __DIR__ . '/../..' . '/src/Plugins/Events/OnHandleRequest.php',
        'TreehillStudio\\ConsentFriend\\Plugins\\Events\\OnManagerPageBeforeRender' => __DIR__ . '/../..' . '/src/Plugins/Events/OnManagerPageBeforeRender.php',
        'TreehillStudio\\ConsentFriend\\Plugins\\Events\\OnSiteRefresh' => __DIR__ . '/../..' . '/src/Plugins/Events/OnSiteRefresh.php',
        'TreehillStudio\\ConsentFriend\\Plugins\\Events\\OnWebPagePrerender' => __DIR__ . '/../..' . '/src/Plugins/Events/OnWebPagePrerender.php',
        'TreehillStudio\\ConsentFriend\\Plugins\\Plugin' => __DIR__ . '/../..' . '/src/Plugins/Plugin.php',
        'TreehillStudio\\ConsentFriend\\Processors\\ObjectCreateProcessor' => __DIR__ . '/../..' . '/src/Processors/ObjectCreateProcessor.php',
        'TreehillStudio\\ConsentFriend\\Processors\\ObjectGetListProcessor' => __DIR__ . '/../..' . '/src/Processors/ObjectGetListProcessor.php',
        'TreehillStudio\\ConsentFriend\\Processors\\ObjectRemoveProcessor' => __DIR__ . '/../..' . '/src/Processors/ObjectRemoveProcessor.php',
        'TreehillStudio\\ConsentFriend\\Processors\\ObjectSortindexProcessor' => __DIR__ . '/../..' . '/src/Processors/ObjectSortindexProcessor.php',
        'TreehillStudio\\ConsentFriend\\Processors\\ObjectUpdateProcessor' => __DIR__ . '/../..' . '/src/Processors/ObjectUpdateProcessor.php',
        'TreehillStudio\\ConsentFriend\\Processors\\Processor' => __DIR__ . '/../..' . '/src/Processors/Processor.php',
        'TreehillStudio\\ConsentFriend\\Widgets\\Widget' => __DIR__ . '/../..' . '/src/Widgets/Widget.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a310b506ad18774a50fe5d608c14d2a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a310b506ad18774a50fe5d608c14d2a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a310b506ad18774a50fe5d608c14d2a::$classMap;

        }, null, ClassLoader::class);
    }
}
