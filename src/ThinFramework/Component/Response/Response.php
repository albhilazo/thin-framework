<?php

namespace ThinFramework\Component\Response;


class Response
{

    private $content;
    private $headers;


    public function __construct($content)
    {
        $this->content = $content;
    }


    public function appendContent($content)
    {
        $this->content .= $content;
    }


    public function setHeader($headerType, $headerValue)
    {
        $this->headers[$headerType] = $headerValue;
    }


    public function send()
    {
        $this->sendHeaders();
        echo $this->content;
    }


    protected function sendHeaders()
    {
        foreach ($this->headers as $headerType => $headerValue) {
            header($headerType.": ".$headerValue);
        }
        http_response_code(200);
    }

}
