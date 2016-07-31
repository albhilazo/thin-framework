<?php

namespace ThinFramework\Component\Controller;

use ThinFramework\Component\Request\Request;
use ThinFramework\Component\Response\Response;
use ThinFramework\Component\Container\Container;
use ThinFramework\Component\Templating\TemplatingAdapter;


abstract class ThinController
{

    protected $container;
    protected $template;
    protected $request;


    public function __construct(Container $container, TemplatingAdapter $templating, Request $request)
    {
        $this->container = $container;
        $this->template = $templating;
        $this->request  = $request;
    }


    protected function sendResponse()
    {
        $output   = $this->template->render();
        $response = new Response($output);
        $response->send();
    }

}
