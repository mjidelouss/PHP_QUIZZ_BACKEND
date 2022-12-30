<?php
include_once 'DbConnection.class.php';

class Questions
{
    public $conn;
    public $question;
    public $options;
    public $answer;

    // constructor
    public function __construct() {
        $this->conn = new DbConnection;
    }

    // function to retrieve all questions
public function getQuestions()
{
    $sql="SELECT * FROM questions";
    $stmt = $this->conn->connect()->query($sql);
    // Initialize an array to store the questions
    $questions = array();
    // Loop through the result and create a new Questions object for each row
    while ($row = $stmt->fetch()) {
        $question = new Questions();
        $question->question = $row["question"];
        $question->options = explode(',', $row['options']);
        $question->answer = $row["answer"];
        array_push($questions, $question);
    }
    // Return the array of Questions objects
    return $questions;
}


}