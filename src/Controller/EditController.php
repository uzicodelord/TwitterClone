<?php
namespace App\Controller;

use App\Model\ProfileUpdater;
use App\Model\Request;

class EditController{
    public function edit(){
        $profileUpdater = new ProfileUpdater();
        $request = new Request();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $request->post('txtEmail');
            $password = !empty($request->post('txtNewPassword')) ? $request->post('txtNewPassword') : '';
            $profileUpdater->updateProfile($email, $password);
            $rootUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/twitteruzi';
            return header('Location: ' . $rootUrl . '/Views/edit.php');
        }
    }
}
