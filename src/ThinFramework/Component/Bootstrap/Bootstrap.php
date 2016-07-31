<?php

namespace ThinFramework\Component\Bootstrap;

use ThinFramework\Component\Router\Router;


class Bootstrap
{

    const DEFAULT_ACTION = 'indexAction';

    private $config;


    public function __construct(array $config)
    {
        $this->config = $config;
    }


    public function __invoke()
    {
        $router = new Router($this->config['routing_path']);
        $currentPath = parse_url($_SERVER['REQUEST_URI'])['path'];
        $route = $router->getRoute($currentPath);

        $routeController = new $route['attributes']['controller']();
        $routeAction = (isset($route['attributes']['action']))
                        ? $route['attributes']['action']
                        : self::DEFAULT_ACTION;
        $routeParams = (isset($route['parameters']))
                        ? $route['parameters']
                        : [];

        call_user_func_array(
            [$routeController, $routeAction],
            $routeParams
        );
    }

}
