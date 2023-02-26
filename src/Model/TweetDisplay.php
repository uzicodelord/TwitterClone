<?php
declare(strict_types=1);

namespace App\Model;

class TweetDisplay extends Database
{
    private string $updateQuery;
    private $result;
    private array $tweetDisplayArray = array();
    private string $viewLink;

    public function __construct()
    {
        parent::__construct();
        $this->updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
        $this->viewLink = "/twitteruzi/index.php/viewuser/index?user=";
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
            $comment = new Comment();
            $tweetDisplay['comments'] = $comment->getCommentForTweet((int)$tweetId);
            $this->tweetDisplayArray[] = $tweetDisplay;
        }

        return $this->tweetDisplayArray;
    }

    public function displayTweetsForUser($username): array
    {
        $results = [];
        $comment = new Comment();
        $query = $this->Conn->query("SELECT * FROM tweets WHERE tweeter_name='" . $username . "'");

        while ($row = $query->fetch_assoc()) {
            $row['comments'] = $comment->getCommentForTweet((int)$row['id']);
            $results[] = $row;
        }

        return $results;
    }
}
