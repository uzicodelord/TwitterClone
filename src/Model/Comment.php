<?php

namespace App\Model;

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

    public function getCommentForTweet(int $tweet_id): array
    {
        $query = "SELECT * FROM comments WHERE tweet_id =" . $tweet_id;
        $commentsResult = $this->Conn->query($query);
        $comments = [];
        while($row = $commentsResult->fetch_assoc()) {
            $comments[] = $row;
        }
        return $comments;
    }
}
