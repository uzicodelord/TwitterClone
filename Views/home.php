<?php
require './../vendor/autoload.php';
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
}
use App\Controller\LogoutController;
if (isset($_GET['logout'])) {
    $logoutSystem = new LogoutController();
    $logoutSystem->logout();
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TwitterClone</title>
    <link href="/twitteruzi/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/twitteruzi/css/homepage.css" rel="stylesheet">
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
            xmlhttp.open("GET", "/twitteruzi/index.php/tweet/like?q=" + tweetName + "&p=" + tweetId + "&l=" + tweetlikes, false);
            xmlhttp.send();
        }

        function deleteTweet(tweetId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/twitteruzi/index.php/tweet/delete", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send("tweetId=" + tweetId);
        }

        function submitComment(tweetId, textareaId) {
            const commentText = encodeURIComponent(document.getElementById(textareaId).value);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/twitteruzi/index.php/comment/create", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    location.reload();
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
            <a style="color:white; background-color: #333;" href="/twitteruzi/Views/home.php">
                <i class="fa fa-home tabLogo "></i></a>
            <a href="profile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="edit.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="?logout"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>

        <div id="recentTw" class="mainContainer" style="height:auto;">
            <center>

                <h4>Create New Tweet</h4><br>


                <form method="post" action="/twitteruzi/index.php/tweet/create">
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
                        <form method="get" action="/twitteruzi/index.php/tweet/search">
                            <input type="search" class="txtSearch" placeholder="Search" name="txtSearch">
                            <button type="submit" name="btnSearch" class="btnSearch" value=""><span
                                        class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
            </center>
        </div>

        <div id="recentTw" class="mainContainer">
            <h4>
                <center>Recent Tweets
            </h4><br>
            <?php
            use App\Model\TweetDisplay;

            $tweetDisplay = new TweetDisplay();
            $tweets = $tweetDisplay->displayTweets();
            ?>

            <?php foreach ($tweets as $tweet): ?>
            <?php
            $username = $tweet['tweeter_name'];
            $tweetTime = $tweet['tweet_time'];
            $tweetContent = $tweet['tweet_content'];
            $tweetLikes = $tweet['tweet_likes'];
            $tweetId = $tweet['id'];
            ?>


            <div class='row eachTw'>
                <div class='col-md-12 col-xs-10'>
            <span class='postHeader'><a href='viewuser.php?user=<?php echo $username; ?>'>@<?php echo $username; ?></a><br>
            <span style='font-size:14px;margin-top:-30px; color:#bfbfbf; float:right'><?php echo $tweetTime; ?></span>
            <div style='font-family: sans-serif;'>
                <br><?php echo $tweetContent; ?><br><br><center><div class='line'></div></div></center><br>
                <p style='font-size:15px; '>
                    <a style='cursor:pointer' onclick=likeTweet('<?php echo $username; ?>','<?php echo $tweetId; ?>','<?php echo $tweetLikes; ?>') name='like' style='color:red; '>
                        <span class='fa fa-heart' id='heart' style='font-size:22px;color:red; '></span>
                    </a>
                    <span id='num_like<?php echo $tweetId; ?>'> <?php echo $tweetLikes; ?></span> people(s) liked this.
                </p>
            </span>

                    <?php if ($username == $_SESSION['username']):?>
                        <form method='post' onclick=deleteTweet('<?php echo $tweetId; ?>')>
                            <input type='hidden' name='tweetId' value='<?php echo $tweetId; ?>'>
                            <input class='btn btn-danger btn-lg'= type='button' value='Delete' style='float:right;'>
                        </form>

                    <?php endif; ?>


                    <?php $textareaId = "comment_text_$tweetId"; ?>

                    <form method='post'>
                        <input type='hidden' id='tweet_id' value='<?php echo $tweetId; ?>'>
                            <textarea id='<?php echo $textareaId; ?>' rows='1' cols='20' required style='font-size:16px;padding:10px; width:20%;float:left;'></textarea><br>
                        <button style='float:left;margin-top:-20px;' type='button' class='btn btn-success btn-lg' onclick='submitComment(<?php echo $tweetId; ?>, "<?php echo $textareaId; ?>")'>Comment</button><br><br><br>
                    </form>

                    <div class="commentBox" style="margin-top: -70px">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php $comments = $tweet['comments']; ?>
                                <?php if (!empty($comments)): ?>
                                    <h4>Comments:</h4>
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="comment">
                                            <p><b><a style="font-size: 16px;" href='viewuser.php?user=<?php echo $comment['username']; ?>'>@<?php echo $comment['username']; ?></a></b></p>
                                            <p style="font-size: 16px;"><?php echo $comment['comment_text']; ?></p>
                                            <p><small style="float:right;margin-top: -60px;"><?php echo $comment['comment_time']; ?></small></p>
                                        </div>
                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <?php endforeach; ?>



            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/twitteruzi/Bootstrap/js/bootstrap.min.js "></script>


</div>

</html>