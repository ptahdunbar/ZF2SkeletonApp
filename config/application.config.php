<?php

if ( ! defined('APP_ENV') ) {
    define( 'APP_ENV', 'development' );
}

$modules = [
    'Application',
];

switch ( APP_ENV ) {
    case 'development':
        $modules = array_merge(
            $modules,
            [
                'ZendDeveloperTools',
            ]
        );
        break;
    case 'testing':
        break;
    case 'production':
        break;
}

return [
    // This should be an array of module namespaces used in the application.
    'modules' => $modules,

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' =>
    [
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' =>
        [
            './module',
            './vendor',
        ],

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively overide configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' =>
        [
            sprintf( 'config/autoload/{,*.}{global,%s,local}.php', APP_ENV ),
        ],

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        'config_cache_enabled' => ( APP_ENV == 'production' ),

        // The key used to create the configuration cache file name.
        'config_cache_key' => 'app_config',

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        'module_map_cache_enabled' => ( APP_ENV == 'production' ),

        // The key used to create the class map cache file name.
        'module_map_cache_key' => 'module_map',

        // The path in which to cache merged configuration.
        'cache_dir' => 'data/config/',

        // Whether or not to enable modules dependency checking.
        // Enabled by default, prevents usage of modules that depend on other modules
        // that weren't loaded.
         'check_dependencies' => ( APP_ENV != 'production' ),
    ],

   // Initial configuration with which to seed the ServiceManager.
   // Should be compatible with Zend\ServiceManager\Config.
//    'service_manager' => [],
];