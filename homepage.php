<?php
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
}
include './includes/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TwitterClone</title>
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap">

    <!--Ajax -->
    <script>
        function likeTweet(tweetName, tweetId, tweetlikes) {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("num_like" + tweetId).innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "/twitteruzi/classes/src/Likes/Likes.php?q=" + tweetName + "&p=" + tweetId + "&l=" + tweetlikes, false);
            xmlhttp.send();
        }

        function deleteTweet(tweetId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "classes/src/DeleteTweet/DeleteTweet.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert('Tweet deleted successfully');
                    } else {
                        alert('Error deleting tweet');
                    }
                }
            };
            xhr.send("tweetId=" + tweetId);
        }

        function submitComment(tweetId, textareaId) {
            console.log("tweetId:", tweetId);
            const commentText = encodeURIComponent(document.getElementById(textareaId).value);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "classes/src/Comment/Comment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    alert("Comment posted successfully");
                }
            };
            xhr.send(`comment_text=${commentText}&tweet_id=${tweetId}`);
        }

    </script>

    <style>
        body {
            background-color: #008abe;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            color: white;
        }

        textarea {
            resize: none;
        }
    </style>


</head>

<div class="container">
    <div class="row">
        <div class="icon-bar" style="width:100%;border:0;">
            <a style="color:white; background-color: #333;" href="homepage.php">
                <i class="fa fa-home tabLogo "></i></a>
            <a href="myProfile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="classes/src/LogOut/LogOut.php"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>

        <div id="recentTw" class="mainContainer" style="height:auto;">
            <center>

                <h4>Create New Tweet</h4><br>

                <?php

                use Tweet\Tweet;
                use Request\Request;

                $tweet = new Tweet();
                $request = new Request();

                if (isset($_POST['btnTweet'])) {
                    $txtNewTweet = $_POST['txtNewTweet'];
                    $txtTweetName = $_SESSION['username'];
                    $tweet->createTweet($txtNewTweet, $txtTweetName);
                }

                ?>



                <form method="post">
                    <textarea placeholder="What's Happening with Uzi bro?" name="txtNewTweet" rows="2" cols="90"
                        required minlength="3" style="font-size:16px;padding:10px; width:30%;"></textarea><br><br>
                    <button type="submit" name="btnTweet" class="btn btn-success btn-lg">Tweet <i
                            class="fa fa-twitter"></i></button>
                </form>
        </div>

        <div id="recentTw" class="container" style="height:auto;">

            <center>
                <div class="bSearch">
                    <div class="searchWrapper" style="margin-left:30px;">
                        <form method="get">
                            <input type="search" class="txtSearch" placeholder="Search" name="txtSearch">
                            <button type="submit" name="btnSearch" class="btnSearch" value=""><span
                                    class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
            </center>

            <?php
            use Search\Search;

            $search = new Search();
            if (isset($_GET['btnSearch'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $txtSearch = $_GET['txtSearch'];
                    $search->searchUser($txtSearch);
                }
            }
            ?>
        </div>

        <div id="recentTw" class="mainContainer">
            <h4>
                <center>Recent Tweets
            </h4><br>
            <?php
            use TweetDisplay\TweetDisplay;

            $tweetDisplay = new TweetDisplay($Conn);
            $tweetDisplay->displayTweets();
            ?>

        </div>
    </div>
</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js "></script>

</body>

</html>