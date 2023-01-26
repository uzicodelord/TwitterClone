<?php
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
}

require_once 'database/dbConfig.php';
$userToView = $_GET['user'];
$sql = "SELECT * FROM users WHERE username='$userToView'";
$result = $Conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $email = $row['email'];
    $reg_date = $row['reg_date'];
}
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
            xmlhttp.open("GET", "likeTweet.php?q=" + tweetName + "&p=" + tweetId + "&l=" + tweetlikes, false);
            xmlhttp.send();
        }
    </script>

</head>



<div class="container">
    <div class="row">
        <div class="icon-bar">
            <a style="color:white; background-color: #0066cc;" href="homepage.php"><i
                    class="fa fa-home tabLogo "></i></a>
            <a href="myProfile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="logout.php"><i class="fa fa-sign-out"></i></a>
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
        require_once 'database/dbConfig.php';
        $updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
        $query = "SELECT * FROM users WHERE username = '$username'";
        $viewLink = "viewuser.php?user=";
        $result = $Conn->query($updateQuery);
        while ($row = $result->fetch_assoc()) {
            if ($row['tweeter_name']) {
                echo "<div class='row eachTw'>
            <div class='col-md-12 col-xs-10'>
                <span class='postHeader'><a href='" . $viewLink . $row['tweeter_name'] . "'>@" . $row['tweeter_name'] . "</a><br>
                    <span style='font-size:14px; color:#bfbfbf; float:right'>" . $row['tweet_time'] . "</span>
                </span> <i class='fa fa-clock-o' style='padding-top:3px; color:#bfbfbf; float:right;'>&nbsp;</i>
                <br><br>" . $row['tweet_content'] . "<br><br><center><div class='line'></div></center><br>
                <p style='font-size:15px; '><a style='cursor:pointer' onclick=likeTweet('" . $row['tweeter_name'] . "','" . $row['id'] . "','" . $row['tweet_likes'] . "') name='like' style='color:black; '><span class='fa fa-thumbs-up ' style='font-size:32px; '></span></a><span id='num_like" . $row['id'] . "'> " . $row['tweet_likes'] . "</span> people(s) liked this.</p>
            </div>
        </div>";

            }
        }

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