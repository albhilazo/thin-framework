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

        switch ($this->config['templating_engine']) {
            case 'Smarty':
                $templatingAdapter = '\ThinFramework\Component\Templating\SmartyAdapter';
                break;

            default:
                $templatingAdapter = '\ThinFramework\Component\Templating\TwigAdapter';
                break;
        }
        $templating = new $templatingAdapter($this->config['templating_path']);

        $router->getRoute($request)->call($templating);
    }

}
