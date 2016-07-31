<?php

namespace ThinFramework\Component\Templating;


class TwigAdapter implements TemplatingAdapter
{

    private $twig;
    private $templateName;
    private $templateParams;


    public function __construct($templatingPath)
    {
        $loader     = new \Twig_Loader_Filesystem($templatingPath);
        $this->twig = new \Twig_Environment($loader);
    }


    public function setLayout($templateName)
    {
        $this->templateName = $templateName;
    }


    public function setParam($paramKey, $paramValue)
    {
        $this->templateParams[$paramKey] = $paramValue;
    }


    public function render()
    {
        return $this->twig->render($this->templateName, $this->templateParams);
    }

}
