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

    // function to select the username and max score for each user that took the test
    public function scoreBoard() {
        $sql = "SELECT DISTINCT username, MAX(score) as score FROM user_history, users WHERE user_history.user_id = users.id GROUP BY username ORDER BY score DESC;";
        $stmt = $this->conn->connect()->query($sql);
        $emo = "👑";
        $i = 1;
        while ($row = $stmt->fetch()) {
            if ($i != 1) $emo = "🤖";
            if ($i == 6) break;
            echo '
            <div class="row">
                <div class="name fw-bold fs-4 text-info">'.$i. ' '.$emo.' '.strtoupper($row['username']).'</div><div class="score fw-bold fs-4" style="rgb(145, 145, 198)">'.$row['score'].'</div>
            </div><hr>';
            $i++;
        }
    }
}