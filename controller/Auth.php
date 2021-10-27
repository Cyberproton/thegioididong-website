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
        $statement = $this->database->prepare('INSERT INTO users(username,password) VALUES(?,?)');
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
        $this->view('auth/register');
    }

    public function post_register()
    {

    }
}