<?php

namespace controller;

class User extends Controller 
{
    public function index()
    {
        $this->view('user/user');
    }
}