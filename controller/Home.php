<?php

namespace controller;

class Home extends Controller
{
    public function index()
    {
        $this->view('index', [ 'demo' => 'sfddfdfsdf', 'test' => 'Test' ], 'mylayout');
    }

    public function you() {
        echo 'Hello you';
    }
}