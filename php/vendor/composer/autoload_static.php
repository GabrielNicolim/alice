<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit58b04ff7d9d97c5af50e6e98a1a28f99
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit58b04ff7d9d97c5af50e6e98a1a28f99::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit58b04ff7d9d97c5af50e6e98a1a28f99::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit58b04ff7d9d97c5af50e6e98a1a28f99::$classMap;

        }, null, ClassLoader::class);
    }
}
