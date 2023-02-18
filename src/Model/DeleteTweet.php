<?php

namespace App\Model;

class DeleteTweet extends Database
{
    private $tweetId;

    public function __construct($tweetId)
    {
        $this->tweetId = $tweetId;
        parent::__construct();
    }

    public function deleteTweet()
    {
        // Prepare the delete query
        $deleteQuery = "DELETE FROM tweets WHERE id = ?";
        $stmt = $this->Conn->prepare($deleteQuery);
        $stmt->bind_param('i', $this->tweetId);

        // Execute the delete query
        if (!$stmt->execute()) {
            $response = [
                'status' => 'error',
                'message' => 'Error deleting tweet'
            ];
            return json_encode($response);
        }

        // Prepare the delete comments query
        $deleteCommentQuery = "DELETE FROM comments WHERE tweet_id = ?";
        $stmt = $this->Conn->prepare($deleteCommentQuery);
        $stmt->bind_param('i', $this->tweetId);

        // Execute the delete comments query
        if (!$stmt->execute()) {
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