<?php

namespace App\Model;

class Likes extends Database
{
    private $tweetName;
    private $tweetId;
    private $likes;

    public function __construct()
    {
        $request = new Request();
        $this->tweetName = $request->get('q');
        $this->tweetId = $request->get('p');
        $this->likes = $request->get('l');
        parent::__construct();
    }

    public function updateLikes()
    {
        $username = $_SESSION['username'];
        $sql = "SELECT liked_by, tweet_likes FROM tweets WHERE tweeter_name='$this->tweetName' and id='$this->tweetId'";
        $result = $this->Conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row !== null) {
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
            $this->Conn->query($sql2);
        }
    }
}
