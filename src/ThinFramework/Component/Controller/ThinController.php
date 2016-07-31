<?php

namespace ThinFramework\Component\Controller;

use ThinFramework\Component\Request\Request;
use ThinFramework\Component\Response\Response;
use ThinFramework\Component\Templating\TemplatingAdapter;


abstract class ThinController
{

    protected $template;
    protected $request;


    public function __construct(TemplatingAdapter $templating, Request $request)
    {
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
