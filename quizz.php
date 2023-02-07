<?php
  include_once './classes/questions.class.php';
  session_start();
  if (!(isset($_SESSION['connected']))) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PHP | TEST</title>
    <!-- ================== BEGIN core-css ================== -->
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="assets/sass/default/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
    <link href="assets/sass/main.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->
  </head>
  <body id="landing-body">
    <div class="stepper-wrapper mt-4">
      <div class="stepper-item completed active">
        <div class="step-counter fs-3">📜</div>
        <div class="step-name">RULES</div>
      </div>
      <div class="stepper-item completed active">
        <div class="step-counter fs-3">⏳</div>
        <div class="step-name">TEST</div>
      </div>
      <div class="stepper-item active">
        <div class="step-counter fs-3">🎯</div>
        <div class="step-name">SCORE</div>
      </div>
    </div>
      <!-- QUIZZ CONTAINER -->
      <div class="container rounded p-3" style="border: 1px solid black; background-color: whitesmoke;">
        <div class="justify-center flex-column">
          <div id="box">
            <div class="box-item">
              <p id ="progressText" class="box-para fw-bold">
                Question ❔
              </p>
              <div id="progressBar">
                <div id="progressBarFull"></div>
              </div>
            </div>
            <div class="box-item">
              <p class="box-para fw-bold">Timer ⏳</p>
              <h1 class="box-text" id="timer">30</h1>
            </div>
            <div class="box-item">
              <p class="box-para fw-bold">
                Score 🎯
              </p>
              <h1 class="box-text" id="score">0</h1>
            </div>
          </div>
          <h3 id="question" class="mb-4 mt-3">What is the answer to this question</h3>
          <div class="option-container">
            <p class="option-letter">A</p>
            <p class="option-text" id="option1" data-correct="false">Option 1</p>
          </div>
          <div class="option-container">
            <p class="option-letter">B</p>
            <p class="option-text" id="option2" data-correct="false">Option 2</p>
          </div>
          <div class="option-container">
            <p class="option-letter">C</p>
            <p class="option-text" id="option3" data-correct="false">Option 3</p>
          </div>
          <div class="option-container">
            <p class="option-letter">D</p>
            <p class="option-text" id="option4" data-correct="false">Option 4</p>
          </div>
        </div>
      </div>
    </body>
    <!-- ================== BEGIN core-js ================== -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/vendor.min.js"></script>
    <script src="./assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./assets/js/scripts.js"></script>
    <!-- ================== END core-js ================== -->
</html>