<?php

namespace controller;

use model\UserModel;

class Auth extends Controller
{
    public function get_login()
    {
        if ($_SESSION["user_logged_in"] ?? false === true) {
            $this->response->redirect("/user");
        }
        $this->view('auth/login');
    }

    public function post_login()
    {
        $username = $this->request->get_body()["username"];
        $password = $this->request->get_body()["password"];
        $message = UserModel::find_user_by_username_and_password($username, $password);
        if (!$message["is_successful"]) {
            $this->view("auth/login", ["is_login_successful" => false, "message" => $message["message"]]);
            return;
        }
        $user = $message["user"];
        if (!$user || $user->is_deleted) {
            $this->view("auth/login", ["is_login_successful" => false, "message" => "This account has been deleted"]);
            return;
        }
        $_SESSION["user_logged_in"] = true;
        $_SESSION["user_id"] = $user->id;
        return $this->response->redirect("/user");
    }

    public function post_logout()
    {
        unset($_SESSION['user_logged_in']);
        unset($_SESSION["user_id"]);
        $this->response->redirect('/login');
    }

    public function get_register()
    {
        $this->view('auth/register');
    }

    public function post_register()
    {
        $user = new UserModel();
        $res = $user->validate_and_load($this->request->get_body());
        if (!$res["is_successful"]) {
            $this->view("auth/register", ["is_register_successful" => false, "message" => $res["message"], "user" => $this->request->get_body()]);
            return;
        }
        $exist = UserModel::find_user_by_username($user->username);
        if ($exist) {
            $this->view("auth/register", ["is_register_successful" => false, "message" => "Username already exists", "user" => $user]);
            return;
        }
        $user = $user->insert();
        if (!$user) {
            $this->view("auth/register", ["is_register_successful" => false, "message" => "Unable to register your account", "user" => $user]);
            return;
        }
        $this->view("auth/register", ["is_register_successful" => true, "message" => $res["message"], "user" => $user]);
    }

    public function admin_get_login()
    {
        if ($_SESSION["admin_logged_in"] ?? false == true) {
            $this->response->redirect("/admin");
        }
        $this->view('admin/auth/login', [], "admin");
    }

    public function admin_post_login()
    {
        $username = $this->request->get_body()["username"];
        $password = $this->request->get_body()["password"];
        $message = UserModel::find_user_by_username_and_password($username, $password);
        if (!$message["is_successful"]) {
            $this->view("admin/auth/login", ["is_login_successful" => false, "message" => $message["message"]], "admin");
            return;
        }
        $user = $message["user"];
        if (!$user || $user->is_deleted) {
            $this->view("admin/auth/login", ["is_login_successful" => false, "message" => "This account has been deleted"], "admin");
            return;
        }
        if ($user->role !== "ADMIN") {
            $this->view("admin/auth/login", ["is_login_successful" => false, "message" => "This account does not have access to this site"], "admin");
            return;
        }
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_id"] = $user->id;
        return $this->response->redirect("/admin");
    }

    public function admin_post_logout()
    {
        unset($_SESSION["admin_logged_in"]);
        unset($_SESSION["admin_id"]);
        $this->response->redirect("/admin/login");
    }
}
