<?php
require './vendor/autoload.php';
session_start();
if (isset($_SESSION['username'])) {
    header('location: homepage.php');
}
use App\SignUpAndSignIn;
$loginsignup = new SignUpAndSignIn();
$RegStatus = $loginsignup->getRegStatus();
$LoginStatus = $loginsignup->getLoginStatus();
$txtEmail = $loginsignup->getTxtEmail();
$txtEmailErr = $loginsignup->getTxtEmailErr();
$txtUsername = $loginsignup->getTxtUsername();
$txtUsernameErr = $loginsignup->getTxtUsernameErr();
$txtPassword = $loginsignup->getTxtPassword();
$txtPasswordErr = $loginsignup->getTxtPasswordErr();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TwitterClone</title>

    <!-- Bootstrap -->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/index.css" rel="stylesheet">

</head>

<style>
    body {
        background-color: #008abe;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        color: #fff;
    }

    label {
        color: #fff;
    }
</style>


<body>


    <div class="container-fluid" style="color: #fff;">

        <div class="row" id="signIn">
            <form method="post">
                <div class="col-md-6 col-xs-12 signInTab">
                    <center>
                        <h2 style="margin-bottom:10px;">Sign In <span class="glyphicon" style="color:#5b3e4d;"></span>
                        </h2><br>
                        <div class="alert alert-success alert-dismissable" style="width:60%;background-color: #333;color:#fff;"><button type="button"
                                class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
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
                        <button class="btn btn-success btn-lg" style="width:60%;" name="btnSignIn"><span
                                class="glyphicon glyphicon-save"></span>&nbsp; SIGN IN</button>
                </div>
            </form>

            <div class="col-md-6 col-xs-12">
                <div class="signUpTxt" id="#signUp">
                    <form method="post">
                        <center>
                            <h2 style="margin-bottom:10px;">Sign Up <span class="glyphicon"></span></h2><br>
                            <div class="alert alert-info alert-dismissable" style="width:100%;background-color: #333;color:#fff;"><button type="button" class="close"
                                    data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php
                                echo $RegStatus; ?>
                            </div>

                            <div class="form-group">
                                <label for="txtEmail">Email</label>
                                <input type="text" name="txtEmail" class="form-control" required value="
                                <?php
                                echo $txtEmail; ?>">
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
                            <button class="btn btn-success btn-lg" style="width:100%;" name="btnSignUp"><span
                                    class="glyphicon glyphicon-save"></span>&nbsp; SIGN UP</button>



                    </form>
                </div>
            </div>
        </div>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('body').scrollspy({
                target: ".navbar",
                offset: 50
            });

            $("#navBar a").on('click', function (event) {

                event.preventDefault();

                // Store hash (#)
                var hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {
                    window.location.hash = hash;
                });
            });

        })
    </script>
</body>

</html>