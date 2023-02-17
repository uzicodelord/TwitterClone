<?php
namespace App\Controller;

use App\Model\Comment;
use App\Model\Request;

class CommentController
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['username'])) {
            header('Location: index.php');
            exit;
        }

    }
    public function create()
    {
        $username = $_SESSION['username'];

        $comment = new Comment();
        $request = new Request();
        return $comment->createComment($request->post('comment_text'), (int) $request->post('tweet_id'), $username);
    }
}
?>