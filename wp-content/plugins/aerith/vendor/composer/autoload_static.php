<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbdcc6257618e6166925e549f297ef8b2
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbdcc6257618e6166925e549f297ef8b2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbdcc6257618e6166925e549f297ef8b2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}