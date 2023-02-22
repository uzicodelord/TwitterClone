<style>
    body {
        background-color: #008abe;
        color: #fff;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        color: white;
    }
</style>


<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-push-3 cusContainer" style="padding:0px;">
        </div>
    </div>


    <br>
    <a href='/twitteruzi/index.php/home/index' style="font-size:18px; margin-left:30px;color:#fff;"><span
            class="glyphicon glyphicon-chevron-left"></span>Back to Home</a>


    <div id="recentTw" class="mainContainer2" style="height:auto;">
        <center>
            <h3>Update Profile</h3>
            <br>

            <form method="post" enctype="multipart/form-data" action="/twitteruzi/index.php/edit/edit">
                <div class="form">
                    <label for="txtNewPassword">New Password</label>
                    <input class="form-control" type="password" id="txtNewPassword" name="txtNewPassword"
                           placeholder="New Password">
                    <span style="color:#a6a6a6; font-size:11px;">(Please leave it blank if you don't wish to
                        edit your password)</span>
                    <br><br>
                    <br>
                    <label for="txtEmail">Email</label>
                    <input class="form-control" id="txtEmail" required name="txtEmail" type="text" placeholder="Email"
                           value="<?php echo $_SESSION['email'] ?>"><br>
                    <br><br>
                    <button type="submit" class="btn btn-success btn-lg"><span
                            class="glyphicon glyphicon-edit"></span>&nbsp; Save</button>
                </div>
            </form>
            </center>
            <br><br><br><br>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/twitteruzi/Bootstrap/js/bootstrap.min.js "></script>
</body>

</html>