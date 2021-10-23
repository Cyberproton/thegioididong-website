<?php

namespace controller;

class Home extends Controller
{
    public function index()
    {
        $this->view('index', [ 'title' => 'Home' ]);
    }

    public function you() {
        echo 'Hello you';
    }
}