<?php

namespace Search;
class Search
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'twitteruzi');
    }

    public function searchUser($txtSearch)
    {
        $viewLink = "viewuser.php?user=";
        $txtSearch = trim(mysqli_escape_string($this->conn, $txtSearch));
        $searchQuery = "SELECT * FROM users WHERE username LIKE '%$txtSearch%' or username LIKE '%$txtSearch%' or email LIKE '%$txtSearch%'";
        $result = $this->conn->query($searchQuery);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<br><center>";
                echo " <div class='searchResults' style=''><a href='" . $viewLink . $row['username'] . "'>
                                        <p>@" . $row['username'] . "</p></a></div><br><br>";
                echo "</center>";
            }
        } else {
            echo "<h4 style='color:red'>User does not Exist...</h4>";
        }
    }
}

$search = new Search();
