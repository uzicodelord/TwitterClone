<?php

namespace DeleteTweet;

use Exception;

class DeleteTweet
{
    public $tweetId;

    public function __construct($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function deleteTweet()
    {
        require_once 'C:/xampp/htdocs/twitteruzi/database/dbConfig.php';

        $deleteQuery = "DELETE FROM tweets WHERE id = $this->tweetId";

        if ($Conn->query($deleteQuery) !== TRUE) {
            $response = [
                'status' => 'error',
                'message' => 'Error deleting tweet'
            ];
            echo json_encode($response);
            exit;
        }

        $deleteCommentQuery = "DELETE FROM comments WHERE tweet_id = $this->tweetId";
        if ($Conn->query($deleteCommentQuery) !== TRUE) {
            $response = [
                'status' => 'error',
                'message' => 'Error deleting comments for tweet'
            ];
            echo json_encode($response);
            exit;
        }

        $response = [
            'status' => 'success',
            'message' => 'Tweet deleted successfully'
        ];
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['tweetId'])) {
    try {
        $tweet = new DeleteTweet($_POST['tweetId']);
        $tweet->deleteTweet();
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
        echo json_encode($response);
        exit;
    }
}