<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit48132dc830e9b948ab7cbadf00902c3e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit48132dc830e9b948ab7cbadf00902c3e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit48132dc830e9b948ab7cbadf00902c3e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit48132dc830e9b948ab7cbadf00902c3e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
