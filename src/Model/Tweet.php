<?php

namespace App\Model;

class Tweet extends Database
{

    public function createTweet($txtNewTweet, $txtTweetName)
    {
        if (isset($_POST['btnTweet'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $txtNewTweet = mysqli_escape_string($this->Conn, $txtNewTweet);
                $createTwQuery = "INSERT INTO tweets VALUES(null,'$txtTweetName', '$txtNewTweet',0,null,0)";
                header('Location: /twitteruzi/views/home.php');
                return $this->Conn->query($createTwQuery) === TRUE;
            }
        }
    }
}