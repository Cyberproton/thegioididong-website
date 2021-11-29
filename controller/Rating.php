<?php

namespace controller;

use model\OrderModel;
use model\RatingModel;

class Rating extends Controller
{
    public function rate_device()
    {
        $body = $this->request->get_body();
        $user_id = $_SESSION["user_id"] ?? null;
        $device_id = $body["device_id"] ?? null;
        $value = $body["value"] ?? null;
        $content = $body["content"] ?? null;
        if (!$user_id || !$device_id || !$value) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Invalid request"]);
        }
        $order = OrderModel::find_by_id_and_device($user_id, $device_id);
        if (!$order) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "You haven't ordered this product"]);
        }
        $model = new RatingModel();
        $res = $model->validate_and_load($body);
        if (!$res["is_successful"]) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => $res["message"]]);
        }
        $res = $model->insert();
        if (!$res) {
            $this->response->code(500);
            $this->response->json(["successful" => false, "message" => "Internal server error"]);
        }
        $this->response->json(["successful" => true, "message" => "Done", "rating" => $res ]);
    }
}
