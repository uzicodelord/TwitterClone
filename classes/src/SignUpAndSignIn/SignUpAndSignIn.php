<?php

namespace SignUpAndSignIn;

class SignUpAndSignIn
{
    private $txtUsername, $txtPassword, $txtEmail, $txtPasswordErr, $txtEmailErr, $txtUsernameErr, $RegStatus, $passwordIsset, $emailIsset, $LoginStatus, $txtLoginUsername, $txtLoginPassword, $txtLoginUsernameErr, $txtLoginPasswordErr, $Conn;

    public function __construct()
    {
        $this->Conn = mysqli_connect('localhost', 'root', '', 'twitteruzi');

        $this->txtUsername = $this->txtPassword = $this->txtEmail = "";
        $this->txtPasswordErr = $this->txtEmailErr = $this->txtUsernameErr = "";
        $this->RegStatus = "Register Here";
        $this->passwordIsset = $this->emailIsset = false;

        $this->LoginStatus = "Login Here";
        $this->txtLoginUsername = $this->txtLoginPassword = "";
        $this->txtLoginUsernameErr = $this->txtLoginPasswordErr = "";

    }

    public function signUp()
    {
        if (isset($_POST['btnSignUp'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->txtUsername = mysqli_escape_string($this->Conn, $this->formatData($_POST['txtUsername']));
                $this->txtUsername = ucfirst($this->txtUsername);

                if (strlen($_POST['txtPassword']) < 6) {
                    $this->txtPasswordErr = "Password must be atleast 6 characters long";
                    $this->RegStatus = "Not Registered";
                } else {
                    $this->passwordIsset = true;
                    $this->txtPassword = mysqli_escape_string($this->Conn, $this->formatData($_POST['txtPassword']));
                }
                $email = $_POST['txtEmail'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->txtEmailErr = "Invalid Email Address";
                    $this->RegStatus = "Not Registered";
                } else {
                    $this->txtEmailErr = "";
                    $this->emailIsset = true;
                    $this->txtEmail = mysqli_escape_string($this->Conn, $this->formatData($_POST['txtEmail']));
                }

                $sql = "INSERT INTO users VALUES(null, '$this->txtUsername', '$this->txtPassword', '$this->txtEmail', null)";

                if ($this->Conn->query($sql) === true) {
                    $this->RegStatus = "Registration was Successful,<br> Please Proceed to Login..";
                    $this->txtUsername = $this->txtPassword = $this->txtEmail = "";
                    $this->txtPasswordErr = $this->txtEmailErr = $this->txtUsernameErr = "";
                    $this->passwordIsset = $this->emailIsset = false;
                } else {
                    //Username availiabilty..
                    if ($this->Conn->error == "Duplicate entry '$this->txtUsername' for key 'username'") {
                        $this->RegStatus = "Username already exist Please choose another";
                        $this->txtUsernameErr = "Invalid Username";
                    } else {
                        $this->RegStatus = "Error: <br>" . $this->Conn->error;
                        $this->txtUsernameErr = "";
                    }
                }
                $this->Conn->close();
            }
        }
    }
    // Sign In function
    public function signIn()
    {
        if (isset($_POST['btnSignIn'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->txtLoginUsername = mysqli_escape_string($this->Conn, $this->formatData($_POST['txtLoginUsername']));
                $this->txtLoginPassword = mysqli_escape_string($this->Conn, $this->formatData($_POST['txtLoginPassword']));
                $LoginSql = "SELECT * FROM users WHERE username = '$this->txtLoginUsername' AND BINARY password = '$this->txtLoginPassword'";
                $result = $this->Conn->query($LoginSql);
                if ($result->num_rows != 1) {
                    $this->LoginStatus = "Username or Password not valid, please try again..";
                    $this->txtLoginUsername = "";
                    $this->txtLoginPassword = "";
                } else {
                    $this->LoginStatus = "Login Here";
                    $_SESSION['username'] = $this->txtLoginUsername;
                    $selectQuery = "SELECT * FROM users WHERE username = '$this->txtLoginUsername'";
                    $result = $this->Conn->query($selectQuery);
                    $row = $result->fetch_assoc();

                    $_SESSION['email'] = $row['email'];

                    header('location:homepage.php');
                }
            }
        }
    }

    // formatData function
    public function formatData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function getLoginStatus(){
        $this->signIn();
        return $this->LoginStatus;
    }

    public function getRegStatus(){
        $this->signUp();
        return $this->RegStatus;
    }
    public function getTxtEmail()
    {
        return $this->txtEmail;
    }

    public function setTxtEmail($txtEmail)
    {
        $this->txtEmail = $txtEmail;
    }

    public function getTxtEmailErr()
    {
        return $this->txtEmailErr;
    }

    public function setTxtEmailErr($txtEmailErr)
    {
        $this->txtEmailErr = $txtEmailErr;
    }

    public function getTxtUsername()
    {
        return $this->txtUsername;
    }

    public function setTxtUsername($txtUsername)
    {
        $this->txtUsername = $txtUsername;
    }

    public function getTxtUsernameErr()
    {
        return $this->txtUsernameErr;
    }

    public function setTxtUsernameErr($txtUsernameErr)
    {
        $this->txtUsernameErr = $txtUsernameErr;
    }

    public function getTxtPassword()
    {
        return $this->txtPassword;
    }

    public function setTxtPassword($txtPassword)
    {
        $this->txtPassword = $txtPassword;
    }

    public function getTxtPasswordErr()
    {
        return $this->txtPasswordErr;
    }

    public function setTxtPasswordErr($txtPasswordErr)
    {
        $this->txtPasswordErr = $txtPasswordErr;
    }
}


?>