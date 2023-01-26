<?php
class Tweet
{
    public $tweetId;

    public function __construct($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function deleteTweet()
    {
        include 'database/dbConfig.php';
        $deleteQuery = "DELETE FROM tweets WHERE id = $this->tweetId";
        if ($Conn->query($deleteQuery) === TRUE) {
            header('location: homepage.php');
            $deleteCommentQuery = "DELETE FROM comments WHERE tweet_id = $this->tweetId";
            if ($Conn->query($deleteCommentQuery) === TRUE) {
            } else {
                exit;
            }
        } else {
            exit;
        }
    }
}
if (isset($_POST['tweetId'])) {
    $tweet = new Tweet($_POST['tweetId']);
    $tweet->deleteTweet();
}

?>