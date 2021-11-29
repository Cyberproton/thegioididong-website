<?php

namespace controller;

use model\CategoryModel;
use model\DeviceModel;
use model\OrderModel;
use model\RatingModel;

class Device extends Controller 
{
    public function get_admin_devices()
    {
        $this->view("admin/device/index", [ "title" => "Admin Device Manager", "devices" => DeviceModel::get_devices(), "categories" => CategoryModel::find() ], "admin");
    }

    public function get_admin_device()
    {
        $device_id = $this->request->get_params()["id"] ?? null;
        $this->view("admin/device/device_detail", [ "title" => "Admin Device Manager", "device" => $device_id ? DeviceModel::get_device($device_id) : null ], "admin");
    }

    public function get_admin_add_device()
    {
        $categories = CategoryModel::find();
        $this->view("admin/device/device_add", [ "title" => "Admin Device Manager", "categories" => $categories ], "admin");
    }

    public function get_admin_edit_device()
    {
        $categories = CategoryModel::find();
        $device_id = $this->request->get_params()["id"] ?? null;
        $this->view("admin/device/device_editor", [ "title" => "Admin Device Editor", "categories" => $categories, "device" => $device_id ? DeviceModel::get_device($device_id) : null ], "admin");
    }

    public function post_admin_add_device()
    {
        $body = $this->request->get_body();
        $categories = CategoryModel::find();
        $device = new DeviceModel();
        $check = $device->validate_and_load($body);
        if (!$check["is_successful"])
        {
            $this->render_add($device, $categories, $check["message"], false);
            return;
        }
        $inserted_device = $device->insert();
        if (!$inserted_device)
        {
            $this->render_add($device, $categories, "Some error has happened. Please try again", false);
            return;
        }
        $this->render_add(null, $categories, "Device added successfully", true);
    }

    public function post_admin_update_device()
    {
        $categories = CategoryModel::find();
        $id = $this->request->get_params()["id"] ?? null;
        if (!$id) 
        {
            $this->render_editor(null, $categories);
            return;
        }

        $device = DeviceModel::get_device($id) ?? null;
        if (!$device) 
        {
            $this->render_editor(null, $categories);
            return;
        }

        $is_successful = true;
        $body = $this->request->get_body();

        $new_device = new DeviceModel();
        $new_device->id = $id;
        $res = $new_device->validate_and_load($body);

        if ($res["is_successful"]) 
        {
            $message = "Device updated successfully";
        }
        else 
        {
            $this->render_editor($device, $categories, $res["message"], false);
            return;
        }

        $device = $new_device->update();
        $this->render_editor($device, $categories, $message, true);
    }

    public function post_admin_delete_device() 
    {
        $id = $this->request->get_params()["id"] ?? null;
        if (!$id) 
        {
            $this->response->code(500);
            return;
        }
        $res = DeviceModel::delete_device($id);
        if (!$res) 
        {
            $this->response->code(500);
            return;
        }
        $this->response->json([ "message" => "Device deleted successfully" ]);
    }

    public function get_devices()
    {
        $key = $this->request->get_params()["key"] ?? "";
        $categories = CategoryModel::find();
        $devices = DeviceModel::find_devices_by_name($key);
        $res = $devices;
        $this->view("device/product", [ "search_key" => $key, "devices" => $res, "categories" => $categories ]);
    }

    public function get_device() 
    {
        $user_id = $_SESSION["user_id"] ?? null;
        $has_ordered = null;
        $id = $this->request->get_params()["id"] ?? "";
        $device = DeviceModel::get_device($id);
        $ratings = RatingModel::find_by_device($id);
        if ($user_id !== null) {
            $has_ordered = OrderModel::find_by_id_and_device($user_id, $id);
        }
        $this->view("device/detail", [ "device" => $device, "ratings" => $ratings, "has_ordered" => $has_ordered, "is_logged_in" => $user_id !== null ]);
    }

    public function render_add(?DeviceModel $device = null, array $categories, ?string $message = null, bool $is_successful = false)
    {
        $this->view("admin/device/device_add", [ "title" => "Admin Device Editor", "device" => $device, "categories" => $categories, "message" => $message, "is_successful" => $is_successful ], "admin");
    }

    public function render_editor(?DeviceModel $device = null, array $categories, ?string $message = null, bool $is_successful = false) 
    {
        $this->view("admin/device/device_editor", [ "title" => "Admin Device Editor", "device" => $device, "categories" => $categories, "message" => $message, "is_successful" => $is_successful ], "admin");
    }
}