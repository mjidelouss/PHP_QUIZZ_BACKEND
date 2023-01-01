<?php
  include_once './classes/history.class.php';
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
      <div class="stepper-item completed active">
        <div class="step-counter fs-3">🎯</div>
        <div class="step-name">SCORE</div>
      </div>
    </div>
      <!-- SCORE CONTAINER -->
      <div class="container d-flex justify-content-center">
        <div class="text-center mt-3 p-5 rounded" style="width: 500px; border: 1px solid black;">
            <div>
                <div class="d-flex-block">
                  <p class="fs-2">🎁</p>
                    <h3 class="fw-bold text-info">RESULTS</h3><hr>
                </div>
                <?php
                $data = json_decode($_GET['data']);
                $score = $data->score;
                $correct = $data->correct;
                $incorrect = $data->incorrect;
                $performance = $data->performance;

                $userId = $_SESSION['connected'];
                $dateTime = date('Y-m-d H:i:s');
                $ip = $_SERVER['REMOTE_ADDR'];
                $osBrowser = $_SERVER['HTTP_USER_AGENT'];

                $userHistory = new History;
                $userHistory->insertHistory($userId, $score, $dateTime, $ip, $osBrowser);
                echo '<div class="box-item d-flex mt-4">
                <p class="box-para fw-bold">Score 🎯 :</p>
                <h1 class="box-text ms-3 mt-1" id="score">'.$score.'</h1>
              </div>
              <div class="box-item d-flex">
                <p class="box-para fw-bold">Correct Questions ✔️ :</p>
                <h1 class="box-text ms-3 mt-1" id="numCorrect">'.$correct.'</h1>
              </div>
              <div class="box-item d-flex">
                <p class="box-para fw-bold">Incorrect Questions ❌ :</p>
                <h1 class="box-text ms-3 mt-1" id="numIncorrect">'.$incorrect.'</h1>
              </div>
              <div class="box-item d-flex">
                <p class="box-para fw-bold">Performance 🎉 :</p>
                <h1 class="box-text ms-3 mt-1" id="performance">'.$performance.'</h1>
              </div>
              <div class="d-flex justify-content-around mt-3">
                <a href="./index.php" class="btn btn-warning border rounded-pill w-25">Home</a>
                <a href="./quizz.php" class="btn btn-danger border rounded-pill w-25">Repeat</a>
              </div>';
                  ?>
            </div>
        </div>
    </div>
    </body>
    <!-- ================== BEGIN core-js ================== -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./assets/js/scripts.js"></script>
    <!-- ================== END core-js ================== -->
</html>