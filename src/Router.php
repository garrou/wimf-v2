<?php

namespace App;

use AltoRouter;
use App\Exceptions\ForbiddenException;

class Router
{
    private string $view_path;

    public string $layout = 'layout/home';

    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * @param  string $view_path path the the view folder
     * @return void
     */
    public function __construct(string $view_path)
    {
        $this->view_path = $view_path;
        $this->router = new AltoRouter();
    }

    /**
     * @param  string $url in web page
     * @param  string $view path to the view folder
     * @param  string $name name of path
     * @return self fluent method
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }
    
    /**
     * @param  string $url in web page
     * @param  string $view path to the view folder
     * @param  string $name of path
     * @return self fluent method
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }
    
    /**
     * @param  string $url in web page
     * @param  string $view path to view folder
     * @param  string $name url name
     * @return self fluent method
     */
    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }
    
    /**
     * @return self
     */
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
    
    /**
     * @param  string $name name of url
     * @param  string $params share params
     * @return string url
     */
    public function url(string $name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }
}