<?php

namespace ThinFramework\Component\Response;


class JSONResponse extends Response
{

    private $content;


    public function send()
    {
        $this->setHeader('Content-Type', 'application/json');
        $this->sendHeaders();
        $jsonContent = json_encode($this->content);
        echo $jsonContent;
    }

}
