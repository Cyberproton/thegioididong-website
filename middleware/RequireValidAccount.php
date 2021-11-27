<?php

namespace middleware;

use core\Request;
use core\Response;
use middleware\Middleware;
use model\UserModel;

class RequireValidAccount extends Middleware
{
    public function handle(Request $request, Response $response)
    {
        if (!isset($_SESSION['user_id'])) 
        {
            unset($_SESSION['user_logged_in']);
            unset($_SESSION["user_id"]);
            $response->redirect('/account-not-exists');
        }
        $user = UserModel::find_user_by_id($_SESSION["user_id"]);
        if ($user === null || $user->is_deleted === true)
        {
            unset($_SESSION['user_logged_in']);
            unset($_SESSION["user_id"]);
            $response->redirect('/account-not-exists');
        }
    }
}
