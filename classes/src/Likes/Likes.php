<?php

namespace Likes;
class Likes
{
    private $tweetName;
    private $tweetId;
    private $likes;

    public function __construct()
    {
        $this->tweetName = $_GET['q'];
        $this->tweetId = $_GET['p'];
        $this->likes = $_GET['l'];
    }

    public function updateLikes()
    {
        require_once 'C:/xampp/htdocs/twitteruzi/database/dbConfig.php';
        session_start();
        $username = $_SESSION['username'];
        $sql = "SELECT liked_by, tweet_likes FROM tweets WHERE tweeter_name='$this->tweetName' and id='$this->tweetId'";
        $result = $Conn->query($sql);
        $row = $result->fetch_assoc();
        $liked_by = $row['liked_by'];
        $tweet_likes = $row['tweet_likes'];
        if (strpos($liked_by, $username) !== false) {
            if ($tweet_likes > 0) {
                $liked_by = str_replace(",$username", "", $liked_by);
                $tweet_likes--;
                echo " " . $tweet_likes;
            }
        } else {
            $liked_by .= ",$username";
            $tweet_likes++;
            echo " " . $tweet_likes;
        }
        $sql2 = "UPDATE tweets SET tweet_likes ='$tweet_likes', liked_by='$liked_by' WHERE tweeter_name='$this->tweetName' and id='$this->tweetId'";
        $Conn->query($sql2);
    }
}



$tweet = new Likes();
$tweet->updateLikes();

?>