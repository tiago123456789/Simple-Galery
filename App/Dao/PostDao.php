<?php

namespace App\Dao;

use App\Model\Post;

class PostDao {

    private $model;

    public function __construct() {
        $this->model = new Post();
    }

    public function findAll() {
        return $this->model->find()->get();
    }

    public function create($newRegister) {
        $sql = "INSERT INTO posts(describe, path_image) VALUES (:describe, :path_image)";
        $statement = $this->model->getConnection()->prepare($sql);
        $statement->bindParam(":describe", $newRegister["describe"]);
        $statement->bindParam(":path_image", $newRegister["path_image"]);        
        $statement->execute();
    }

    public function like($id) {
        $sql = "UPDATE posts SET likes = (likes + 1) WHERE id = :id";
        $statement = $this->model->getConnection()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function disLike($id) {
        $sql = "UPDATE posts SET unlikes = (unlikes + 1) WHERE id = :id";
        $statement = $this->model->getConnection()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }
}