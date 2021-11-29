<?php

namespace controller;

use model\UserModel;

class User extends Controller
{
    public array $valid_roles = ["CUSTOMER", "ADMIN"];

    public function get_user()
    {
        $user_id = $_SESSION["user_id"];
        if ($user_id == null) {
            $this->response->redirect("/login");
        }
        $user = UserModel::find_user_by_id($user_id);
        //$user = null;
        $this->view('user/user', ["user" => $user]);
    }

    public function post_user()
    {
        $user_id = $_SESSION["user_id"];
        if ($user_id == null) {
            $this->response->redirect("/login");
        }
        $data = $this->request->get_body();
        $res = UserModel::validate_profile($data);
        if (!$res["is_successful"]) {
            $this->view("user/user", ["is_successful" => false, "message" => $res["message"]]);
            return;
        }
        $name = $data["name"] ?? null;
        $address = $data["address"] ?? null;
        $phone = $data["phone"] ?? null;
        $date_of_birth = $data["date_of_birth"] ?? null;
        $user = UserModel::update_user($user_id, $name, $phone, $address, $date_of_birth);
        $this->view('user/user', ["is_successful" => true, "message" => $res["message"], "user" => $user]);
    }

    public function get_admin_users()
    {
        $users = UserModel::find();
        $this->view("admin/user/users", ["users" => $users], "admin");
    }

    public function get_admin_user()
    {
        $id = $this->request->get_params()["id"];
        $user = UserModel::find_user_by_id($id);
        $this->view("admin/user/user", ["user" => $user], "admin");
    }

    public function admin_get_add_user()
    {
        $this->view("admin/user/add-user", [], "admin");
    }

    public function admin_post_add_user()
    {
        $user = new UserModel();
        $res = $user->validate_and_load($this->request->get_body());
        if (!$res["is_successful"]) {
            $this->view("admin/user/add-user", ["successful" => false, "message" => $res["message"], "user" => $this->request->get_body()], "admin");
            return;
        }
        $exist = UserModel::find_user_by_username($user->username);
        if ($exist) {
            $this->view("admin/user/add-user", ["successful" => false, "message" => "Username already exists", "user" => $user], "admin");
            return;
        }
        $user = $user->insert();
        if (!$user) {
            $this->view("admin/user/add-user", ["successful" => false, "message" => "Unable to register your account", "user" => $user], "admin");
            return;
        }
        $this->view("admin/user/add-user", ["successful" => true, "message" => $res["message"], "user" => $user], "admin");
    }

    public function admin_post_user()
    {
        $body = $this->request->get_body();
        $user_id = $this->request->get_params()["id"] ?? null;
        if ($user_id === null) {
            $this->view("admin/user/user", ["successful" => false, "message" => "Invalid request"], "admin");
            return;
        }
        $data = $this->request->get_body();
        $res = UserModel::validate_profile($data);
        if (!$res["is_successful"]) {
            $user = UserModel::find_user_by_id($user_id);
            $this->view("admin/user/user", ["successful" => false, "message" => $res["message"], "user" => $user], "admin");
            return;
        }
        $name = $data["name"] ?? null;
        $address = $data["address"] ?? null;
        $phone = $data["phone"] ?? null;
        $date_of_birth = $data["date_of_birth"] ?? null;
        $user = UserModel::update_user($user_id, $name, $phone, $address, $date_of_birth);
        $this->view('admin/user/user', ["successful" => true, "message" => $res["message"], "user" => $user], "admin");
    }

    public function admin_delete_user()
    {
        $id = $this->request->get_body()["user_id"] ?? -1;
        if ($id === -1) {
            $this->view("admin/user/delete-user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        $user = UserModel::delete_user($id);
        if (!$user) {
            $this->view("admin/user/delete-user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        if (!$user->is_deleted) {
            $this->view("admin/user/delete-user", ["successful" => false, "message" => "Server error. Could not delete user"], "admin");
            return;
        }
        $current_admin_id = $_SESSION["admin_id"] ?? null;
        $current_user_id = $_SESSION["user_id"] ?? null;
        if ($user->id === $current_admin_id) {
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION["admin_id"]);
            $this->response->redirect("/admin/login");
        }
        if ($user->id === $current_user_id) {
            unset($_SESSION['user_logged_in']);
            unset($_SESSION["user_id"]);
            $this->response->redirect("/login");
        }
        $this->view("admin/user/delete-user", ["successful" => true, "message" => "User deleted successfully"], "admin");
    }

    public function admin_update_password()
    {
        $id = $this->request->get_body()["user_id"] ?? -1;
        $password = $this->request->get_body()["password"] ?? null;
        if ($id === -1) {
            $this->view("admin/user/user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        $res = UserModel::validate_password($password);
        $user = UserModel::find_user_by_id($id);
        if (!$res["is_successful"]) {
            $this->view("admin/user/user", ["successful" => false, "message" => $res["message"], "user" => $user], "admin");
            return;
        }
        $user = UserModel::update_password($id, $password);
        if (!$user) {
            $this->view("admin/user/user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        $this->view("admin/user/user", ["successful" => true, "message" => "Password updated successfully", "user" => $user], "admin");
    }

    public function admin_update_role()
    {
        $id = $this->request->get_body()["user_id"] ?? -1;
        if ($id === -1) {
            $this->view("admin/user/user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        $role = $this->request->get_body()["role"] ?? "";
        $res = UserModel::validate_role($role);
        $user = UserModel::find_user_by_id($id);
        $prev_role = $user->role;
        if (!$res["is_successful"]) {
            $this->view("admin/user/user", ["successful" => false, "message" => $res["message"], "user" => $user], "admin");
            return;
        }
        $user = UserModel::update_role($id, $role);
        if (!$user) {
            $this->view("admin/user/user", ["successful" => false, "message" => "User does not exist"], "admin");
            return;
        }
        $current_admin_id = $_SESSION["admin_id"] ?? null;
        if ($user->role === "CUSTOMER" && $user->id === $current_admin_id) {
            unset($_SESSION['admin_logged_in']);
            unset($_SESSION["admin_id"]);
            $this->response->redirect("/admin/login");
        }
        $this->view("admin/user/user", ["successful" => true, "message" => "Role updated successfully", "user" => $user], "admin");
    }
}
