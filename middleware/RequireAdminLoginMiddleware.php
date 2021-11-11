<?php

namespace middleware;

use core\Request;
use core\Response;

class RequireAdminLoginMiddleware extends Middleware 
{
    public function handle(Request $request, Response $response)
    {
        /*
        if ($_SESSION['user_logged_in'] !== true) 
        {
            $response->redirect('/admin/login');
        }
        */
    }
}