<?php

namespace middleware;

use core\Request;
use core\Response;
use middleware\Middleware;

class RequireLoginMiddleware extends Middleware 
{
    public function handle(Request $request, Response $response)
    {
        if ($_SESSION['user_logged_in'] !== true) 
        {
            $response->redirect('/login');
        }
    }
}