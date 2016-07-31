<?php

namespace ThinFramework\Component\Container;

use Symfony\Component\Yaml\Parser;


class Container
{

    private $services;


    public function __construct($servicesPath)
    {
        $parser = new Parser();
        $this->services = $parser->parse( file_get_contents($servicesPath) );
    }


    public function get($serviceId)
    {
        $serviceAttributes = $this->services[$serviceId];

        $arguments = (isset($serviceAttributes['arguments']))
                      ? $this->getArguments($serviceAttributes['arguments'])
                      : [];

        return new $serviceAttributes['class'](...$arguments);
    }


    private function getArguments($argumentsList)
    {
        $serviceArguments = [];

        foreach ($argumentsList as $argument)
        {
            $arg = $argument;

            $firstChar = substr($argument, 0, 1);
            if ($firstChar === '@')
            {
                $arg = $this->get( substr($argument, 1) );
            }

            array_push($serviceArguments, $arg);
        }

        return $serviceArguments;
    }

}
