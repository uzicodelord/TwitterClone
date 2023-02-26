<?php

namespace App\Controller;

use App\BaseController;
use App\Model\TweetDisplay;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ViewuserController extends BaseController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $tweetDisplay = new TweetDisplay();
        $tweets = $tweetDisplay->displayTweets();
        $username = $_SESSION['username'];
        $user = $_GET['user'];
        $this->view('viewuser.twig',
            [
                'tweets' => $tweets,
                'username' => $username,
                'user' => $user
            ]);
        include 'Resources/views/footer.twig';
    }
}
