<?php
namespace App\Controller;

use App\Model\Comment;
use App\Model\Request;
use App\BaseController;
class CommentController extends BaseController
{

    public function create()
    {
        $username = $_SESSION['username'];

        $comment = new Comment();
        $request = new Request();

        $commentText = $request->post('comment_text');
        if ($commentText !== null) {
            $tweetId = (int)$request->post('tweet_id');
            $comment->createComment($commentText, $tweetId, $username);
        }
    }
}
