<?php 

namespace model;

use core\Database;

class CategoryModel extends Model 
{
    public const FIND_ALL_CATEGORIES = "SELECT * FROM category";
    public const FIND_BY_ID = "SELECT * FROM category WHERE id=?";
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

    public static function find_by_id(int $id): ?CategoryModel
    {
        $stmt = Database::connection()->prepare(CategoryModel::FIND_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if (!$res) {
            return null;
        }
        $model = new CategoryModel();
        $model->load($res->fetch_assoc());
        return $model;
    }
}