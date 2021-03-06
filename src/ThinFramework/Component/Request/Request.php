<?php

namespace ThinFramework\Component\Request;


class Request
{

    private $server;
    private $session;
    private $cookie;
    private $data;
    private $path;


    public function __construct()
    {
        session_start();

        $this->server  = $_SERVER;
        $this->session = $_SESSION;
        $this->cookie  = $_COOKIE;

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->data = $_POST;
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $this->data = $_GET;
        }

        $this->path = parse_url($_SERVER['REQUEST_URI'])['path'];
    }


    public function server()
    {
        return $this->server;
    }


    public function session()
    {
        return $this->session;
    }


    public function cookie()
    {
        return $this->cookie;
    }


    public function data()
    {
        return $this->data;
    }


    public function path()
    {
        return $this->path;
    }

}
