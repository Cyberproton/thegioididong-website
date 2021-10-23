<?php

namespace controller;

class Auth extends Controller 
{
    public function get_login() 
    {
        $this->view('login');
    }

    public function post_login()
    {
        $_SESSION['user_logged_in'] = true;
        $this->response->redirect('/');
    }

    public function post_logout()
    {
        unset($_SESSION['user_logged_in']);
        $this->response->redirect('/login');
    }

    public function get_register()
    {

    }

    public function post_register()
    {

    }
}