<?php

namespace App\Service;

class File {

    const PATH_STORAGE_IMAGE = "../public/storage/";

    static public function upload($file) {
        if ($file["error"]) {
			echo "Occour following error: {$file['error']}";
        }
        $pathImage = File::PATH_STORAGE_IMAGE . $file["name"];
		move_uploaded_file($file["tmp_name"], $pathImage);
    }
}