<?php
namespace App\Controller;

use App\BaseController;
use App\Model\ProfileUpdater;
use App\Model\Request;

class EditController extends BaseController
{

    public function index(){
        include 'views/header.twig';
        include 'views/edit.twig';
        $profileUpdater = new ProfileUpdater();
        $request = new Request();
        $email = $request->post('txtEmail');
        $password = !empty($request->post('txtNewPassword')) ? $request->post('txtNewPassword') : '';
        $profileUpdater->updateProfile($email, $password);
    }
}
