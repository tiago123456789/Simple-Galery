<?php

namespace App\Helpers\Http;

use App\Service\File;

class Response {

    static public function redirect($route) {
        header("Location: $route");
    }

    static public function download($file) {
        header("Content-Disposition: attachment; filename: arquivo;");
        header("Content-Type: image/png;");
        return File::download($file);
    }

}