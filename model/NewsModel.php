<?php 

namespace model;

use core\Database;
use DateTime;

class NewsModel extends Model {
    public const SELECT_ALL = "SELECT * FROM news";
    public const SELECT_BY_ID = "SELECT * FROM news WHERE id=?";
    public const INSERT = "INSERT INTO news(`classification`,`title`,`content`,`date`, `image_url`) VALUES(?,?,?,?,?)";
    public const UPDATE_BY_ID = "UPDATE news SET `classification`=?,`title`=?,content=?,`date`=?,`image_url`=? WHERE id=?";
    public const DELETE_BY_ID = "DELETE FROM news WHERE id=?";
    public int $id;
    public string $title;
    public string $classification;
    public string $content;
    public string $date;
    public string $image_url;

    public function add(): ?NewsModel {
        return NewsModel::insert($this->classification, $this->title, $this->content, $this->image_url ?? "");
    }

    public function update(): ?NewsModel {
        return NewsModel::update_by_id($this->id, $this->classification, $this->title, $this->content, $this->image_url ?? "");
    }

    public function validate_data(array $data): array {
        $title = $data["title"] ?? null;
        $content = $data["content"] ?? null;
        $classification = $data["classification"] ?? null;
        $date = $data["date"] ?? null;
        if (!$title || strlen($title) < 6) {
            return $this->get_validation_message("Invalid title", false);
        }
        if (!$content) {
            return $this->get_validation_message("Invalid content", false);
        }
        if (!$classification) {
            return $this->get_validation_message("Invalid classification", false);
        }
        if ($date && !Model::validate_datetime($date)) {
            return $this->get_validation_message("Invalid date", false);
        }
        return $this->get_validation_message("Done", true);
    }

    public static function get_all(): array {
        $res = Database::connection()->query(NewsModel::SELECT_ALL);
        while ($row = $res->fetch_assoc())
        {
            $model = new NewsModel();
            $model->load($row);
            $data[] = $model;
        }
        return $data;
    }

    public static function get_by_id(int $id): ?NewsModel {
        $stmt = Database::connection()->prepare(NewsModel::SELECT_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        if (!$data)
        {
            return null;
        }
        $model = new NewsModel();
        $model->load($data);
        return $model;
    }

    public static function insert(string $classification, string $title, string $content, string $image_url) {
        $stmt = Database::connection()->prepare(NewsModel::INSERT);
        $date = date("Y-m-d H:i:s", (new DateTime())->getTimestamp());
        $stmt->bind_param("sssss", $classification, $title, $content, $date, $image_url);
        $res = $stmt->execute();
        if ($res === false) {
            return null;
        }
        $id = Database::connection()->insert_id;
        return NewsModel::get_by_id($id);
    }

    public static function update_by_id(int $id, string $classification, string $title, string $content, string $image_url): ?NewsModel {
        $stmt = Database::connection()->prepare(NewsModel::UPDATE_BY_ID);
        $date = date("Y-m-d H:i:s", (new DateTime())->getTimestamp());
        $stmt->bind_param("sssssi", $classification, $title, $content, $date, $image_url, $id);
        $stmt->execute();
        return NewsModel::get_by_id($id);
    }

    public static function delete_by_id(int $id): ?NewsModel {
        $stmt = Database::connection()->prepare(NewsModel::DELETE_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return NewsModel::get_by_id($id);
    }
}