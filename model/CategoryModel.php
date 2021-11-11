<?php 

namespace model;

use core\Database;

class CategoryModel extends Model 
{
    public const FIND_ALL_CATEGORIES = "SELECT * FROM category";
    public int $id;
    public string $name;

    public static function find(): array
    {
        $res = Database::connection()->query(CategoryModel::FIND_ALL_CATEGORIES);
        while ($row = $res->fetch_assoc())
        {
            $category = new CategoryModel();
            $category->load($row);
            $data[] = $category;
        }
        $res->close();
        return $data;
    }
}