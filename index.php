<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: homepage.php');
}
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

<body>
    <?php

    require_once 'database/dbConfig.php';

    // for Sign UP
    $txtUsername = $txtPassword = $txtEmail = "";
    $txtPasswordErr = $txtEmailErr = $txtUsernameErr = "";
    $RegStatus = "Register Here";
    $passwordIsset = $emailIsset = false;

    // for Sign In
    $LoginStatus = "Login Here";
    $txtLoginUsername = $txtLoginPassword = "";
    $txtLoginUsernameErr = $txtLoginPasswordErr = "";


    if (isset($_POST['btnSignUp'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {



            $txtUsername = mysqli_escape_string($Conn, formatData($_POST['txtUsername']));
            $txtUsername = ucfirst($txtUsername);


            if (strlen($_POST['txtPassword']) < 6) {
                $txtPasswordErr = "Password must be atleast 6 characters long";
                $RegStatus = "Not Registered";
            } else {
                $passwordIsset = true;
                $txtPassword = mysqli_escape_string($Conn, formatData($_POST['txtPassword']));
            }


        }

        if (!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)) {
            $txtEmailErr = "Invalid Email Address";
            $RegStatus = "Not Registered";
        } else {
            $txtEmailErr = "";
            $emailIsset = true;
            $txtEmail = mysqli_escape_string($Conn, formatData($_POST['txtEmail']));
        }


        $sql = "INSERT INTO users VALUES(null, '$txtUsername', '$txtPassword', '$txtEmail', null)";

        if ($Conn->query($sql) === TRUE) {
            $RegStatus = "Registration was Successful,<br> Please Proceed to Login..";
            $txtUsername = $txtPassword = $txtEmail = "";
            $txtPasswordErr = $txtEmailErr = $txtUsernameErr = "";
            $passwordIsset = $emailIsset = false;
        } else {
            //Username availiabilty..
            if ($Conn->error == "Duplicate entry '$txtUsername' for key 'username'") {
                $RegStatus = "Username already exist Please choose another";
                $txtUsernameErr = "Invalid Username";
            } else {
                $RegStatus = "Error: <br>" . $Conn->error;
                $txtUsernameErr = "";
            }
        }

        $Conn->close();


    }



    if (isset($_POST['btnSignIn'])) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $txtLoginUsername = mysqli_escape_string($Conn, formatData($_POST['txtLoginUsername']));
            $txtLoginPassword = mysqli_escape_string($Conn, formatData($_POST['txtLoginPassword']));
            $LoginSql = "SELECT * FROM users WHERE username = '$txtLoginUsername' AND BINARY password = '$txtLoginPassword'";
            $result = $Conn->query($LoginSql);
            if ($result->num_rows != 1) {
                $LoginStatus = "Username or Password not valid, please try again..";
                $txtLoginUsername = "";
                $txtLoginPassword = "";
            } else {
                $LoginStatus = "Login Here";
                $_SESSION['username'] = $txtLoginUsername;
                $selectQuery = "SELECT * FROM users WHERE username = '$txtLoginUsername'";
                $result = $Conn->query($selectQuery);
                $row = $result->fetch_assoc();

                $_SESSION['email'] = $row['email'];

                header('location:homepage.php');

            }
        }
    }

    function formatData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>



    <div class="container-fluid" style="color: black">

        <div class="row" id="signIn">
            <form method="post">
                <div class="col-md-6 col-xs-12 signInTab">
                    <center>
                        <h2 style="margin-bottom:10px;">Sign In <span class="glyphicon" style="color:#5b3e4d;"></span>
                        </h2><br>
                        <div class="alert alert-success alert-dismissable" style="width:70%;"><button type="button"
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
                            <div class="alert alert-info alert-dismissable"><button type="button" class="close"
                                    data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $RegStatus; ?>
                            </div>

                            <div class="form-group">
                                <label for="txtEmail">Email</label>
                                <input type="text" name="txtEmail" class="form-control" required
                                    value="<?php echo $txtEmail; ?>">
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $('body').scrollspy({
            target: ".navbar",
            offset: 50
        });

        // Add smooth scrolling to all links inside a navbar
        $("#navBar a").on('click', function(event) {

            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash (#)
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area (the speed of the animation)
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function() {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        });

    })
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>

</html>