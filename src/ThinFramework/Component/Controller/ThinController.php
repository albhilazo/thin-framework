<?php

namespace ThinFramework\Component\Controller;

use ThinFramework\Component\Response\Response;


abstract class ThinController
{

    public function indexAction()
    {
    }


    protected function setResponse($content)
    {
        return new Response($content);
    }

}
