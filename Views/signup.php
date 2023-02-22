
<div class="uzi">
    <div id="#signUp">
        <form method="post" action="/twitteruzi/index.php/signup/signup">
            <center>
                <h2 style="margin-bottom:10px;">Sign Up <span class="glyphicon"></span></h2><br>
                <div class="alert alert-info alert-dismissable" style="width:30%;background-color: #333;color:#fff;"><button type="button" class="close"
                                                                                                                              data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php
                    echo $RegStatus; ?>
                </div>

                <div class="form-group">
                    <label for="txtEmail">Email</label>
                    <input type="text" name="txtEmail" class="form-control" required value="<?php echo $txtEmail; ?>">
                    <span class="errorSpan">
                        <?php echo $txtEmailErr; ?>
                    </span>
                    <br>
                </div>
                <div class="form-group">
                    <label for="txtusername">Username</label>
                    <input type="text" maxlength="10" name="txtUsername" class="form-control"
                           value="<?php echo $txtUsername; ?>" required>
                    <span class="errorSpan">
                                    <?php echo $txtUsernameErr; ?>
                                </span>
                </div><br>
                <div class="form-group">
                    <label for="txtPassword">Password</label>
                    <input type="password" name="txtPassword" class="form-control" required>
                    <span class="errorSpan">
                                    <?php echo $txtPasswordErr; ?>
                                </span>
                </div><br>
                <button class="btn btn-success btn-lg" style="width:20%;" name="btnSignUp"><span
                        class="glyphicon glyphicon-save"></span>&nbsp; SIGN UP</button><br><br><br>
                <a href="/twitteruzi/index.php/login/index">Already have an account? Login Here</a>
        </form>
                </div>
            </div>
        </div>
    </div>
