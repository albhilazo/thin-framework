<?php

namespace ThinFramework\Component\Request;


class Request
{

    private $server;
    private $session;
    private $cookie;
    private $request;


    public function __construct()
    {
        session_start();

        $this->server  = $_SERVER;
        $this->session = $_SESSION;
        $this->cookie  = $_COOKIE;

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->request = $_POST;
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $this->request = $_GET;
        }
    }

}
