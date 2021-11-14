<?php

/*
 * This file is part of the vivid-foundation project.
 *
 * Copyright for portions of project lucid-foundation are held by VineLab, 2016 as part of Lucid Architecture.
 * All other copyright for project Vivid Architecture are held by Meletios Flevarakis, 2021.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vivid\Foundation\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseServiceProvider;
use Illuminate\Routing\Router;

abstract class RouteServiceProvider extends BaseServiceProvider
{
    /**
     * Read the routes from the "api.php" and "web.php" files of this Service.
     *
     * @param \Illuminate\Routing\Router $router
     */
    abstract public function map(Router $router);

    public function loadRoutesFiles(Router $router, string $namespace, string $pathApi = null, string $pathWeb = null): void
    {
        if (is_file($pathApi)) {
            $this->mapApiRoutes($router, $namespace, $pathApi);
        }
        if (is_file($pathWeb)) {
            $this->mapWebRoutes($router, $namespace, $pathWeb);
        }
    }

    protected function mapApiRoutes(Router $router, string $namespace, string $path, string $prefix = 'api'): void
    {
        $router->group([
            'middleware' => 'api',
            'namespace'  => $namespace,
            'prefix'     => $prefix,
        ], function ($router) use ($path) {
            require $path;
        });
    }

    protected function mapWebRoutes(Router $router, string $namespace, string $path): void
    {
        $router->group([
            'middleware' => 'web',
            'namespace'  => $namespace,
        ], function ($router) use ($path) {
            require $path;
        });
    }
}
