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

    <!--Ajax -->
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

        <div class="icon-bar" style="width:100%;border:0;">
            <a style="color:white; background-color: #0066cc;" href="homepage.php"><i
                    class="fa fa-home tabLogo "></i></a>
            <a href="myProfile.php"><i class="fa fa-user tabLogo "></i></a>
            <a href="editProfile.php"><i class="fa fa-cog tabLogo "></i></a>
            <a href="logout.php"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>
        <div id="recentTw" class="mainContainer" style="height:auto;">
            <center>

                <h4>Create New Tweet</h4><br>


                <?php
                if (isset($_POST['btnTweet'])) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        require_once 'database/dbConfig.php';
                        $txtNewTweet = mysqli_escape_string($Conn, $_POST['txtNewTweet']);
                        $txtTweetName = $_SESSION['username'];

                        $createTwQuery = "INSERT INTO tweets VALUES(null,'$txtTweetName', '$txtNewTweet',0,null,0)";
                        if ($Conn->query($createTwQuery) === TRUE) {
                            } else {
                            echo $Conn->error;
                        }


                    }
                }
                ?>


                <form method="post">
                    <textarea placeholder="What's Happening with Uzi bro?" name="txtNewTweet" rows="2" cols="90"
                        required style="font-size:16px;padding:10px; width:30%"></textarea><br><br>
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
            $searchImg = $searchName = "";

            if (isset($_GET['btnSearch'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    require_once 'database/dbConfig.php';
                    $viewLink = "viewuser.php?user=";
                    $txtSearch = trim(mysqli_escape_string($Conn, $_GET['txtSearch']));
                    $searchQuery = "SELECT * FROM users WHERE username LIKE '%$txtSearch%' or username LIKE '%$txtSearch%' or email LIKE '%$txtSearch%'";
                    $result = $Conn->query($searchQuery);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<br><center>";
                            echo " <div class='searchResults' style=''><a href='" . $viewLink . $row['username'] . "'>
                                                    <p>@" . $row['username'] . "</p></a></div><br><br>";
                            echo "</center>";
                        }
                    } else {
                        echo "<h4 style='color:red'>User does not Exist...</h4>";
                    }
                }
            }
            ?>
        </div>

        <div id="recentTw" class="mainContainer">
            <h4>
                <center>Recent Tweets
            </h4><br>
            <?php
            require_once 'database/dbConfig.php';
            $updateQuery = "SELECT * FROM tweets ORDER BY tweet_time DESC LIMIT 0, 50";
            $viewLink = "viewuser.php?user=";
            $result = $Conn->query($updateQuery);


            while ($row = $result->fetch_assoc()) {
                echo "<div class='row eachTw'>
                            <div class='col-md-12 col-xs-10'>
                                <span class='postHeader'><a href='" . $viewLink . $row['tweeter_name'] . "'>@" . $row['tweeter_name'] . "</a><br>
                                    <span style='font-size:14px;margin-top:-37px; color:#bfbfbf; float:right'>" . $row['tweet_time'] . "</span>
                                 <div style='margin-top:-4%;font-family: sans-serif;'
                                <br><br>" . $row['tweet_content'] . "<br><br><center><div class='line'></div></div></center><br>
                                <p style='font-size:15px; '><a style='cursor:pointer' onclick=likeTweet('" . $row['tweeter_name'] . "','" . $row['id'] . "','" . $row['tweet_likes'] . "') name='like' style='color:red; '><span class='fa fa-heart' id='heart' onclick='changeColor()' style='font-size:22px;color:red; '></span></a><span id='num_like" . $row['id'] . "'> " . $row['tweet_likes'] . "</span> people(s) liked this.</p>
                            </span>
                        ";
                if ($row['tweeter_name'] == $_SESSION['username']) {
                    echo "<form method='post' action='deleteTweet.php'>";
                    echo "<input type='hidden' name='tweetId' value='" . $row['id'] . "'>";
                    echo "<input class='btn btn-danger btn-lg'= type='submit' value='Delete' style='float:right;'>";
                    echo "</form>";
                }

                echo "<form method='post' action='commentTweet.php' >";
                echo "<input type='hidden' name='tweet_id' value='" . $row['id'] . "'>";
                echo "<textarea name='comment_text' rows='1' cols='20'
                    required style='font-size:16px;padding:10px; width:20%;float:left;'></textarea><br>";
                echo "<button style='float:left;margin-top:-20px;' type='submit' class='btn btn-success btn-lg'>Comment</button><br><br><br>";
                echo "</form>";
           

                $tweetId = $row['id'];
                $getCommentsQuery = "SELECT * FROM comments JOIN tweets ON comments.tweet_id = tweets.id WHERE comments.tweet_id = $tweetId";
                $commentsResult = $Conn->query($getCommentsQuery);
                echo "Comments:";
                while ($comment = $commentsResult->fetch_assoc()) {
                    echo "<div class='comment'>";
                    echo "<span class='postHeader'><a style='font-size: 16px;font-weight:bold;' href='" . $viewLink . $comment['username'] . "'>@" . $comment['username'] . "</a><br>
                                    <span style='font-size:13px; color:#bfbfbf; float:right'>" . $comment['comment_time'] .
                        " </span><p style='font-size:18px;font-weight:light;'>" . $comment['comment_text'] . "</p>";
                    echo "</div>";
                }



                echo "</div></div>";
            }

            ?>

        </div>
    </div>
</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js "></script>
<script>
    function addPy(str) {
  if (str.startsWith('Py')) {
    console.log(str);
    return str;
  } else {
    let newStr = 'Py' + str;
    console.log(newStr);
    return newStr;
  }
}

</script>


</body>

</html>