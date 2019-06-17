<?php

namespace App\Helpers\Http;

class Response {

    static public function redirect($route) {
        header("Location: $route");
    }
}