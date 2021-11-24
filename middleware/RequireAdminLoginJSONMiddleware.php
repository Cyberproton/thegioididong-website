<?php

namespace middleware;

use core\Request;
use core\Response;
use middleware\Middleware;

class RequireAdminLoginJSONMiddleware extends Middleware 
{
    public function handle(Request $request, Response $response)
    {
        if ($_SESSION['admin_logged_in'] ?? false !== true) 
        {
            //$response->code(401);
            //$response->json([ "successful" => false, "message" => "Not Authorized" ]);
        }
    }
}