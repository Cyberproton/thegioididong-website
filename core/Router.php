<?php

namespace core;

use middleware\Middleware;

class Router 
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    private const METHOD_PUT = 'PUT';
    private const METHOD_DELETE = 'DELETE';
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $handler, ...$handlers) 
    {
        $this->add_handler(self::METHOD_GET, $this->get_path($path), $handler, ...$handlers);
    }

    public function post(string $path, $handler, ...$handlers) 
    {
        $this->add_handler(self::METHOD_POST, $this->get_path($path), $handler, ...$handlers);
    }

    public function put(string $path, $handler, ...$handlers) 
    {
        $this->add_handler(self::METHOD_PUT, $this->get_path($path), $handler, ...$handlers);
    }

    public function delete(string $path, $handler, ...$handlers) 
    {
        $this->add_handler(self::METHOD_DELETE, $this->get_path($path), $handler, ...$handlers);
    }

    public function use($middleware)
    {
        $this->routes[] = $middleware;
    }

    public function resolve() 
    {
        $method = $this->request->get_method();
        $path = $this->request->get_path();
        foreach ($this->routes as $route)
        {
            if (is_array($route) && $route['method'] === $method && $route['path'] === $path) 
            {
                foreach ($route['handlers'] as $handler) 
                {
                    $this->run_handler($handler);
                }
                break;
            }
            else if (is_callable($route))
            {
                $this->run_handler($route);
            }
            else if ($route instanceof Middleware)
            {
                $this->run_handler($route);
            }
        }
    }

    private function run_handler($handler)
    {
        // Handler is function
        if (is_callable($handler)) 
        {
            call_user_func($handler, $this->request, $this->response);
        }
        // Handler is controller
        else if (is_array($handler))
        {
            if (class_exists($handler[0])) 
            {
                $controller = new $handler[0]($handler[1], $this->request, $this->response);
                $handler[0] = $controller;
                call_user_func($handler);
            }
        } 
        // Handler is middleware
        else if ($handler instanceof Middleware)
        {
            $handler->handle($this->request, $this->response);
        }
    }

    private function add_handler(string $method, string $path, ...$handlers) 
    {
        $this->routes[] = [
            'path' => $path,
            'method' => $method,
            'handlers' => $handlers,
        ];
    }

    private function get_path(string $path)
    {
        $uri = preg_replace('/\/+/', '/', trim(str_replace('.', '-', parse_url($path ?? "/", PHP_URL_PATH)), '/'));
        $uri = $uri ? explode('/', $uri) : [];
        if(count($uri) == 0) $uri[] = '/';
        return implode('/', $uri);
    }
}
