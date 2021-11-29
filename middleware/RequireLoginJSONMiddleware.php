<?php

namespace middleware;

use core\Request;
use core\Response;
use middleware\Middleware;

class RequireLoginJSONMiddleware extends Middleware 
{
    public function handle(Request $request, Response $response)
    {
        if (($_SESSION['user_logged_in'] ?? false) !== true) 
        {
            $response->code(401);
            $response->json([ "successful" => false, "message" => "You haven't logged in to perform this action" ]);
        }
    }
}