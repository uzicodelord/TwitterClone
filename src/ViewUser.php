<?php
declare(strict_types=1);

namespace App;

use mysqli;

class ViewUser
{
    private $updateQuery;
    private $viewLink;
    private $result;
    private $Conn;
    public function __construct(mysqli $Conn)
    {
        $this->Conn = mysqli_connect('localhost', 'root', '', 'twitteruzi');
        $this->updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
        $this->viewLink = "viewuser.php?user=";
        $this->result = $Conn->query($this->updateQuery);
    }

    public function displayTweets(): void
    {
        while ($row = $this->result->fetch_assoc()) {
            if (isset($_GET['user']) && $row['tweeter_name'] == $_GET['user']) {
                echo "<div class='row eachTw'>
                        <div class='col-md-12 col-xs-10'>
                            <span class='postHeader'><a href='" . $this->viewLink . $row['tweeter_name'] . "'>@" . $row['tweeter_name'] . "</a><br>
                                <span style='font-size:14px;margin-top:-37px; color:#bfbfbf; float:right'>" . $row['tweet_time'] . "</span>
                             <div style='font-family: sans-serif;'
                            <br><br>" . $row['tweet_content'] . "<br><br><center><div class='line'></div></div></center><br>
                            <p style='font-size:15px; '><a style='cursor:pointer' onclick=likeTweet('" . $row['tweeter_name'] . "','" . $row['id'] . "','" . $row['tweet_likes'] . "') name='like' style='color:red; '><span class='fa fa-heart' id='heart' style='font-size:22px;color:red; '></span></a><span id='num_like" . $row['id'] . "'> " . $row['tweet_likes'] . "</span> people(s) liked this.</p>
                        </span>
                    ";
                if ($row['tweeter_name'] == $_SESSION['username']) {
                    echo "<form method='post' onclick=deleteTweet('" . $row['id'] . "')>";
                    echo "<input type='hidden' name='tweetId' value='" . $row['id'] . "'>";
                    echo "<input class='btn btn-danger btn-lg'= type='submit' value='Delete' style='float:right;'>";
                    echo "</form>";
                }
                $tweetId = $row['id'];


                echo "<form method='post'>";
                echo "<input type='hidden' id='tweet_id' value='" . $tweetId . "'>";
                $textareaId = "comment_text_" . $tweetId;
                echo "<textarea id='" . $textareaId . "' rows='1' cols='20'
                            required style='font-size:16px;padding:10px; width:20%;float:left;'></textarea><br>";
                echo "<button style='float:left;margin-top:-20px;' type='submit' class='btn btn-success btn-lg' onclick='submitComment($tweetId, \"" . $textareaId . "\")'>Comment</button><br><br><br>";
                echo "</form>";


                $getCommentsQuery = "SELECT * FROM comments JOIN tweets ON comments.tweet_id = tweets.id WHERE comments.tweet_id = $tweetId";
                $commentsResult = $this->Conn->query($getCommentsQuery);
                echo "Comments:";
                while ($comment = $commentsResult->fetch_assoc()) {
                    echo "<div id='comment_text'>";
                    echo "<span class='postHeader'><a style='font-size: 16px;font-weight:bold;' href='" . $this->viewLink . $comment['username'] . "'>@" . $comment['username'] . "</a><br>
                                            <span style='font-size:13px; color:#bfbfbf; float:right'>" . $comment['comment_time'] .
                        " </span><p style='font-size:18px;font-weight:light;'>" . $comment['comment_text'] . "</p>";
                    echo "</div>";
                }



                echo "</div></div>";
            }
        }
    }
}