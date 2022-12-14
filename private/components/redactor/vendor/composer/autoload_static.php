<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcb49fe87dcb5f436cf5cc52018029384
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'modmore\\Redactor\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'modmore\\Redactor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcb49fe87dcb5f436cf5cc52018029384::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcb49fe87dcb5f436cf5cc52018029384::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcb49fe87dcb5f436cf5cc52018029384::$classMap;

        }, null, ClassLoader::class);
    }
}
