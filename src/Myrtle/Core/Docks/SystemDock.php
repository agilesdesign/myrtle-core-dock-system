<?php

namespace Myrtle\Core\Docks;

use Myrtle\Core\System\Policies\SystemPolicy;
use Myrtle\Core\System\Providers\SystemServiceProvider;

class SystemDock extends Dock
{
    /**
     * Description for Dock
     *
     * @var string
     */
    public $description = 'System management';

    /**
     * Explicit Gate definitions
     *
     * @var array
     */
    public $gateDefinitions = [
        'system.admin' => SystemPolicy::class . '@admin',
        'system.access.admin' => SystemPolicy::class . '@accessAdmin'
    ];

    /**
     * Policy mappings
     *
     * @var array
     */
    public $policies = [
        SystemPolicy::class => SystemPolicy::class,
    ];

    /**
     * List of providers to be registered
     *
     * @var array
     */
    public $providers = [
        SystemServiceProvider::class,
    ];

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/system.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of routes file paths to be loaded
     *
     * @return array
     */
    public function routes()
    {
        return [
            'admin' => dirname(__DIR__, 3) . '/routes/admin.php',
        ];
    }
}
