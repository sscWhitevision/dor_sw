<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit18218bdaeb2f6f491489878887449624
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TreehillStudio\\ImagePlus\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TreehillStudio\\ImagePlus\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'TreehillStudio\\ImagePlus\\CropEngines\\AbstractCropEngine' => __DIR__ . '/../..' . '/src/CropEngines/AbstractCropEngine.php',
        'TreehillStudio\\ImagePlus\\CropEngines\\PhpThumbOf' => __DIR__ . '/../..' . '/src/CropEngines/PhpThumbOf.php',
        'TreehillStudio\\ImagePlus\\CropEngines\\PhpThumbOn' => __DIR__ . '/../..' . '/src/CropEngines/PhpThumbOn.php',
        'TreehillStudio\\ImagePlus\\CropEngines\\PhpThumbsUp' => __DIR__ . '/../..' . '/src/CropEngines/PhpThumbsUp.php',
        'TreehillStudio\\ImagePlus\\ImagePlus' => __DIR__ . '/../..' . '/src/ImagePlus.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Events\\OnManagerPageBeforeRender' => __DIR__ . '/../..' . '/src/Plugins/Events/OnManagerPageBeforeRender.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Events\\OnTVInputPropertiesList' => __DIR__ . '/../..' . '/src/Plugins/Events/OnTVInputPropertiesList.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Events\\OnTVInputRenderList' => __DIR__ . '/../..' . '/src/Plugins/Events/OnTVInputRenderList.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Events\\OnTVOutputRenderList' => __DIR__ . '/../..' . '/src/Plugins/Events/OnTVOutputRenderList.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Events\\OnTVOutputRenderPropertiesList' => __DIR__ . '/../..' . '/src/Plugins/Events/OnTVOutputRenderPropertiesList.php',
        'TreehillStudio\\ImagePlus\\Plugins\\Plugin' => __DIR__ . '/../..' . '/src/Plugins/Plugin.php',
        'TreehillStudio\\ImagePlus\\Snippets\\ImagePlus' => __DIR__ . '/../..' . '/src/Snippets/ImagePlus.php',
        'TreehillStudio\\ImagePlus\\Snippets\\Snippet' => __DIR__ . '/../..' . '/src/Snippets/Snippet.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit18218bdaeb2f6f491489878887449624::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit18218bdaeb2f6f491489878887449624::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit18218bdaeb2f6f491489878887449624::$classMap;

        }, null, ClassLoader::class);
    }
}
