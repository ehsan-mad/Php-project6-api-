<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6c7c3f4670f6c937422a72e44045892
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd6c7c3f4670f6c937422a72e44045892::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd6c7c3f4670f6c937422a72e44045892::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd6c7c3f4670f6c937422a72e44045892::$classMap;

        }, null, ClassLoader::class);
    }
}
