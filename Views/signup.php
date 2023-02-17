<?php
require './../vendor/autoload.php';
session_start();
if (isset($_SESSION['username'])) {
    header('location: index.php');
}
use App\Model\SignUpAndSignIn;
$loginsignup = new SignUpAndSignIn();
$RegStatus = $loginsignup->getRegStatus();
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
    <link href="/twitteruzi/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/twitteruzi/css/index.css" rel="stylesheet">

</head>

<style>

    div {
        width: 80%;
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

<div class="">
    <div id="#signUp">
        <form method="post">
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
                <a href="login.php">Already have an account? Login Here</a>
        </form>
    </div>
</div>
</div>



</div>

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