<?php
require './../vendor/autoload.php';

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
    <link href="/twitteruzi/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/twitteruzi/css/homepage.css" rel="stylesheet">
    <link href="/twitteruzi/css/editProfile.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap">

</head>

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
    <a href='profile.php' style="font-size:18px; margin-left:30px;color:#fff;"><span
            class="glyphicon glyphicon-chevron-left"></span>Back</a>


    <div id="recentTw" class="mainContainer2" style="height:auto;">
        <center>
            <h3>Update Profile</h3>
            <br>

            <?php

            use App\Controller\EditController;
            use App\Model\Request;

            $profileUpdater = new EditController();
            $request = new Request();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $request->post('txtEmail');
                $password = !empty($_POST['txtNewPassword']) ? $_POST['txtNewPassword'] : '';
                $profileUpdater->edit($email, $password);
            }

            ?>
            <form method="post" enctype="multipart/form-data" action="/twitteruzi/route.php/edit/edit">
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
<?php
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js "></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/twitteruzi/Bootstrap/js/bootstrap.min.js "></script>
</body>

</html>