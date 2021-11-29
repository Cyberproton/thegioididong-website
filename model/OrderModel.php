<?php

namespace model;

use core\Database;
use DateTime;

class OrderModel extends Model
{
    public const SELECT_ALL = "SELECT * FROM orders";
    public const SELECT_BY_USER_ID = "SELECT * FROM orders WHERE `user_id`=?";
    public const SELECT_BY_USER_AND_DEVICE = "SELECT * FROM orders WHERE `user_id`=? AND `device_id`=?";
    public const SELECT_ORDER_BY_ID = "SELECT * FROM orders WHERE id=?";
    public const INSERT_ORDER = "INSERT INTO `orders`(`date`,`status`,`user_id`,`device_id`,`price`,`quantity`) VALUES(?,?,?,?,?,?)";
    public const UPDATE_ORDER_STATUS_BY_ID = "UPDATE orders SET `status`=? WHERE id=?";
    public const UPDATE_ORDER_STATUS_WITH_REASON = "UPDATE orders SET `status`=?,`cancellation_reason`=? WHERE id=?";
    public int $id;
    public string $date;
    public string $status;
    public int $user_id;
    public int $device_id;
    public string $price;
    public int $quantity;
    public string $cancellation_reason;
    public ?DeviceModel $device;

    public static function find(): array
    {
        $res = Database::connection()->query(OrderModel::SELECT_ALL);
        while ($row = $res->fetch_assoc()) {
            $order = new OrderModel();
            $order->load($row);
            $data[] = $order;
        }
        return $data;
    }

    public static function find_by_user(string $id): array
    {
        $stmt = Database::connection()->prepare(OrderModel::SELECT_BY_USER_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return [];
        }
        $data = [];
        while ($row = $res->fetch_assoc()) {
            $order = new OrderModel();
            $order->load($row);
            $data[] = $order;
        }
        return $data;
    }

    public static function find_by_id(int $id): ?OrderModel
    {
        $stmt = Database::connection()->prepare(OrderModel::SELECT_ORDER_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        if ($data) {
            $model = new OrderModel();
            $model->load($data);
            return $model;
        } else {
            return null;
        }
    }

    public static function find_by_id_and_device(int $user_id, int $device_id): ?OrderModel
    {
        $stmt = Database::connection()->prepare(OrderModel::SELECT_BY_USER_AND_DEVICE);
        $stmt->bind_param("ii", $user_id, $device_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return null;
        } 
        $data = $res->fetch_assoc();
        if ($data) {
            $model = new OrderModel();
            $model->load($data);
            return $model;
        } else {
            return null;
        }
    }

    public static function insert_from_user(string $user_id): array
    {
        $carts = CartModel::get_carts($user_id);
        foreach ($carts as $cart) {
            $stmt = Database::connection()->prepare(OrderModel::INSERT_ORDER);
            $date = date("Y-m-d H:i:s", (new DateTime())->getTimestamp());
            $status = "PENDING";
            $price = $cart->device->price * $cart->quantity;
            $stmt->bind_param("ssiiii", $date, $status, $cart->user_id, $cart->device_id, $price, $cart->quantity);
            $res = $stmt->execute();
        }
        $res = CartModel::remove_carts($user_id);
        return OrderModel::find();
    }

    public static function cancel_order(int $id, ?string $cancellation_reason = null): ?OrderModel
    {
        $stmt = Database::connection()->prepare(OrderModel::UPDATE_ORDER_STATUS_WITH_REASON);
        $status = "CANCELLED";
        $stmt->bind_param("ssi", $status, $cancellation_reason, $id);
        $stmt->execute();
        return OrderModel::find_by_id($id);
    }

    public static function update_order_status(int $id, string $status): ?OrderModel
    {
        $stmt = Database::connection()->prepare(OrderModel::UPDATE_ORDER_STATUS_BY_ID);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        return OrderModel::find_by_id($id);
    }
}
