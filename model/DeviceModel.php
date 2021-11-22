<?php

namespace model;

use core\Database;
use mysqli;

class DeviceModel extends Model 
{
    public const FIND_ALL_DEVICES = "SELECT * FROM device";
    public const FIND_DEVICE_BY_ID = "SELECT * FROM device WHERE device.id = ?";
    public const FIND_DEVICES_BY_NAME = "SELECT * FROM device WHERE device.name LIKE ?";
    public const INSERT_DEVICE = "INSERT INTO device(`name`,price,`value`,image_url,manufacturer,`description`,category_id) VALUES(?,?,?,?,?,?,?)";
    public const UPDATE_DEVICE_BY_ID = "UPDATE device SET `name`=?,price=?,`value`=?,image_url=?,manufacturer=?,`description`=?,category_id=? WHERE id=?";
    public const DELETE_DEVICE_BY_ID = "DELETE FROM device WHERE id=?";
    
    public int $id;
    public string $name;
    public float $price;
    public float $value;
    public string $image_url;
    public string $manufacturer;
    public string $description;
    public int $category_id;

    public function validate(): array
    {
        if (!$this->name || strlen($this->name) < 3 || strlen($this->name) > 30)
        {
            return [ "message" => "Tên phải lớn hơn 2 và nhỏ hơn 30 ký tự", "is_successful" => false ];
        }
        if (!$this->price) 
        {
            return [ "message" => "Giá tiền không được trống", "is_successful" => false ];
        }
        if (!$this->value) 
        {
            return $this->get_validation_message("Giá thực không được trống", false);
        }
        if ($this->manufacturer && strlen($this->manufacturer) > 64) 
        {
            return $this->get_validation_message("Tên thương hiệu được không quá 64 ký tự", false);
        }
        if ($this->description && strlen($this->description) > 10240) 
        {
            return $this->get_validation_message("Mô tả không được quá 10240 ký tự", false);
        }
        if (!$this->category_id || $this->category_id < 1)
        {
            return $this->get_validation_message("Please choose device's category", false);
        }
        return $this->get_validation_message("Thành công", true);
    }

    public function insert(): ?DeviceModel 
    {
        return DeviceModel::insert_device($this->name, $this->price, $this->value, $this->image_url, $this->manufacturer, $this->description, $this->category_id);
    }

    public function update(): ?DeviceModel
    {
        return DeviceModel::update_device($this->id, $this->name, $this->price, $this->value, $this->image_url, $this->manufacturer, $this->description, $this->category_id);
    }

    public static function get_devices(): array
    {
        $data = [];
        $res = Database::connection()->query(DeviceModel::FIND_ALL_DEVICES);
        while ($row = $res->fetch_assoc())
        {
            $device = new DeviceModel();
            $device->load($row);
            $data[] = $device;
        }
        $res->close();
        return $data;
    }

    public static function find_device_by_id(int $id): ?DeviceModel 
    {
        $stmt = Database::connection()->prepare(DeviceModel::FIND_DEVICE_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();

        if ($data)
        {
            $model = new DeviceModel();
            $model->load($data);
            return $model;
        }
        else 
        {
            return null;
        }
    }

    public static function find_devices_by_name(string $name): array
    {
        $data = DeviceModel::get_devices();
        $res = [];
        $n = strtolower(iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", preg_replace('/\s+/', '', $name)));
        foreach ($data as $device)
        {
            $device_n = strtolower(iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", preg_replace('/\s+/', '', $device->name)));
            if (strpos($device_n, $n) !== false) 
            {
                $res[] = $device;
            }
        }

        return $res;
    }

    public static function get_device(int $id): ?DeviceModel
    {
        return DeviceModel::find_device_by_id($id);
    }

    public static function insert_device(string $name, float $price, float $value, string $image_url, string $manufacturer, string $description, int $category_id): ?DeviceModel 
    {
        $stmt = Database::connection()->prepare(DeviceModel::INSERT_DEVICE);
        $stmt->bind_param("sddsssi", $name, $price, $value, $image_url, $manufacturer, $description, $category_id);
        $stmt->execute();
        $id = Database::connection()->insert_id;
        return DeviceModel::get_device($id);
    }

    public static function update_device(int $id, string $name, float $price, float $value, string $image_url, string $manufacturer, string $description, int $category_id): ?DeviceModel 
    {
        $stmt = Database::connection()->prepare(DeviceModel::UPDATE_DEVICE_BY_ID);
        $stmt->bind_param("sddsssii", $name, $price, $value, $image_url, $manufacturer, $description, $category_id, $id);
        $stmt->execute();
        return DeviceModel::get_device($id);
    }

    public static function delete_device(int $id): bool
    {
        $stmt = Database::connection()->prepare(DeviceModel::DELETE_DEVICE_BY_ID);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}