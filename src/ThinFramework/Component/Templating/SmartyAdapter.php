<?php

namespace ThinFramework\Component\Templating;


class SmartyAdapter implements TemplatingAdapter
{

    private $smarty;
    private $templateName;
    private $templateParams;


    public function __construct($templatingPath)
    {
        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir($templatingPath);
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
        $this->smarty->assign($this->templateParams);
        return $this->smarty->fetch($this->templateName);
    }

}
