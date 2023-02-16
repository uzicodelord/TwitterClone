<?php

namespace App\Model;
use App\Database;

class Comment extends Database
{


    /**
     * @param string $comment_text
     * @param int $tweet_id
     * @param string $username
     */
    public function createComment(string $comment_text, int $tweet_id, string $username): void
    {
        $comment_text = mysqli_escape_string($this->Conn, $comment_text);
        $tweet_id = mysqli_escape_string($this->Conn, $tweet_id);
        $createCommentQuery = "INSERT INTO comments (tweet_id, comment_text, username, comment_time) VALUES ($tweet_id,'$comment_text','$username',now())";

        if ($this->Conn->query($createCommentQuery) === true) {
        } else {
            echo $this->Conn->error;
        }
    }
}


?>