<?php

namespace App;


class DeleteTweet extends Database
{
    public $tweetId;

    public function __construct($tweetId)
    {
        $this->tweetId = $tweetId;
        parent::__construct();
    }

    public function deleteTweet()
    {

        $deleteQuery = "DELETE FROM tweets WHERE id = $this->tweetId";

        if ($this->Conn->query($deleteQuery) !== TRUE) {
            $response = [
                'status' => 'error',
                'message' => 'Error deleting tweet'
            ];
            return json_encode($response);
            
        }

        $deleteCommentQuery = "DELETE FROM comments WHERE tweet_id = $this->tweetId";
        if ($this->Conn->query($deleteCommentQuery) !== TRUE) {
            $response = [
                'status' => 'error',
                'message' => 'Error deleting comments for tweet'
            ];
            return json_encode($response);
        }

        $response = [
            'status' => 'success',
            'message' => 'Tweet deleted successfully'
        ];
        return json_encode($response);
    }
}

