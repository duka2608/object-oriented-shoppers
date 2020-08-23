<?php
    namespace app\Controllers;

    class Controller {
        protected function view($file, $data = []){
            include_once "app/views/inc/head.php";
            include_once "app/views/inc/header.php";
            include_once "app/views/content/$file.php";
            include_once "app/views/inc/footer.php";
        }

        protected function returnJson($data = null, $statusCode = 200) {
            header("Content-type: application/json");
            http_response_code($statusCode);
            echo json_encode($data);
        }
    }