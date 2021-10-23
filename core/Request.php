<?php

namespace core;

class Request 
{
    public function get_path(): string
    {
        $uri = preg_replace('/\/+/', '/', trim(str_replace('.', '-', parse_url($_SERVER['REQUEST_URI'] ?? "/", PHP_URL_PATH)), '/'));
        $uri = $uri ? explode('/', $uri) : [];
        if(count($uri) == 0) $uri[] = '/';

        return implode('/', $uri);
    }

    public function get_method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function get_body(): array
    {
        $body = [];
        foreach ($_POST as $key => $value) 
        {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    public function get_params(): array
    {
        $params = [];
        foreach ($_GET as $key => $value) 
        {
            $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $params;
    }
}