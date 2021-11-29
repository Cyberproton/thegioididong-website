<?php

namespace controller;

use model\DeviceModel;

class Home extends Controller
{
    public function get_home() 
    {
        $devices = DeviceModel::get_devices();
        $this->view("index", [ "devices" => $devices ]);
    }

    public function admin_home()
    {
        $this->view("admin/index", [], "admin");
    }
}