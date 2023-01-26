<?php
class DBConnect
{
    private $serverName;
    private $username;
    private $password;
    private $databaseName;
    public $Conn;

    public function __construct($serverName, $username, $password, $databaseName)
    {
        $this->serverName = $serverName;
        $this->username = $username;
        $this->password = $password;
        $this->databaseName = $databaseName;
    }

    public function Connect()
    {
        $this->Conn = new mysqli($this->serverName, $this->username, $this->password, $this->databaseName);

        if ($this->Conn->connect_error) {
            die ($this->Conn->connect_error);
            $this->Conn->Close();
        }
    }
}
$db = new DBConnect("localhost", "root", "", "twitteruzi");
$db->Connect();
$Conn = $db->Conn;
?>