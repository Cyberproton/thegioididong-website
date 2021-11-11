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

    public function get_validation_message(?string $message, bool $is_successful): array 
    {
        return [ "message" => $message, "is_successful" => $is_successful];
    }
}