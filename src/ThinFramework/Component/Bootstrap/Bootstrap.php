<?php

namespace ThinFramework\Component\Bootstrap;

use ThinFramework\Component\Router\Router;


class Bootstrap
{

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
    }

}
