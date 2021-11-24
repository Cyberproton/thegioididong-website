<?php

namespace model;

use Throwable;

class Model 
{
    public function load(array $data): array
    {
        foreach ($data as $key => $value) 
        {
            if (property_exists($this, $key)) 
            {
                try 
                {
                    $this->{$key} = $value;
                }
                catch (Throwable $ex)
                {
                    return $this->get_validation_message("Something went wrong. Please try again", false);
                }
            }
        }
        return $this->get_validation_message("Success", true);
    }

    public function validate(): array
    {
        return $this->get_validation_message(null, true);
    }

    public function validate_data(array $data): array
    {
        return $this->get_validation_message(null, true);
    }

    public function validate_and_load(array $data): array 
    {
        $res = $this->validate_data($data);
        if (!$res["is_successful"])
        {
            return $res;
        }
        $this->load($data);
        return $this->get_validation_message("Success", true);
    }

    public function get_validation_message(?string $message, bool $is_successful): array 
    {
        return [ "message" => $message, "is_successful" => $is_successful];
    }

    public static function get_validation_message_static(?string $message, bool $is_successful): array 
    {
        return [ "message" => $message, "is_successful" => $is_successful];
    }
}