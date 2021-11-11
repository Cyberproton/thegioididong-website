<?php 

namespace core;

class Response 
{
    public function code(int $code) 
    {
        http_response_code($code);
    }

    public function get_code()
    {
        return http_response_code();
    }

    public function redirect(string $url, int $code = 303)
    {
        header("Location: $url", true, $code);
        exit();
    }

    public function error() 
    {
        
    }

    public function json(array $data) 
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function view(string $view_name, array $data = [], ?string $layout_name = 'main')
    {
        View::render($view_name, $data, $layout_name);
    }
}