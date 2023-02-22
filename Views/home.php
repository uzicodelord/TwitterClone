<div class="container">
    <div class="row">
        <div class="icon-bar" style="width:100%;border:0;">
            <a style="color:white; background-color: #333;" href="/twitteruzi/index.php/home/index">
                <i class="fa fa-home tabLogo "></i></a>
            <a href="/twitteruzi/index.php/profile/index"><i class="fa fa-user tabLogo "></i></a>
            <a href="/twitteruzi/index.php/edit/index"><i class="fa fa-cog tabLogo "></i></a>
            <a href="/twitteruzi/index.php/logout/index"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>
        <div id="recentTw" class="mainContainer" style="height:auto;">
            <center>
                <h4>Create New Tweet</h4><br>
                <form method="post" action="/twitteruzi/index.php/createtweet/index">
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
                        <form method="get" action="/twitteruzi/index.php/search/index">
                            <input type="search" class="txtSearch" placeholder="Search" name="txtSearch">
                            <button type="submit" name="btnSearch" class="btnSearch" value=""><span
                                        class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
            </center>
                </div>
        </div>
        <div id="recentTw" class="mainContainer">
            <h4>
                <center>Recent Tweets
            </h4><br>
            <?php foreach ($tweets as $tweet): ?>
            <div class='row eachTw'>
                <div class='col-md-12 col-xs-10'>
            <span class='postHeader'><a href='/twitteruzi/index.php/viewuser/index?user=<?php echo $tweet['tweeter_name']; ?>'>@<?php echo $tweet['tweeter_name']; ?></a><br>
            <span style='font-size:14px;margin-top:-30px; color:#bfbfbf; float:right'><?php echo $tweet['tweet_time']; ?></span>
            <div style='font-family: sans-serif;'>
                <br><?php echo $tweet['tweet_content']; ?><br><br><center><div class='line'></div></div></center><br>
                <p style='font-size:15px; '>
                    <a style='cursor:pointer' onclick=likeTweet('<?php echo $tweet['tweeter_name']; ?>','<?php echo $tweet['id']; ?>','<?php echo $tweet['tweet_likes']; ?>') name='like' style='color:red; '>
                        <span class='fa fa-heart' id='heart' style='font-size:22px;color:red; '></span>
                    </a>
                    <span id='num_like<?php echo $tweet['id']; ?>'> <?php echo $tweet['tweet_likes']; ?></span> people(s) liked this.
                </p>
            </span>

                    <?php if ($tweet['tweeter_name'] == $_SESSION['username']):?>
                        <form method='post')>
                            <input type='hidden' name='tweetId' value='<?php echo  $tweet['id']; ?>'>
                            <input type='button' onclick=deleteTweet('<?php echo $tweet['id']; ?>') class='btn btn-danger btn-lg' value='Delete' style='float:right;'>

                        </form>
                    <?php endif; ?>
                    <?php $textareaId = "comment_text" . $tweet['id']; ?>
                    <form method='post'>
                        <input type='hidden' id='tweet_id' value='<?php echo $tweet['id']; ?>'>
                            <textarea id='<?php echo $textareaId; ?>' rows='1' cols='20' required style='font-size:16px;padding:10px; width:20%;float:left;'></textarea><br>
                        <button style='float:left;margin-top:-20px;' type='button' class='btn btn-success btn-lg' onclick='submitComment(<?php echo $tweet['id']; ?>, "<?php echo $textareaId; ?>")'>Comment</button><br><br><br>
                    </form>

                    <div class="commentBox" style="margin-top: 0;">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php $comments = $tweet['comments']; ?>
                                    <h4 style="color: black;float: left" >Comments:</h4><br><br>
                                    <?php foreach ($comments as $comment): ?>
                                        <div class="comment">
                                            <p><b><a style="font-size: 16px;" href='/twitteruzi/index.php/viewuser/index?user=<?php echo $comment['username']; ?>'>@<?php echo $comment['username']; ?></a></b></p>
                                            <p style="font-size: 16px;"><?php echo $comment['comment_text']; ?></p>
                                            <p><small style="float:right;margin-top: -60px;"><?php echo $comment['comment_time']; ?></small></p>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>