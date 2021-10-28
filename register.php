<?php
    session_start();
    require "./store/index.php";
    require './db/config.php';

    if(isset($_SESSION["USER"])){
        $USER_DATA = getUser($connect, $_SESSION['USER'], $_SESSION["TYPE"]);
        print_r($USER_DATA);
    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrs.com</title>

        <link rel="stylesheet" href="./css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="./css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="./css/bootstrap-utilities.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/reset.css">
        <script src="./js/sweetalert.min.js"></script>
    </head>

    <body>
        <?php require "./include/alert.php"; ?>
        <header class="py-3 border-bottom">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <h2>
                        <a href="./index.php" class="text-decoration-none text-dark font-weight-bold  d-block">
                            Carrs.
                        </a>
                    </h2>

                    <ul class="p-0 m-0 d-flex align-items-center">
                        <li class="list-unstyled d-inline-block mr-2">
                            <a href="./login.php" class="btn btn-outline-dark small">
                                Login
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-2">
                            <a href="./register.php" class="btn btn-dark small">
                                Sign up
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main>
            <section class="py-5">
                <div class="mid-width">
                    <h3 class="text-dark mb-4 pb-2 font-weight text-center">Register</h3>
                    <form action="./handler/user_handler.php" method="post">
                        <div class="my-3">
                            <label  for="firstname" class="label text-dark mb-2">Firstname</label>
                            <input required type="text" id="firstname" class="form-control" name="firstname">
                        </div>

                        <div class="my-3">
                            <label  for="lastname" class="label text-dark mb-2">Lastname</label>
                            <input required type="text" id="lastname" class="form-control" name="lastname">
                        </div>

                        <div class="my-3">
                            <label  for="email" class="label text-dark mb-2">Email</label>
                            <input required type="email" id="email" class="form-control" name="email">
                        </div>

                        <div class="my-3">
                            <label  for="" class="label text-dark mb-2">Password</label>
                            <input required type="password" class="form-control" name="password">
                        </div>

                        <div class="my-3">
                            <label  for="" class="label text-dark mb-2">Phone</label>
                            <input required type="tel" class="form-control" name="phone">
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="reg" class="btn btn-dark btn-block">Submit</button>
                        </div>

                        <div class="my-3 d-flex align-items-center justify-content-end">
                            <a href="./login.php" class="text-dark">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>
