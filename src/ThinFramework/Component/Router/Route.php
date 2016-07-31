<?php

namespace ThinFramework\Component\Router;

use ThinFramework\Component\Templating\TemplatingAdapter;


class Route
{

    const DEFAULT_ACTION = 'indexAction';

    private $path;
    private $controller;
    private $action;
    private $parameters;


    public function __construct($path, $controller, $action, $parameters)
    {
        $this->path       = $path;
        $this->controller = $controller;
        $this->action     = ($action) ? $action : self::DEFAULT_ACTION;
        $this->parameters = $parameters;
    }


    public function call(TemplatingAdapter $templating)
    {
        $controllerInstance = new $this->controller($templating);

        call_user_func_array(
            [$controllerInstance, $this->action],
            $this->parameters
        );
    }


    public function path()
    {
        return $this->path;
    }


    public function controller()
    {
        return $this->controller;
    }


    public function action()
    {
        return $this->action;
    }


    public function parameters()
    {
        return $this->parameters;
    }

}
