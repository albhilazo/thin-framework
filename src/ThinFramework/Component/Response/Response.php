<?php

namespace ThinFramework\Component\Response;


class Response
{

    private $content;


    public function __construct($content)
    {
        $this->content = $content;
    }


    public function appendContent($content)
    {
        $this->content .= $content;
    }


    public function send()
    {
        echo $this->content;
    }

}
