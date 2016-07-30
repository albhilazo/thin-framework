<?php

namespace ThinFramework\Component\Router;

use Symfony\Component\Yaml\Parser;


class Router
{

    private $routes;


    public function __construct($routingPath)
    {
        $parser = new Parser();
        $this->routes = $parser->parse( file_get_contents($routingPath) );
    }

}
