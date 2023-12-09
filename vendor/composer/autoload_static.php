<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit579d08a0764852d521dd8304247998d3
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Coffeeplugins\\WpFramework\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Coffeeplugins\\WpFramework\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit579d08a0764852d521dd8304247998d3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit579d08a0764852d521dd8304247998d3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit579d08a0764852d521dd8304247998d3::$classMap;

        }, null, ClassLoader::class);
    }
}
