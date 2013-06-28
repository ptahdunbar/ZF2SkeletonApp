<?php

namespace Tests;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

class Bootstrap
{
    protected static $serviceManager;
    protected static $config;
    protected static $bootstrap;

    public static function init()
    {
        define( 'APP_ENV', 'testing' );

        // Load application.config.php.
        $testConfig = include realpath(__DIR__ . '/../config/application.config.php');

        $zf2ModulePaths = [];

        if ( isset($testConfig['module_listener_options']['module_paths']) ) {
            $modulePaths = $testConfig['module_listener_options']['module_paths'];
            foreach ( $modulePaths as $modulePath ) {
                if (($path = static::findParentPath($modulePath)) ) {
                    $zf2ModulePaths[] = $path;
                }
            }
        }

        $zf2ModulePaths  = implode(PATH_SEPARATOR, $zf2ModulePaths) . PATH_SEPARATOR;
        $zf2ModulePaths .= getenv('ZF2_MODULES_TEST_PATHS') ?: (defined('ZF2_MODULES_TEST_PATHS') ? ZF2_MODULES_TEST_PATHS : '');

        static::initAutoloader();

        // use ModuleManager to load this module and it's dependencies
        $baseConfig = [
            'module_listener_options' => [
                'module_paths' => explode(PATH_SEPARATOR, $zf2ModulePaths)
            ],
        ];

        $config = ArrayUtils::merge($baseConfig, $testConfig);

        $smConfig = isset($config['service_manager']) ? $config['service_manager'] : array();
        $serviceManager = new ServiceManager(new ServiceManagerConfig($smConfig));
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
        static::$config = $config;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    public static function getConfig()
    {
        return static::$config;
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        // Try to include the Composer autoloader
        if ( is_readable($vendorPath . '/autoload.php') ) {
            $loader = include $vendorPath . '/autoload.php';
        }

        // ZF2 Autoloader for our tests.
        AutoloaderFactory::factory([
            'Zend\Loader\StandardAutoloader' =>
            [
                'autoregister_zf' => true,
                'namespaces' =>
                [
                    'ApplicationTest' =>  __DIR__ . '../module/Application/tests/ApplicationTest/src',
                ]
            ]
        ]);
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) return false;
            $previousDir = $dir;
        }

        return $dir . '/' . $path;
    }
}

Bootstrap::init();