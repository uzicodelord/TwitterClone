<?php

class Comment {
    private $db;

    public function __construct() {
        require_once 'database/dbConfig.php';
        $this->db = $Conn;
    }

    public function createComment($comment_text, $tweet_id, $username) {
  
        $comment_text = mysqli_escape_string($this->db, $comment_text);
        $tweet_id = mysqli_escape_string($this->db, $tweet_id);
        $createCommentQuery = "INSERT INTO comments (tweet_id, comment_text, username, comment_time) VALUES($tweet_id,'$comment_text','$username',now())";

        if ($this->db->query($createCommentQuery) === TRUE) {
            header('location: homepage.php');
        } else {
            $this->db->error;
        }
    }
}
session_start();
if (!$_SESSION['username']) {
    $username = $_SESSION['username'];
    header('location: index.php');
}
$comment = new Comment();
$comment->createComment($_POST['comment_text'], $_POST['tweet_id'], $_SESSION['username']);
?>