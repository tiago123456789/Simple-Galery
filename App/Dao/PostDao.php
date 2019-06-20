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

    public function download($id) {
        $post = $this->findById($id);
        $sql = "UPDATE posts SET download = (download + 1) WHERE id = :id";
        $statement = $this->model->getConnection()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute(); 
        return $post["path_image"];     
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

    public function findById($id) {
        return $this->model->find(["path_image"])->where("id", $id)->get()[0];
    }
}