<?php
namespace App\Controller;

use App\DeleteTweet;
use App\Model\Likes;
use App\Request;

class TweetController
{
    public function delete()
    {
        $request = new Request();
        $deletetweet = new DeleteTweet($request->post('tweetId'));
        return $deletetweet->deleteTweet();
    }

    public function like()
    {
        $tweet = new Likes();
        $tweet->updateLikes();

    }
}

?>