<?php

namespace ThinFramework\Component\Templating;


interface TemplatingAdapter
{

    public function setLayout($templateName);

    public function setParam($paramKey, $paramValue);

    public function render();

}
