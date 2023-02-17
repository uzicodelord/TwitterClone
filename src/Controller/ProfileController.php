<?php

namespace App\Controller;

use App\Model\ViewProfile;
class ProfileController
{
    public function view(){
        $profileDisplay = new ViewProfile();
        return $profileDisplay->displayTweets();
    }
}