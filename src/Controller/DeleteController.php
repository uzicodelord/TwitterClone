<?php
namespace App\Controller;

use App\BaseController;
use App\Model\DeleteTweet;
use App\Model\Likes;
use App\Model\Request;
use App\Model\Search;
use App\Model\Tweet;
use App\Model\TweetDisplay;

class DeleteController extends BaseController
{
    public function index()
    {
        $request = new Request();
        $deleteTweet = new DeleteTweet($request->post('tweetId'));
        $deleteTweet->deleteTweet();
    }
}
