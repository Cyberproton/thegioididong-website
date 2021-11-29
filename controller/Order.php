<?php

namespace controller;

use model\DeviceModel;
use model\OrderModel;
use model\UserModel;

class Order extends Controller
{
    public array $status_message = ["DELIVERING" => "delivering", "CANCELLED" => "cancelled", "COMPLETED" => "completed"];
    public array $status_priority = [
        "PENDING" => ["CANCELLED", "DELIVERING"],
        "DELIVERING" => ["COMPLETED"],
        "COMPLETED" => [],
        "CANCELLED" => [],
    ];

    public function get_orders()
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $devices = [];
        $orders = OrderModel::find_by_user($user_id);
        foreach ($orders as $order) {
            if (!array_key_exists($order->device_id, $devices)) {
                $device = DeviceModel::find_device_by_id($order->device_id);
                $devices[$order->device_id] = $device;
                $order->device = $device;
            } else {
                $order->device = $devices[$order->device_id];
            }
        }
        $this->view("order/order", ["orders" => $orders]);
    }

    public function cancel_order()
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $order_id = $this->request->get_body()["order_id"] ?? "";
        $order = OrderModel::find_by_id($order_id);
        if ($order && $order->user_id != $user_id) {
            $this->response->code(403);
            $this->response->json(["successful" => false, "message" => "Forbidden"]);
            return;
        }
        if (!$order) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        }
        if (!in_array("CANCELLED", $this->status_priority[$order->status])) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order's status is invalid. Look like it has been updated."]);
            return;
        }
        $order = OrderModel::cancel_order($order_id, "Customer cancelled");
        if (!$order) {
            $this->response->code(404);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        } else {
            $this->response->json(["successful" => true, "message" => "Order has been cancelled", "order" => $order]);
            return;
        }
    }

    public function add_orders()
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $user = UserModel::find_user_by_id($user_id);
        if ($user) {

        }
        $orders = OrderModel::insert_from_user($user_id);
        $this->response->json(["successful" => true, "message" => "Order items successfully", "orders" => $orders ]);
    }

    public function get_admin_orders()
    {
        $devices = [];
        $users = [];
        $orders = OrderModel::find();
        foreach ($orders as $order) {
            if (!array_key_exists($order->device_id, $devices)) {
                $device = DeviceModel::find_device_by_id($order->device_id);
                $devices[$order->device_id] = $device;
                $order->device = $device;
            } else {
                $order->device = $devices[$order->device_id];
            }

            if (!array_key_exists($order->user_id, $users)) {
                $user = UserModel::find_user_by_id($order->user_id);
                $users[$order->user_id] = $user;
                $order->user = $user;
            } else {
                $order->user = $users[$order->user_id];
            }
        }
        $this->view("admin/order/order", ["orders" => $orders], "admin");
    }

    public function admin_cancel_order()
    {
        $order_id = $this->request->get_body()["order_id"] ?? "";
        $cancellation_reason = $this->request->get_body()["cancellation_reason"] ?? "No reason";
        $order = OrderModel::find_by_id($order_id);
        if (!$order) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        }
        if (!in_array("CANCELLED", $this->status_priority[$order->status])) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order's status is invalid. Look like it has been updated."]);
            return;
        }
        $order = OrderModel::cancel_order($order_id, $cancellation_reason);
        $device = DeviceModel::find_device_by_id($order->device_id);
        $order->device = $device;
        $user = UserModel::find_user_by_id($order->user_id);
        $order->user = $user;
        if (!$order) {
            $this->response->code(404);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        } else {
            $this->response->json(["successful" => true, "message" => "Order has been cancelled", "order" => $order]);
            return;
        }
    }

    public function admin_update_order_status()
    {
        $order_id = $this->request->get_body()["order_id"] ?? "";
        $status = $this->request->get_body()["status"] ?? null;
        if (!$status || !array_key_exists($status, $this->status_priority)) {
            $this->response->code(404);
            $this->response->json(["successful" => false, "message" => "Invalid status"]);
            return;
        }
        $order = OrderModel::find_by_id($order_id);
        if (!$order) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        }
        if (!in_array($status, $this->status_priority[$order->status])) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Order's status is invalid. Look like it has been updated."]);
            return;
        }
        $order = OrderModel::update_order_status($order_id, $status);
        $device = DeviceModel::find_device_by_id($order->device_id);
        $order->device = $device;
        $user = UserModel::find_user_by_id($order->user_id);
        $order->user = $user;
        if (!$order) {
            $this->response->code(404);
            $this->response->json(["successful" => false, "message" => "Order does not exist"]);
            return;
        } else {
            $s = $this->status_message[$status];
            $this->response->json(["successful" => true, "message" => "Order has been cancelled", "order" => $order]);
            return;
        }
    }
}
