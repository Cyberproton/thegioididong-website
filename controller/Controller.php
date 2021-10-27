<?php

namespace controller;

use core\Database;
use core\Request;
use core\Response;
use core\View;
use mysqli;

class Controller
{
    protected mysqli $database;
    protected Request $request;
    protected Response $response;
    protected string $action;

    public function __construct(string $action, Request $request, Response $response)
    {
        $this->database = Database::connection();
        $this->action = $action;
        $this->request = $request;
        $this->response = $response;
    }

    protected function view(string $view_name, array $data = [], ?string $layout_name = 'main') 
    {
        $data['body'] = $this->request->get_body();
        $data['params'] = $this->request->get_params();
        View::render($view_name, $data, $layout_name);
    }

    protected function model($model_name) 
    {
        include_once PATH_ROOT.'/model/'.$model_name.'.php';
    }
}