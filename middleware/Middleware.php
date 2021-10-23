<?php 

namespace middleware;

use core\Request;
use core\Response;

abstract class Middleware 
{
    public abstract function handle(Request $request, Response $response);
}