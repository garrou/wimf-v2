<?php

namespace App\Html;

use App\Router;

class Nav
{
    private Router $router;

    private mixed $view;

    public function __construct(Router $router, mixed $view)
    {
        $this->router = $router;    
        $this->view = $view;
    }

    public function link(string $name, string $route): string
    {
        $active = strpos($this->view, $route) !== false ? 'active' : '';

        return <<<HTML
            <li class="nav-item">
                <a class="nav-link $active" href="{$this->router->url($route)}">$name</a>
            </li>
        HTML;
    }
}
