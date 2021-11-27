<?php

namespace middleware;

use core\Request;
use core\Response;
use middleware\Middleware;

class RequireSameUserJSON extends Middleware
{
    public string $check;

    public function __construct(string $check)
    {
        $this->check = $check;
    }

    public function handle(Request $request, Response $response)
    {
        if (!isset($_SESSION['user_id']) || $_SESSION["user_id"] !== $this->check) 
        {
            $response->code(400);
            $response->json([ "successful" => false, "message" => "Invalid Request" ]);
        }
    }
}
