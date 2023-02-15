<?php

namespace Comment;

use mysqli;

class Comment
{
    /**
     * @var mysqli
     */
    private $db;

    /**
     * Comment constructor.
     */
    public function __construct()
    {
        require_once 'C:/xampp/htdocs/twitteruzi/database/dbConfig.php';
        $this->db = $Conn;
    }

    /**
     * @param string $comment_text
     * @param int $tweet_id
     * @param string $username
     */
    public function createComment(string $comment_text, int $tweet_id, string $username): void
    {
        $comment_text = mysqli_escape_string($this->db, $comment_text);
        $tweet_id = mysqli_escape_string($this->db, $tweet_id);
        $createCommentQuery = "INSERT INTO comments (tweet_id, comment_text, username, comment_time) VALUES ($tweet_id,'$comment_text','$username',now())";

        if ($this->db->query($createCommentQuery) === true) {
        } else {
            echo $this->db->error;
        }
    }
}

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username'];

$comment = new Comment();
$comment->createComment($_POST['comment_text'], (int) $_POST['tweet_id'], $username);

?>