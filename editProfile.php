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
    <link href="css/editProfile.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap">

</head>


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3 cusContainer" style="padding:0px;">
                    </div>
                </div>
                

                <br>
                <a href='myProfile.php' style="font-size:18px; margin-left:30px;"><span
                        class="glyphicon glyphicon-chevron-left"></span>Back</a>


                <div id="recentTw" class="mainContainer2" style="height:auto;">
                    <center>
                        <h3>Update Profile</h3>
                        <br>

                        <?php
                        require_once 'database/dbConfig.php';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $txtEmail = formatData($_POST['txtEmail']);



                            if (empty($_POST['txtNewPassword'])) {
                                $sql = "UPDATE users SET email='$txtEmail' WHERE username='" . $_SESSION['username'] . "'";
                                $Conn->query($sql);
                                echo "<center><div class='alert alert-success alert-dismissable' style='width:70%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Profile Was Updated Successfully..</div></center>";

                               
                            }

                            if (!empty($_POST['txtNewPassword'])) {
                                if ($_POST['txtNewPassword']) {
                                    $txtPassword = formatData($_POST['txtNewPassword']);
                                    $sql = "UPDATE users SET password='$txtPassword', email='$txtEmail' WHERE username='" . $_SESSION['username'] . "'";
                                    $Conn->query($sql);
                                    echo "<center><div class='alert alert-success alert-dismissable' style='width:70%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Profile Was Updated Successfully..</div></center>";
                                    $_SESSION['email'] = $txtEmail;
                                } else {
                                    echo "<center><div class='alert alert-danger alert-dismissable' style='width:70%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password Do not match...</div></center>";
                                }

                            }
                        }

                        function formatData($data)
                        {
                            $data = htmlspecialchars($data);
                            $data = stripslashes($data);
                            $data = trim($data);
                            return $data;
                        }
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form">
                                <label for="txtNewPassword">New Password</label>
                                <input class="form-control" type="password" id="txtNewPassword" name="txtNewPassword"
                                    placeholder="New Password">
                                <span style="color:#a6a6a6; font-size:11px;">(Please leave it blank if you don't wish to
                                    edit your password)</span>
                                <br><br>
                                <br>
                                <label for="txtEmail">Email</label>
                                <input class="form-control" id="txtEmail" required name="txtEmail" type="text"
                                    placeholder="Email" value="<?php echo $_SESSION['email'] ?>"><br>
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
    <script src="bootstrap/js/bootstrap.min.js "></script>
</body>

</html>