<?php
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
}
include 'includes/autoload.php';
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
    </style>


</head>
<div class="container">
    <div class="row">
        <div class="icon-bar" style="width:100%;border:0;">
            <a href="homepage.php">
                <i class="fa fa-home tabLogo "></i></a>
            <a style="color:white; background-color: #333;" href="myProfile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="classes/src/LogOut/LogOut.php"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>

        <div id="myProfile" class="mainContainer" style="height:auto;"><br>
            <div class="row">
                <h2 style="">@
                    <?php echo $_SESSION['username'] ?>
                </h2>
                <h4>Email: <b>
                        <?php echo $_SESSION['email'] ?>
                    </b></h4>
                <h5><a href="editProfile.php" style="color:#fff;float:right;">[Edit Profile]</a></h5>
            </div>

            <h4><b>My Tweets</b></h4>
        </div>
        <div id="recentTw" class="mainContainer">
            <?php
            use ViewProfile\ViewProfile;

            $profileDisplay = new ViewProfile($Conn);
            $profileDisplay->displayTweets();
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