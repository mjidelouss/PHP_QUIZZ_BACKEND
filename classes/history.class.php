<?php
include_once 'DbConnection.class.php';

class History
{
    public $conn;
    public $score;
    public $dateTime;
    public $ip;
    public $osBrowser;
    public $userId;

    // constructor
    public function __construct() {
        $this->conn = new DbConnection;
    }

    // function to insert user history into database
    public function insertHistory($userId, $score, $dateTime, $ip, $osBrowser)
    {
        $sql = "INSERT INTO `user_history`(`user_id`, `date_time`, `score`, `ip_address`, `os_browser`) VALUES ('$userId','$dateTime','$score','$ip','$osBrowser')";
        $stmt = $this->conn->connect()->query($sql);
    }
}