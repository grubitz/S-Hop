<?php

namespace Grubitz;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    private $routes = [
        '^/c/([1-9][0-9]*)$' => ['Categories', 'show'],
        '^/p/([1-9][0-9]*)$' => ['Products', 'show'],
        '/' => ['Home', 'show']
    ];

    public function handleRequest(Request $request)
    {
        foreach ($this->routes as $route => $callable) {
            if (!preg_match("#{$route}#", $_SERVER['REQUEST_URI'], $matches)) {
                continue;
            }

            $className = "Grubitz\\Controller\\{$callable[0]}Controller";
            $methodName = $callable[1];
            $controller = new $className($request, $matches);
            $controller->$methodName();
            return;
        }

        $response = new Response('', Response::HTTP_NOT_FOUND);
        $response->send();
    }
}
