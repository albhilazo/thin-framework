<?php

namespace ThinFramework\Component\Bootstrap;

use ThinFramework\Component\Router\Router;
use ThinFramework\Component\Request\Request;
use ThinFramework\Component\Container\Container;


class Bootstrap
{

    private $config;


    public function __construct(array $config)
    {
        $this->config = $config;
    }


    public function __invoke(Request $request)
    {
        $container = new Container($this->config['services_path']);

        $router = $container->get('thin.router');

        switch ($this->config['templating_engine']) {
            case 'Smarty':
                $templatingAdapter = 'thin.templating.smarty';
                break;

            default:
                $templatingAdapter = 'thin.templating.twig';
                break;
        }
        $templating = $container->get($templatingAdapter);

        $router->getRoute($request)->call($container, $templating, $request);
    }

}
