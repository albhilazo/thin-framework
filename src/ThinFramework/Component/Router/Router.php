<?php

namespace ThinFramework\Component\Router;

use Symfony\Component\Yaml\Parser;
use ThinFramework\Component\Request\Request;


class Router
{

    const PATH_PARAM_REGEX = "/^{(.*)}$/";

    private $routes;


    public function __construct($routingPath)
    {
        $parser = new Parser();
        $this->routes = $parser->parse( file_get_contents($routingPath) );
    }


    public function getRoute(Request $request)
    {
        foreach ($this->routes as $routeId => $routeAttributes)
        {
            $route = $this->checkIfConfiguredRoute($request->path(), $routeId);

            if (!isset($route))
            {
                continue;
            }

            return $route;
        }
    }


    private function checkIfConfiguredRoute($path, $routeId)
    {
        $routeAttributes = $this->routes[$routeId];

        if ($this->routeHasNoPath($routeAttributes))
        {
            return;
        }

        $explodedConfiguredPath = $this->explodePath($routeAttributes['path']);
        $explodedReceivedPath   = $this->explodePath($path);

        $configuredPathSize = count($explodedConfiguredPath);
        $receivedPathSize   = count($explodedReceivedPath);

        if ($this->pathSizeDoesNotMatch($configuredPathSize, $receivedPathSize))
        {
            return;
        }

        $pathMatches = true;
        $parameters  = array();
        for ($pathIndex = 0; $pathIndex < $configuredPathSize; $pathIndex++)
        {
            if (preg_match(self::PATH_PARAM_REGEX, $explodedConfiguredPath[$pathIndex], $parameterName))
            {
                $parameters[$parameterName[1]] = $explodedReceivedPath[$pathIndex];
                continue;
            }

            if ($this->pathSectionDoesNotMatch(
                $explodedConfiguredPath[$pathIndex],
                $explodedReceivedPath[$pathIndex]
            ))
            {
                $pathMatches = false;
                break;
            }
        }

        if ($pathMatches)
        {
            $route = array();

            $route['route_id']   = $routeId;
            $route['attributes'] = $routeAttributes;

            if ($this->pathHasParameters($parameters))
            {
                $route['parameters'] = $parameters;
            }

            return $route;
        }
    }


    private function routeHasNoPath($route)
    {
        return !isset($route['path']);
    }


    private function explodePath($path)
    {
        $explodedPath = explode('/', $path);
        array_shift($explodedPath);

        return $explodedPath;
    }


    private function pathSizeDoesNotMatch($oneSize, $anotherSize)
    {
        return $oneSize !== $anotherSize;
    }


    private function pathSectionDoesNotMatch($oneSection, $anotherSection)
    {
        return $oneSection !== $anotherSection;
    }


    private function pathHasParameters($parameters)
    {
        return !empty($parameters);
    }

}
