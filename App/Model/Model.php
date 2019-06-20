<?php

namespace App\Model;

use App\Config\Connection;

abstract class Model {

    protected $table;
    
    protected $connection;

    private $sql = "";

    private $conditions = [];

    private $fieldsOrderBy = ["id"];


    public function __construct($table) {
        $this->table = $table;
        $this->connection = Connection::newInstance();
    }

    public function getConnection() {
        return $this->connection;
    }

    public function find(array $fields = []) {
        $fields = count($fields) == 0 ? "*" : $fields;
        $isReturnAllColumnsTable = $fields == "*";
        if (!$isReturnAllColumnsTable) {
            $this->fieldsOrderBy = $fields;
            $fields = implode(",", $fields);
        }
        $this->sql .= " SELECT $fields FROM $this->table";
        return $this;
    }

    public function where($field, $value, $operation = "=") {
        $isFirstCondition = count($this->conditions)  == 0;
        if ($isFirstCondition) {
            $this->sql .= " WHERE ";
        } else {
            $this->sql .= " AND ";
        }

        $this->sql .= " $field = :$field ";
        array_push($this->conditions, [$field, $operation, $value]);
        return $this;
    }

    public function get() {
        $columnsOrdered = implode(",", $this->fieldsOrderBy);
        $this->sql .= " ORDER BY $columnsOrdered";
        $statement = $this->connection->prepare($this->sql);
        foreach($this->conditions as $key => $condition) {
            $nameParameter = ":" . $condition[0];
            $value = $condition[2];
            $statement->bindParam($nameParameter, $value);
        }
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}