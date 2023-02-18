<?php

namespace App\Model;
class SignUpAndSignIn extends Database
{
    private string $txtUsername = '';
    private string $txtPassword = '';
    private string $txtEmail = '';
    private string $txtPasswordErr = '';
    private string $txtEmailErr = '';
    private string $txtUsernameErr = '';
    private string $RegStatus = '';
    private bool $passwordIsset = false;
    private string $LoginStatus = '';

    public function __construct()
    {
        parent::__construct();

        $this->RegStatus = 'Register Here';
        $this->LoginStatus = 'Login Here';
    }

    public function signUp()
    {
        $request = new Request();
        if (isset($_POST['btnSignUp'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->txtUsername = mysqli_escape_string($this->Conn, $this->formatData($request->post('txtUsername')));

                $this->passwordIsset = false;
                $this->txtPasswordErr = "";
                $password = $request->post('txtPassword');
                if (strlen($password) < 6) {
                    $this->txtPasswordErr = "Password must be at least 6 characters long";
                } elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                    $this->txtPasswordErr = "Password must contain at least one letter and one number";
                } else {
                    $this->passwordIsset = true;
                    $this->txtPassword = mysqli_escape_string($this->Conn, $this->formatData($password));
                }

                $this->txtEmailErr = "";
                $email = $request->post('txtEmail');
                $emailIsset = false;
                if (empty($email)) {
                    $this->txtEmailErr = "Email is required";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->txtEmailErr = "Invalid Email Address";
                } else {
                    $this->txtEmail = mysqli_escape_string($this->Conn, $this->formatData($email));
                    $emailIsset = true;
                }

                if ($this->txtPasswordErr || $this->txtEmailErr) {
                    $this->RegStatus = "Not Registered";
                } else {
                    $sql = "INSERT INTO users VALUES(null, '$this->txtUsername', '$this->txtPassword', '$this->txtEmail', null)";
                    if ($this->Conn->query($sql) === true) {
                        $this->RegStatus = "Registration was Successful,<br> Please Proceed to Login..";
                        $this->txtUsername = $this->txtPassword = $this->txtEmail = "";
                        $this->txtPasswordErr = $this->txtEmailErr = $this->txtUsernameErr = "";
                        $this->passwordIsset = $emailIsset = false;
                    } else {
                        if ($this->Conn->error){
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
    }
    // Sign In function
    public function signIn()
    {
        $request = new Request();
        if (isset($_POST['btnSignIn'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $txtLoginUsername = '';
                $txtLoginUsername = mysqli_escape_string($this->Conn, $this->formatData($request->post('txtLoginUsername')));
                $txtLoginPassword = '';
                $txtLoginPassword = mysqli_escape_string($this->Conn, $this->formatData($request->post('txtLoginPassword')));
                $LoginSql = "SELECT * FROM users WHERE username = '$txtLoginUsername' AND BINARY password = '$txtLoginPassword'";
                $result = $this->Conn->query($LoginSql);
                if ($result->num_rows != 1) {
                    $this->LoginStatus = "Username or Password not valid, please try again..";
                    $txtLoginUsername = "";
                    $txtLoginPassword = "";
                } else {
                    $this->LoginStatus = "Login Here";
                    $_SESSION['username'] = $txtLoginUsername;
                    $selectQuery = "SELECT * FROM users WHERE username = '$txtLoginUsername'";
                    $result = $this->Conn->query($selectQuery);
                    $row = $result->fetch_assoc();

                    $_SESSION['email'] = $row['email'];

                    header('location:home.php');
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