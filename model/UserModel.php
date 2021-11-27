<?php

namespace model;

use core\Database;

class UserModel extends Model
{
    public const FIND_ALL = "SELECT * FROM user";
    public const FIND_USER_BY_ID = "SELECT * FROM user WHERE id=?";
    public const FIND_USER_BY_USERNAME = "SELECT * FROM user WHERE username=?";
    public const FIND_USER_BY_USERNAME_AND_PASSWORD = "SELECT * FROM user WHERE username=? AND password=?";
    public const INSERT_USER = "INSERT INTO user(`username`,`password`,`name`,`address`,`phone`,`date_of_birth`,`role`) VALUES(?,?,?,?,?,?,?)";
    public const UPDATE_USER = "UPDATE user SET `name`=?,`phone`=?,`address`=?,`date_of_birth`=? WHERE id=?";
    public const UPDATE_PASSWORD = "UPDATE user SET `password`=? WHERE id=?";
    public const UPDATE_ROLE = "UPDATE user SET `role`=? WHERE id=?";
    public const DELETE_USER = "UPDATE user SET `is_deleted`=1 WHERE id=?";
    public const VALID_ROLES = [ "CUSTOMER", "ADMIN" ];

    public int $id;
    public string $username;
    public string $password;
    public ?string $name;
    public ?string $address;
    public ?string $phone;
    public ?string $date_of_birth;
    public string $role = "CUSTOMER";
    public bool $is_deleted;

    public function insert(): ?UserModel
    {
        return UserModel::insert_user($this->username, $this->password, $this->name, $this->phone, $this->address, $this->date_of_birth, $this->role);
    }

    public function validate_data(array $data): array
    {
        $username = $data["username"] ?? null;
        $password = $data["password"] ?? null;
        $name = $data["name"] ?? null;
        $address = $data["address"] ?? null;
        $phone = $data["phone"] ?? null;
        $date_of_birth = $data["date_of_birth"] ?? null;
        if (!$username || strlen($username) < 6)
        {
            return $this->get_validation_message("Invalid username", false);
        }
        if (!$password || strlen($password) < 6)
        {
            return $this->get_validation_message("Invalid password", false);
        }
        if ($name)
        {
            if (!preg_match("/[a-zA-Z ]{1,}/", $name))
            {
                return $this->get_validation_message("Invalid full name", false);
            }
        }
        if ($phone)
        {
            if (!preg_match("/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/", $phone))
            {
                return $this->get_validation_message("Invalid phone number", false);
            }
        }
        if ($address)
        {
            if (!preg_match("/[a-zA-Z0-9-_.]/", $address))
            {
                return $this->get_validation_message("Invalid address", false);
            }
        }
        if ($date_of_birth)
        {
            if (!preg_match("/^([0-2][0-9]|(3)[0-1])([\/-])(((0)[0-9])|((1)[0-2]))([\/-])\d{4}$/", $date_of_birth))
            {
                return $this->get_validation_message("Invalid date", false);
            }
        }
        return $this->get_validation_message("Done", true);
    }

    public static function validate_profile(array $data)
    {
        $name = $data["name"] ?? null;
        $address = $data["address"] ?? null;
        $phone = $data["phone"] ?? null;
        $date_of_birth = $data["date_of_birth"] ?? null;
        if ($name)
        {
            if (!preg_match("/[a-zA-Z ]{1,}/", $name))
            {
                return Model::get_validation_message_static("Invalid full name", false);
            }
        }
        if ($phone)
        {
            if (!preg_match("/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/", $phone))
            {
                return Model::get_validation_message_static("Invalid phone number", false);
            }
        }
        /*
        if ($address)
        {
            if (!preg_match("/[a-zA-Z0-9-_.]/", $address))
            {
                return Model::get_validation_message_static("Invalid address", false);
            }
        }*/
        if ($date_of_birth)
        {
            if (!preg_match("/^([0-2][0-9]|(3)[0-1])([\/-])(((0)[0-9])|((1)[0-2]))([\/-])\d{4}$/", $date_of_birth))
            {
                return Model::get_validation_message_static("Invalid date", false);
            }
        }
        return Model::get_validation_message_static("Done", true);
    }

    public static function validate_password(string $password): array
    {
        if (!$password || strlen($password) < 6)
        {
            return Model::get_validation_message_static("Invalid password", false);
        }
        return Model::get_validation_message_static("Done", true);
    }

    public static function validate_role(string $role): array
    {
        if (!in_array($role, UserModel::VALID_ROLES))
        {
            return Model::get_validation_message_static("Invalid role", false);
        }
        return Model::get_validation_message_static("Done", true);
    }

    public static function find(): array
    {
        $res = Database::connection()->query(UserModel::FIND_ALL);
        while ($row = $res->fetch_assoc())
        {
            $model = new UserModel();
            $model->load($row);
            $data[] = $model;
        }
        return $data;
    }

    public static function find_user_by_username_and_password(string $username, string $password): array
    {
        if (!$username || strlen($username) < 6 || strlen($username) > 20)
        {
            return Model::get_validation_message_static("Username must be 6-20 characters long", false);
        }
        if (!$password || strlen($password) < 6 || strlen($username) > 20)
        {
            return Model::get_validation_message_static("Password must be 6-20 characters long", false);
        }
        $stmt = Database::connection()->prepare(UserModel::FIND_USER_BY_USERNAME_AND_PASSWORD);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        if (!$data)
        {
            return Model::get_validation_message_static("Username or password is not correct", false);
        }
        $res = Model::get_validation_message_static("Done", true);
        $user = new UserModel();
        $user->load($data);
        unset($user->$password);
        $res["user"] = $user;
        return $res;
    }

    public static function find_user_by_username(string $username): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::FIND_USER_BY_USERNAME);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        if (!$data)
        {
            return null;
        }
        $user = new UserModel();
        $user->load($data);
        unset($user->password);
        return $user;
    }

    public static function find_user_by_id(int $id): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::FIND_USER_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        if (!$data)
        {
            return null;
        }
        $user = new UserModel();
        $user->load($data);
        unset($user->password);
        return $user;
    }

    public static function insert_user(string $username, string $password, string $name, string $phone, string $address, string $date_of_birth, string $role): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::INSERT_USER);
        $date = $date_of_birth == "" ? null : $date_of_birth;
        if ($date_of_birth)
        {
            $date = strtotime($date_of_birth);
            $date = date("Y-m-d", $date);
        }
        $stmt->bind_param("sssssss", $username, $password, $name, $phone, $address, $date, $role);
        $stmt->execute();
        $id = Database::connection()->insert_id;
        return UserModel::find_user_by_id($id);
    }

    public static function update_user(int $id, string $name, string $phone, string $address, string $date_of_birth): ?UserModel
    {
        $date = $date_of_birth == "" ? null : $date_of_birth;
        if ($date_of_birth)
        {
            $date = strtotime($date_of_birth);
            $date = date("Y-m-d", $date);
        }
        $stmt = Database::connection()->prepare(UserModel::UPDATE_USER);
        $stmt->bind_param("ssssi", $name, $phone, $address, $date, $id);
        $stmt->execute();
        return UserModel::find_user_by_id($id);
    }

    public static function delete_user(int $id): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::DELETE_USER);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return UserModel::find_user_by_id($id);
    }

    public static function update_password(int $id, string $password): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::UPDATE_PASSWORD);
        $stmt->bind_param("si", $password, $id);
        $stmt->execute();
        return UserModel::find_user_by_id($id);
    }

    public static function update_role(int $id, string $role): ?UserModel
    {
        $stmt = Database::connection()->prepare(UserModel::UPDATE_ROLE);
        $stmt->bind_param("si", $role, $id);
        $stmt->execute();
        return UserModel::find_user_by_id($id);
    }
}