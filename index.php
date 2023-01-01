<?php
    include_once './classes/login.class.php';
    session_start();
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
        <!--header-->
        <section id="landing-section">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- youcode text-->
                        <div class="mb-lg-0 text-center text-lg-start">
                        <?php
                    $login = new Login();
                    if (isset($_POST['login'])) {
                        $_SESSION['connected'] = $login->checkLogin($_POST['userName'], $_POST['pass']);
                        if (!($_SESSION['connected'])) {
                            $_SESSION['message'] = "Wrong Credentials!!";
                        }
                    }
                    if(isset($_SESSION['connected'])) {
                        $db = new DbConnection;
                        $userid = $_SESSION['connected'];
                        $sql = "SELECT * FROM users WHERE id = $userid";
                        $stmt = $db->connect()->query($sql);
                        $row = $stmt->fetch();
                        $count = $stmt->rowCount();
                        $username = $row['username'];

                        echo '<div class="d-block pt-2" id="user">
                            <img src="./assets/img/user1.png" class="rounded-circle ms-4" width="70" alt="Image Not Found">
                            <div class="mt-1" style="margin-left: 2.6rem;">
                                <h5>'.$username.'</h5>
                            </div>
                        </div>';
                    }
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>'.$_SESSION['message'].'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION['message']);
                    }
                    ?> 
                            <div class="stepper-wrapper me-4 mt-4">
                                <div class="stepper-item completed active">
                                    <div class="step-counter fs-3">📜</div>
                                  <div class="step-name">RULES</div>
                                </div>
                                <div class="stepper-item active">
                                    <div class="step-counter fs-3">⏳</div>
                                  <div class="step-name">TEST</div>
                                </div>
                                <div class="stepper-item active">
                                    <div class="step-counter fs-3">🎯</div>
                                  <div class="step-name">SCORE</div>
                                </div>
                              </div>
                            <h1 class="display-3 lh-1" style="color: rgb(82, 136, 230); margin-top: 5rem;">PHP Knowledge Test</h1>
                            <p class="lead fw-bolder fs-5" style="color: rgba(40, 40, 38, 0.872);">Welcome to PHP Knowledge Test, we have a bank of questions concerning php if you want to test your knowledge in them click the button Start.</p>
                            <?php
                            if (isset($_SESSION['connected'])) {
                                echo '<form action="" method="POST">
                                <button type="submit" name="logout" class="btn btn-danger border rounded w-25">Logout</button>';
                                if (isset($_POST['logout'])) {
                                    unset($_SESSION['connected']);
                                    header("location: index.php");
                                }
                            }
                            else {
                                echo '<button class="btn btn-danger border rounded w-25" data-bs-toggle="modal" data-bs-target="#modal-log">Login</button>';
                            }
                            ?>
                            <a href="./quizz.php" class="btn btn-primary border rounded w-25">Start</a>
                            <button class="btn btn-warning border rounded w-25" data-bs-toggle="modal" data-bs-target="#modal-rules">Rules</button>
                        </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="landing-img">
                            <img class="img-fluid" src="./assets/img/test.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-black text-center py-3" id="landing-footer">
            <div class="container">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; YouCode QUIZZ 2022. All Rights Reserved.</div>
                    <a href="#" class="foot-item">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#" class="foot-item">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#" class="foot-item">FAQ</a>
                </div>
            </div>
        </footer>
        <!-- LOGIN MODAL -->
            <div class="modal fade" id="modal-log">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="POST">
                            <div class="modal-header d-flex justify-content-center" style="border: none;">
                                <img src="./assets/img/user.png" width="110" height="105" alt="">
                            </div>
                            <div class="modal-body">
                                <div class="" id="">
                                    <input type="text" id="profileId" name="profileId" value="" style="display: none">
                                    <label class="col-form-label text-black">Username</label>
                                    <input type="text" class="form-control" id="userName" name="userName" required/>
                                </div>
                                <div class="" id="">
                                    <label class="col-form-label text-black">Password</label>
                                    <input type="password" class="form-control" id="pass" name="pass" required />
                                </div>
                            </div>
                            <div class="modal-footer" style="border: none">
                                <button type="button" class="btn btn-primary border rounded-pill" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" id="login" class="btn btn-success rounded-pill text-white" name="login">
                                    Login
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- RULES MODAL -->
<div class="modal fade" id="modal-rules">
    <div class="modal-dialog">
        <div class="modal-content" style="background-image: url(./assets/img/color.jpg);">
                <div class="modal-header d-flex justify-content-center" style="border: none;"></div>
                <h1 class="text-center fw-bold text-white">RULES</h1>
                <div class="modal-body" id="view-body">
                    <h5 class="text-white">💡 The contestant have to answer 12 Questions in PHP.</h5>
                    <h5 class="text-white">💡 Each question has a time limit of 30 seconds</h5>
                    <h5 class="text-white">💡 With each correct question you get points.</h5>
                    <h5 class="text-center text-white mt-4">  😁😁 Good Luck 😁😁</h5>
                </div>
                <div class="modal-footer" style="border: none">
                <button type="button" class="btn btn-primary border rounded" data-bs-dismiss="modal">OK</button>
        </div>
    </div>
</div>
</div>
    </body>
    <!-- ================== BEGIN core-js ================== -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- ================== END core-js ================== -->
</html>