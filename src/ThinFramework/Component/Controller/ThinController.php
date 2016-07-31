<?php

namespace ThinFramework\Component\Controller;

use ThinFramework\Component\Response\Response;


abstract class ThinController
{

    protected $response;


    public function indexAction()
    {
    }


    protected function setResponse($content)
    {
        $this->response = new Response($content);
    }

}
