<?php

namespace App\Bo;

use App\Dao\PostDao;

class PostBo {

    private $dao;

    public function __construct() {
        $this->dao = new PostDao();
    }

    public function download($id) {
        return $this->dao->download($id);
    }

    public function create($newRegister) {
        $this->dao->create($newRegister);
    }

    public function findById($id) {
        return $this->dao->findById($id);
    }

    public function findAll() {
        return $this->dao->findAll();
    }

    public function like($id) {
        $this->dao->like($id);
    }

    public function disLike($id) {
        return $this->dao->disLike($id);
    }
}