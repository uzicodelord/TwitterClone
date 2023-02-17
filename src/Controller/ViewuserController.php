<?php

namespace App\Controller;

use App\Model\ViewUser;
class ViewuserController
{
    public function viewuser(){
        $viewUser = new ViewUser();
        return $viewUser->displayTweets();
    }
}