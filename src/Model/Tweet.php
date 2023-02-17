<?php

namespace App\Model;

class Tweet extends Database
{


    public function createTweet(string $txtNewTweet, string $txtTweetName)
    {
        if (isset($_POST['btnTweet'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $txtNewTweet = mysqli_escape_string($this->Conn, $txtNewTweet);
                $createTwQuery = "INSERT INTO tweets VALUES(null,'$txtTweetName', '$txtNewTweet',0,null,0)";
                return $this->Conn->query($createTwQuery) === TRUE;
            }
        }
    }
}