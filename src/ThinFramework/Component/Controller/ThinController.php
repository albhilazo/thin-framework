<?php

namespace ThinFramework\Component\Controller;

use ThinFramework\Component\Response\Response;
use ThinFramework\Component\Templating\TemplatingAdapter;


abstract class ThinController
{

    protected $template;


    public function __construct(TemplatingAdapter $templating)
    {
        $this->template = $templating;
    }


    protected function sendResponse()
    {
        $output   = $this->template->render();
        $response = new Response($output);
        $response->send();
    }

}
