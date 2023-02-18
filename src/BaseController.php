<?php

namespace App;
class BaseController {

    public function includeHTML($filename) {
        include($filename);
    }

    public function returnJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
