<?php
namespace App\Controller;

use App\Model\DeleteTweet;
use App\Model\Likes;
use App\Model\Request;
use App\Model\Search;
use App\Model\Tweet;
use App\Model\TweetDisplay;

class TweetController
{
    public function delete()
    {
        $request = new Request();
        $deleteTweet = new DeleteTweet($request->post('tweetId'));
        return $deleteTweet->deleteTweet();
    }

    public function like()
    {
        $tweet = new Likes();
        $tweet->updateLikes();

    }

    public function create()
    {
        $tweet = new Tweet();
        $request = new Request();
        $txtNewTweet = $request->post('txtNewTweet');
        $txtTweetName = $_SESSION['username'];
        $tweet->createTweet($txtNewTweet, $txtTweetName);
        $rootUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/twitteruzi';
        return header('Location: ' . $rootUrl . '/Views/home.php');
    }




    public function search()
    {
        $search = new Search();
        if (isset($_GET['btnSearch'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $request = new Request();
                $txtSearch = $request->get('txtSearch');
                $search->searchUser($txtSearch);
            }
        }

    }

    public function display()
    {
        $tweetDisplay = new TweetDisplay();
        $tweetDisplay->displayTweets();
    }
}
