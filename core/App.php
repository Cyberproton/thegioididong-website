<?php

namespace core;

class App 
{
    public static App $instance;
    public Router $router;
    public Request $request;
    public Response $reponse;

    public function __construct()
    {
        self::$instance = $this;
        $this->request = new Request();
        $this->reponse = new Response();
        $this->router = new Router($this->request, $this->reponse);
        session_start();
    }

    public function run() {
        $this->router->resolve();
    }
}