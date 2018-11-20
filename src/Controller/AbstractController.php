<?php

namespace Grubitz\Controller;

use Symfony\Component\HttpFoundation\Request;
use Philo\Blade\Blade;

abstract class AbstractController
{
    protected $request;
    protected $routeInfo;
    protected $variables = [];

    public function __construct(Request $request, array $routeInfo)
    {
        $this->request = $request;
        $this->routeInfo = $routeInfo;
        $this->initCommonVariables();
    }

    protected function initCommonVariables()
    {
    }

    protected function render($template)
    {
        $views = __DIR__ . '/../views';
        $cache = __DIR__ . '/../../var/cache';

        $blade = new Blade($views, $cache);
        echo $blade->view()->make($template, $this->variables)->render();
    }
}
