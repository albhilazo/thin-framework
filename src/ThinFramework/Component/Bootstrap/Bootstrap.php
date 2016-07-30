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
        new Router($this->config['routing_path']);
    }

}
