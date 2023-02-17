<?php
declare(strict_types=1);

namespace App\Model;

class TweetDisplay extends Database
{
    private $updateQuery;
    private $viewLink;
    private $result;
    private $tweetDisplayArray = array();

    public function __construct()
    {
        parent::__construct();
        $this->updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
        $this->viewLink = "viewuser.php?user=";
        $this->result = $this->Conn->query($this->updateQuery);
    }

    public function displayTweets(): array
    {
        while ($row = $this->result->fetch_assoc()) {
            $tweetDisplay = array();

            $tweetDisplay['username'] = $row['tweeter_name'];
            $tweetDisplay['tweet_time'] = $row['tweet_time'];
            $tweetDisplay['tweet_content'] = $row['tweet_content'];
            $tweetDisplay['tweet_likes'] = $row['tweet_likes'];
            $tweetDisplay['id'] = $row['id'];
            $tweetDisplay['tweeter_name'] = $row['tweeter_name'];
            $tweetDisplay['comments'] = array();

            $tweetId = $row['id'];
            $getCommentsQuery = "SELECT * FROM comments JOIN tweets ON comments.tweet_id = tweets.id WHERE comments.tweet_id = $tweetId";
            $commentsResult = $this->Conn->query($getCommentsQuery);

            while ($comment = $commentsResult->fetch_assoc()) {
                $commentDisplay = array();
                $commentDisplay['username'] = $comment['username'];
                $commentDisplay['comment_time'] = $comment['comment_time'];
                $commentDisplay['comment_text'] = $comment['comment_text'];
                $tweetDisplay['comments'][] = $commentDisplay;
            }

            $this->tweetDisplayArray[] = $tweetDisplay;
        }

        return $this->tweetDisplayArray;
    }
}
