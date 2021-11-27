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
        if (!isset($_SESSION['admin_id'])) 
        {
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION["admin_id"]);
            $response->redirect('/account-not-exists');
        }
        $user = UserModel::find_user_by_id($_SESSION["admin_id"]);
        if ($user === null || $user->is_deleted === true)
        {
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION["admin_id"]);
            $response->redirect('/admin/account-not-exists');
        }
    }
}