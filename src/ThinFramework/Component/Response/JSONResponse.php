<?php

namespace ThinFramework\Component\Response;


class JSONResponse extends Response
{

    private $content;


    public function send()
    {
        header('Content-Type: application/json');
        $jsonContent = json_encode($this->content);
        echo $jsonContent;
    }

}
