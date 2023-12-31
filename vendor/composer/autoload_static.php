<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe8b955efb72ad376dacd8e146ceeac8
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfe8b955efb72ad376dacd8e146ceeac8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfe8b955efb72ad376dacd8e146ceeac8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfe8b955efb72ad376dacd8e146ceeac8::$classMap;

        }, null, ClassLoader::class);
    }
}
