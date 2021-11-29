<?php

namespace model;

use core\Database;

class CartModel extends Model
{
    public const GET_CART_BY_USER = "SELECT * FROM cart WHERE `user_id`=?";
    public const GET_CART_BY_USER_AND_DEVICE = "SELECT * FROM cart WHERE `user_id`=? AND `device_id`=?";
    public const INSERT_CART = "INSERT INTO cart(`user_id`,`device_id`,`quantity`) VALUES(?,?,?)";
    public const UPDATE_CART = "UPDATE cart SET `quantity`=? WHERE `user_id`=? AND `device_id`=?";
    public const REMOVE_CART = "DELETE FROM cart WHERE `user_id`=? AND `device_id`=?";
    public const REMOVE_ALL_ITEMS = "DELETE FROM cart WHERE `user_id`=?";
    public int $id;
    public int $user_id;
    public int $device_id;
    public int $quantity;
    public ?DeviceModel $device;

    public function get_device_full()
    {
        $this->device = DeviceModel::get_device($this->device_id);
    }

    public static function get_carts(int $user_id): array
    {
        $stmt = Database::connection()->prepare(CartModel::GET_CART_BY_USER);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return [];
        }
        $carts = [];
        while ($row = $res->fetch_assoc()) {
            $model = new CartModel();
            $model->load($row);
            $model->get_device_full();
            $carts[] = $model;
        }
        return $carts;
    }

    public static function get_cart_by_username_and_device(int $user_id, int $device_id): ?CartModel
    {
        $stmt = Database::connection()->prepare(CartModel::GET_CART_BY_USER_AND_DEVICE);
        $stmt->bind_param("ii", $user_id, $device_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return null;
        }
        $row = $res->fetch_assoc();
        if (!$row) {
            return null;
        }
        $model = new CartModel();
        $model->load($row);
        return $model;
    }

    public static function insert_cart(int $user_id, int $device_id, int $quantity)
    {
        $ex = CartModel::get_cart_by_username_and_device($user_id, $device_id);
        if (!$ex) {
            $stmt = Database::connection()->prepare(CartModel::INSERT_CART);
            $stmt->bind_param("iii", $user_id, $device_id, $quantity);
            $stmt->execute();
            return CartModel::get_cart_by_username_and_device($user_id, $device_id);
        }
        $q = CartModel::get_valid_quantity($quantity + $ex->quantity);
        return CartModel::update_cart($user_id, $device_id, $q);
    }

    public static function update_cart(int $user_id, int $device_id, int $quantity): ?CartModel
    {
        $q = CartModel::get_valid_quantity($quantity);
        $stmt = Database::connection()->prepare(CartModel::UPDATE_CART);
        $stmt->bind_param("iii", $q, $user_id, $device_id);
        $stmt->execute();
        return CartModel::get_cart_by_username_and_device($user_id, $device_id);
    }

    public static function remove_cart(int $user_id, int $device_id): ?CartModel {
        $stmt = Database::connection()->prepare(CartModel::REMOVE_CART);
        $stmt->bind_param("ii", $user_id, $device_id);
        $stmt->execute();
        return CartModel::get_cart_by_username_and_device($user_id, $device_id);
    }

    public static function remove_carts(int $user_id): array {
        $stmt = Database::connection()->prepare(CartModel::REMOVE_ALL_ITEMS);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return CartModel::get_carts($user_id);
    }

    public static function get_valid_quantity(int $quantity): int {
        $q = $quantity;
        if ($q < 0) {
            $q = 0;
        }
        return $q;
    }
}
