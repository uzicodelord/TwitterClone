<?php
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
}

require_once 'includes/autoload.php';
$userToView = $_GET['user'];
use User\User;

$user = new User($userToView);
$username = $user->getUsername();
$email = $user->getEmail();
$reg_date = $user->getRegDate();

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
                    location.reload();
                }
            };
            xhr.send(`comment_text=${commentText}&tweet_id=${tweetId}`);
        }

    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            <a href="myProfile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="classes/src/LogOut/LogOut.php"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>
        <div style="background-color:white;">
            <div style="float:right; margin-top:30px; margin-right:10px;">
            </div>
        </div <div id="myProfile" class="container"><br>
        <h4><b>
                <center>
                    <?php echo $userToView ?>'s Profile
            </b></h4><br>
        <div class="row">


            <h2 style="padding-bottom:10px;letter-spacing:1.5px;">@
                <?php echo $username ?>
            </h2>
            <h4>Email: <b>
                    <?php echo $email ?>
                </b></h4>
            <h4>Member Since: <b>
                    <?php echo $reg_date ?>
                </b></h4>

        </div>
    </div>

    <h4><b>
            <?php echo $userToView ?>'s Tweets
        </b></h4>

    <div id="recentTw" class="mainContainer">
        <?php
        use ViewUser\ViewUser;

        $viewUser = new ViewUser($Conn);
        $viewUser->displayTweets();
        ?>

    </div>
</div>
</div>
</div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<script src="bootstrap/js/bootstrap.min.js "></script>
</body>

</html>