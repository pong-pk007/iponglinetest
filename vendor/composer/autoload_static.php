<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a4351b467d329bf3c03cbba26865d63
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a4351b467d329bf3c03cbba26865d63::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a4351b467d329bf3c03cbba26865d63::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
