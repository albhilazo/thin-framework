<?php

namespace ThinFramework\Component\Bootstrap;

use ThinFramework\Component\Router\Router;
use ThinFramework\Component\Request\Request;


class Bootstrap
{

    private $config;


    public function __construct(array $config)
    {
        $this->config = $config;
    }


    public function __invoke(Request $request)
    {
        $router = new Router($this->config['routing_path']);
        $router->getRoute($request)->call();
    }

}
