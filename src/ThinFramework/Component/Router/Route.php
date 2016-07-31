<?php

namespace ThinFramework\Component\Router;


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


    public function call()
    {
        call_user_func_array(
            [new $this->controller, $this->action],
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
