<?php

namespace Grubitz;

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

class Application
{
    public function run()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../.env');

        $request = new Request();

        $router = new Router();
        $router->handleRequest($request);
    }
}
