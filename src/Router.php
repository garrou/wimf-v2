<?php

namespace App;

use AltoRouter;
use App\Exceptions\ForbiddenException;

class Router
{
    private string $view_path;

    public string $layout;

    private AltoRouter $router;

    public function __construct(string $view_path)
    {
        $this->view_path = $view_path;
        $this->router = new AltoRouter();
        $this->layout = 'layout/home';
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }
    
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }
    
    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }
    
    public function run(): self
    {
        $match = $this->router->match();
        $router = $this;

        if ($match === false) {
            ob_start();
            require $this->view_path . DIRECTORY_SEPARATOR . '404.php';
            $content = ob_get_clean();
            require $this->view_path . DIRECTORY_SEPARATOR . $this->layout . '.php';
            exit();
        }
        $view = $match['target'];
        $params = $match['params'];
        $this->layout = $view === '/index' || strpos($view, '/auth') !== false 
            ? 'layout/home' 
            : 'layout/account';
        
        try {
            ob_start();
            require $this->view_path . $view . '.php';
            $content = ob_get_clean();
            require $this->view_path . DIRECTORY_SEPARATOR . $this->layout . '.php';
        } catch (ForbiddenException $e) {
            http_response_code(301);
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }
        return $this;
    }
    
    public function url(string $name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }
}