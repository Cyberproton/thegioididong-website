<?php

namespace model;

use controller\Rating;
use core\Database;
use core\Response;

class RatingModel extends Model
{
    public const FIND_BY_ID = "SELECT * FROM rating WHERE id=?";
    public const FIND_BY_DEVICE_ID = "SELECT * FROM rating WHERE `device_id`=?";
    public const FIND_BY_USER_DEVICE = "SELECT * FROM rating WHERE `user_id`=? AND `device_id`=?";
    public const INSERT = "INSERT INTO rating(`value`,`content`,`user_id`,`device_id`) VALUES(?,?,?,?)";
    public const UPDATE_BY_USER = "UPDATE rating SET `value`=?,`content`=? WHERE `user_id`=? AND `device_id`=?";
    public const UPDATE_BY_ID = "UPDATE rating SET `value`=?,`content`=? WHERE `id`=?";
    public const DELETE_BY_ID = "DELETE FROM rating WHERE `id`=?";
    public const DELETE_BY_USER = "DELETE FROM rating WHERE `user_id`=? AND `device_id`=?";
    public int $id;
    public int $value;
    public ?string $content;
    public int $user_id;
    public int $device_id;
    public ?UserModel $user;

    public function insert(): ?RatingModel
    {
        $user_id = $_SESSION["user_id"] ?? null;
        return RatingModel::insert_rating($user_id, $this->device_id, $this->value, $this->content ?? null);
    }

    public function load_full()
    {
        $this->user = UserModel::find_user_by_id($this->user_id);
    }

    public function validate_data(array $data): array
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $device_id = $data["device_id"] ?? null;
        $value = $data["value"] ?? null;
        $content = $data["content"] ?? null;
        if (!is_numeric($device_id) || !is_int((int) $device_id)) {
            return Model::get_validation_message_static("Invalid Device", false);
        }
        if (!is_numeric($value) || !is_int((int) $value) || ((int) $value) < 1 || ((int) $value) > 5) {
            return Model::get_validation_message_static("Invalid Rating", false);
        }
        return Model::get_validation_message_static("Success", true);
    }

    public static function find_by_id(int $id): ?RatingModel
    {
        $stmt = Database::connection()->prepare(RatingModel::FIND_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return null;
        }
        $model = new RatingModel();
        $model->load($res->fetch_assoc());
        $model->load_full();
        return $model;
    }

    public static function find_by_device(int $id): array
    {
        $stmt = Database::connection()->prepare(RatingModel::FIND_BY_DEVICE_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return [];
        }
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $model = new RatingModel();
            $model->load($row);
            $model->load_full();
            $data[] = $model;
        }
        return $data;
    }

    public static function find_by_user_device(int $user_id, int $device_id): ?RatingModel
    {
        $stmt = Database::connection()->prepare(RatingModel::FIND_BY_USER_DEVICE);
        $stmt->bind_param("ii", $user_id, $device_id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if (!$res) {
            return null;
        }
        $model = new RatingModel();
        $model->load($res);
        $model->load_full();
        return $model;
    }

    public static function insert_rating(int $user_id, int $device_id, int $value, string $content): ?RatingModel
    {
        $res = RatingModel::find_by_user_device($user_id, $device_id);
        if ($res) {
            return RatingModel::update_rating_by_id($res->id, $value, $content);
        }
        $stmt = Database::connection()->prepare(RatingModel::INSERT);
        $stmt->bind_param("isii", $value, $content, $user_id, $device_id);
        $stmt->execute();
        $res = $stmt->get_result();
        return RatingModel::find_by_id(Database::connection()->insert_id);
    }

    public static function update_rating_by_id(int $id, int $value, string $content): ?RatingModel {
        $stmt = Database::connection()->prepare(RatingModel::UPDATE_BY_ID);
        $stmt->bind_param("isi", $value, $content, $id);
        $stmt->execute();
        return RatingModel::find_by_id($id);
    }

    public static function update_rating_by_user(int $user_id, int $device_id): ?RatingModel
    {
        $stmt = Database::connection()->prepare(RatingModel::UPDATE_BY_USER);
        $stmt->bind_param("ii", $user_id, $device_id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if (!$res) {
            return null;
        }
        $model = new RatingModel();
        $model->load($res);
        $model->load_full();
        return $model;
    }
}
