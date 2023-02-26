<?php
namespace App\Controller;

use App\BaseController;
use App\Model\DeleteTweet;
use App\Model\Request;

class DeleteController extends BaseController
{
    public function index()
    {
        $request = new Request();
        $deleteTweet = new DeleteTweet($request->post('tweetId'));
        $deleteTweet->deleteTweet();
    }
}
