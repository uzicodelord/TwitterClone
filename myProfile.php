<?php
session_start();
if (!$_SESSION['username']) {
    header('location: index.php');
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
        <div class="icon-bar"  style="width:100%;border:0;">
            <a href="homepage.php"><i class="fa fa-home tabLogo "></i></a>
            <a href="myProfile.php" style="color:white; background-color: #0066cc;"><i
                    class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="logout.php"><i class="fa fa-sign-out tabLogo "></i></a>

        </div>

        <div id="myProfile" class="mainContainer"><br>
            <div class="row">
                <h2 style="padding-bottom:10px;letter-spacing:1.5px;">@
                    <?php echo $_SESSION['username'] ?>
                </h2>
                <h4>Email: <b>
                        <?php echo $_SESSION['email'] ?>
                    </b></h4>
                <h5><a href="editProfile.php">[Edit Profile]</a></h5>
            </div>

            <h4><b>My Tweets</b></h4>
        </div>
        <div id="recentTw" class="mainContainer">
            <?php
            require_once 'database/dbConfig.php';
            $updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
            $viewLink = "viewuser.php?user=";
            $result = $Conn->query($updateQuery);
            while ($row = $result->fetch_assoc()) {
                if ($row['tweeter_name'] == $_SESSION['username']) {
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js "></script>
</body>

</html>