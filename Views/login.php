
<div class="" style="color: #fff;margin-left: 30%;text-align: left">

        <form method="post" action="/twitteruzi/index.php/login/login">
                    <h2 style="margin-bottom:10px;">Sign In <span class="glyphicon" style="color:#5b3e4d;"></span>
                    </h2><br>
                    <div class="alert alert-success alert-dismissable" style="width:25%;background-color: #333;color:#fff;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $LoginStatus; ?>
                    </div>

                    <div class="form-group loginTxt">
                        <label for="txtUsername">Username</label>
                        <input type="text" id="txtUsername" name="txtLoginUsername" class="form-control" required
                               style="font-size:15px; margin-bottom:30px;">
                    </div>
                    <div class="form-group loginTxt">
                        <label for="txtPassword">Password</label>
                        <input type="password" id="txtPassword" name="txtLoginPassword" required
                               class="form-control">
                    </div>
                    <button class="btn btn-success btn-lg" style="width:13%;" name="btnSignIn"><span
                            class="glyphicon glyphicon-save"></span>&nbsp; SIGN IN</button><br><br><br>
                    <a href="/twitteruzi/index.php/signup/index">Don't have an account? Sign Up Here</a>

        </form>
