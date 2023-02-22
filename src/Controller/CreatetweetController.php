<?php

namespace App\Controller;

use App\BaseController;
use App\Model\Request;
use App\Model\Tweet;

class CreatetweetController extends BaseController
{

        public function index()
        {
            $tweet = new Tweet();
            var_dump('heh');

            $request = new Request();
            $txtNewTweet = $request->post('txtNewTweet');
            $txtTweetName = $_SESSION['username'];
            $tweet->createTweet($txtNewTweet, $txtTweetName);
            header('location: /twitteruzi/index.php/home/index');
        }
}