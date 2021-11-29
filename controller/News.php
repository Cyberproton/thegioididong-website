<?php

namespace controller;

use model\NewsModel;

class News extends Controller
{
    public function get_news()
    {
        $models = NewsModel::get_all();
        $this->view("news/news", ["models" => $models], "main");
    }

    public function get_news_view()
    {
        $id = $this->request->get_params()["id"];
        if (!$id) {
            $this->view("news/news-view", ["successful" => false, "message" => "Invalid news"]);
            return;
        }
        $model = NewsModel::get_by_id($id);
        if (!$model) {
            $this->view("news/news-view", ["successful" => false, "message" => "News does not exists"]);
            return;
        }
        $this->view("news/news-view", ["model" => $model]);
    }

    public function admin_get_news()
    {
        $models = NewsModel::get_all();
        $this->view("admin/news/news", ["news" => $models], "admin");
    }

    public function admin_get_edit_news()
    {
        $id = $this->request->get_params()["id"];
        if (!$id) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => "Invalid news"], "admin");
            return;
        }
        $model = NewsModel::get_by_id($id);
        if (!$model) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => "News does not exists"], "admin");
            return;
        }
        $this->view("admin/news/news-edit", ["model" => $model], "admin");
    }

    public function admin_post_edit_news()
    {
        $data = $this->request->get_body();
        $id = $data["id"];
        $exist = NewsModel::get_by_id($id);
        if (!$id || !$exist) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => "Invalid news"], "admin");
            return;
        }
        $model = new NewsModel();
        $res = $model->validate_and_load($data);
        if (!$res["is_successful"]) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => $res["message"], "model" => $exist], "admin");
            return;
        }
        $model = $model->update();
        if (!$model) {
            $this->view("admin/news/news-add", ["successful" => false, "message" => "Internal server error"], "admin");
            return;
        }
        $this->view("admin/news/news-edit", ["successful" => true, "message" => "Done", "model" => $model], "admin");
    }

    public function admin_get_add_news()
    {
        $this->view("admin/news/news-add", [], "admin");
    }

    public function admin_post_add_news()
    {
        $data = $this->request->get_body();
        $model = new NewsModel();
        $res = $model->validate_and_load($data);
        if (!$res["is_successful"]) {
            $this->view("admin/news/news-add", ["successful" => false, "message" => $res["message"]], "admin");
            return;
        }
        $model = $model->add();
        if (!$model) {
            $this->view("admin/news/news-add", ["successful" => false, "message" => "Internal server error"], "admin");
            return;
        }
        $this->view("admin/news/news-add", ["successful" => true, "message" => "Done", "model" => $model], "admin");
    }

    public function admin_post_delete_news()
    {
        $data = $this->request->get_body();
        $id = $data["id"];
        if (!$id || !NewsModel::get_by_id($id)) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => "Invalid news"], "admin");
            return;
        }
        $model = NewsModel::delete_by_id($id);
        if ($model) {
            $this->view("admin/news/news-edit", ["successful" => false, "message" => "Internal server error", "model" => $model], "admin");
            return;
        }
        $this->view("admin/news/news-edit", ["successful" => true, "message" => "News deleted successfully"], "admin");
    }
}
