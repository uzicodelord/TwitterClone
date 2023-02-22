<div class="container">
    <div class="row">
        <div class="icon-bar" style="width:100%;border:0;">
            <a  href="/twitteruzi/index.php/home/index">
                <i class="fa fa-home tabLogo "></i></a>
            <a style="color:white; background-color: #333;" href="/twitteruzi/index.php/profile/index"><i class="fa fa-user tabLogo "></i></a>
            <a href="/twitteruzi/index.php/edit/index"><i class="fa fa-cog tabLogo "></i></a>
            <a href="/twitteruzi/logout/index"><i class="fa fa-sign-out tabLogo "></i></a>
        </div>

        <br><br><br><br>

        <div id="recentTw" class="mainContainer">

            <?php foreach ($tweets as $tweet): ?>
            <?php if (isset($_GET['user']) && $tweet['tweeter_name'] == $_GET['user']):?>
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
                        <form method='post' onclick=deleteTweet('<?php echo $tweet['id']; ?>')>
                            <input type='hidden' name='tweetId' value='<?php echo $tweet['id']; ?>'>
                            <input class='btn btn-danger btn-lg'= type='button' value='Delete' style='float:right;'>
                        </form>

                        <?php $textareaId = "comment_text" . $tweet['id']; ?>
                        <form method='post'>
                            <input type='hidden' id='tweet_id' value='<?php echo $tweet['id']; ?>'>
                            <textarea id='<?php echo $textareaId; ?>' rows='1' cols='20' required style='font-size:16px;padding:10px; width:20%;float:left;'></textarea><br>
                            <button style='float:left;margin-top:-20px;' type='button' class='btn btn-success btn-lg' onclick='submitComment(<?php echo $tweet['id']; ?>, "<?php echo $textareaId; ?>")'>Comment</button><br><br><br>
                        </form>

                        <div class="commentBox" style="margin-top: -70px">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if (count($tweet['comments'])): ?>
                                        <h4>Comments:</h4>
                                        <?php foreach ($tweet['comments'] as $comment): ?>
                                            <div class="comment">
                                                <p><b><a style="font-size: 16px;" href='/twitteruzi/index.php/viewuser/index?user=<?php echo $comment['username']; ?>'>@<?php echo $comment['username']; ?></a></b></p>
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
                <?php endif; ?>
            <?php endforeach; ?>
