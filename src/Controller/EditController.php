<?php
namespace App\Controller;

use App\BaseController;
use App\Model\ProfileUpdater;
use App\Model\Request;

class EditController extends BaseController
{

    public function index(){
        $profileUpdater = new ProfileUpdater();
        $request = new Request();
        $email = $request->post('txtEmail');
        $password = !empty($request->post('txtNewPassword')) ? $request->post('txtNewPassword') : '';
        $profileUpdater->updateProfile($email, $password);
        $this->view('edit.twig',
            ['email' => $email,
                'password' => $password
            ]);
        include 'Resources/views/footer.twig';
    }
}
