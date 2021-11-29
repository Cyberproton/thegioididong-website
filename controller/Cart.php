<?php 

namespace controller;

use model\CartModel;

class Cart extends Controller 
{
    public function get_cart()
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $carts = CartModel::get_carts($user_id);
        $this->view("cart/cart", ["carts" => $carts]);
    }

    public function add_to_cart() 
    {
        $body = $this->request->get_body();
        $user_id = $_SESSION["user_id"] ?? null;
        $device_id = $body["device_id"] ?? null;
        $quantity = $body["quantity"] ?? null;
        if (!$user_id || !$device_id || !$quantity) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Invalid request"]);
        }
        $cart = CartModel::insert_cart($user_id, $device_id, $quantity);
        if (!$cart) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Internal server error"]);
        }
        $this->response->json(["successful" => false, "message" => "Success", "cart" => $cart]);
    }

    public function remove_cart() 
    {
        $body = $this->request->get_body();
        $user_id = $_SESSION["user_id"] ?? null;
        $device_id = $body["device_id"] ?? null;
        if (!$user_id || !$device_id) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Invalid request"]);
        }
        $cart = CartModel::remove_cart($user_id, $device_id);
        if ($cart) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Invalid server error"]);
        }
        $this->response->json(["successful" => false, "message" => "Success", "user_id" => $user_id, "device_id" => $device_id]);
    }
}