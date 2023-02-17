<?php
require './../vendor/autoload.php';
session_start();
if (isset($_SESSION['username'])) {
    header('location: login.php');
}

use App\Model\SignUpAndSignIn;

$loginsignup = new SignUpAndSignIn();
$RegStatus = $loginsignup->getRegStatus();
$LoginStatus = $loginsignup->getLoginStatus();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TwitterClone</title>

    <!-- Bootstrap -->
    <link href="/twitteruzi/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/twitteruzi/css/index.css" rel="stylesheet">

</head>

<style>

    div {
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

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
    a {
        font-size: 20px;
        color: white;

    }
</style>


<body>


<div class="" style="color: #fff;">

    <div class="row" id="signIn">
        <form method="post">
            <div class="">
                    <h2 style="margin-bottom:10px;">Sign In <span class="glyphicon" style="color:#5b3e4d;"></span>
                    </h2><br>
                    <div class="alert alert-success alert-dismissable" style="width:25%;background-color: #333;color:#fff;"><button type="button"
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
                    <button class="btn btn-success btn-lg" style="width:13%;" name="btnSignIn"><span
                            class="glyphicon glyphicon-save"></span>&nbsp; SIGN IN</button><br><br><br>
                    <a href="signup.php">Don't have an account? Sign Up Here</a>

            </div>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/twitteruzi/Bootstrap/js/bootstrap.min.js"></script>

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