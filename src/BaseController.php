<?php

namespace App;
class BaseController {

    public function view($filename, $vars) {
        extract($vars);
        include "Views/header.php";
        include($filename);
        include "Views/footer.php";
    }

    public function returnJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
