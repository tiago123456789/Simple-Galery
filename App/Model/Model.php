<?php

namespace App\Model;

use App\Config\Connection;

abstract class Model {

    protected $table;
    
    protected $connection;

    protected $sql = "";

    public function __construct($table) {
        $this->table = $table;
        $this->connection = Connection::newInstance();
    }

    public function getConnection() {
        return $this->connection;
    }

    public function find($fields = "*") {
        $this->sql .= " SELECT $fields FROM $this->table ORDER BY id";
        return $this;
    }

    public function get() {
        $statement = $this->connection->prepare($this->sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}