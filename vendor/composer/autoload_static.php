<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ea6ce1ec315d5c10c1d5d33ec223037
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Umbrr\\CmsTemplate\\' => 18,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Umbrr\\CmsTemplate\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ea6ce1ec315d5c10c1d5d33ec223037::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ea6ce1ec315d5c10c1d5d33ec223037::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ea6ce1ec315d5c10c1d5d33ec223037::$classMap;

        }, null, ClassLoader::class);
    }
}