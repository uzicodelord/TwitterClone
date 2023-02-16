<?php

namespace App;

class Tweet
{
    private $conn;

    public function __construct()
    {    
        $this->conn = mysqli_connect('localhost', 'root', '', 'twitteruzi');
    }
    public function createTweet(string $txtNewTweet, string $txtTweetName): void
    {
        if (isset($_POST['btnTweet'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $txtNewTweet = mysqli_escape_string($this->conn, $txtNewTweet);
                $createTwQuery = "INSERT INTO tweets VALUES(null,'$txtTweetName', '$txtNewTweet',0,null,0)";
                if ($this->conn->query($createTwQuery) === TRUE) {
                } else {
                    echo $this->conn->error;
                }
            }
        }
    }
}

?>
