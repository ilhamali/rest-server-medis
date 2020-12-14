<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7cc442884bd81ae25a7c8a95c97cc30d
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7cc442884bd81ae25a7c8a95c97cc30d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7cc442884bd81ae25a7c8a95c97cc30d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7cc442884bd81ae25a7c8a95c97cc30d::$classMap;

        }, null, ClassLoader::class);
    }
}
