<?php

namespace App\Helpers\Http;

class Request {

    static public function all() {
        $isMethodGet = $_SERVER['REQUEST_METHOD'] === "GET";
        if ($isMethodGet) {
            return $_GET;
        } else {
            return $_POST;
        }
    }
}