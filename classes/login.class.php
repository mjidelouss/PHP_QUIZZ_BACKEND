<?php
include_once 'DbConnection.class.php';

class Login
{
    public $conn;
    public $username;
    public $pass;

    // constructor
    public function __construct() {
        $this->conn = new DbConnection;
    }

    // function to retrieve all questions
public function checkLogin($username, $pass)
    {
        $sql = "SELECT id FROM users WHERE username = '$username' and password = '$pass'";
        $stmt = $this->conn->connect()->query($sql);
        $connect = $stmt->fetch();
        if (isset($connect['id'])) {
            $id = $connect['id'];
            return $id;
        }
    }
}