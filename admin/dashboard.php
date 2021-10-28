<?php
    session_start();
    require '../db/config.php';
    require "../store/index.php";

    if(!isset($_SESSION["ADMIN"])){
        header("location: ../index.php");
    }

    $USER_DATA = getUser($connect, $_SESSION["ADMIN"], $_SESSION["TYPE"]);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrs.com</title>

        <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="../css/bootstrap-utilities.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/reset.css">

        <script src="../js/sweetalert.min.js" charset="utf-8"></script>
    </head>

    <body>
        <?php require '../include/alert.php'; ?>
        <header class="py-3 border-bottom">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <h2>
                        <a href="../index.php" class="text-decoration-none text-dark font-weight-bold  d-block">
                            Carrs.
                        </a>
                    </h2>

                    <ul class="p-0 m-0 d-flex align-items-center scroll-menu">
                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./dashboard.php" class="text-decoration-none">
                                Home
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./car.php" class="text-decoration-none text-dark">
                                Cars
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-2">
                            <a href="./booked.php" class="text-decoration-none text-dark">
                                Bookings
                            </a>
                        </li>
                    </ul>

                    <?php if(isset($USER_DATA)): ?>
                        <ul class="p-0 m-0 d-flex align-items-center">
                            <li class="list-unstyled d-inline-block mr-4">
                                <h5 class="text-dark m-0">Welcome, <span><?= $USER_DATA['firstname']; ?></span> </h4>
                            </li>

                            <li class="list-unstyled d-inline-block mr-2">
                                <a href="../handler/user_handler.php?logout" class="text-danger text-decoration-none text-capitalize small">
                                    logout
                                </a>
                            </li>
                        </ul>
                    <?php else:  ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <main>
            <section class="py-5">
                <div class="container">
                    <div class="row gy-3">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <a href="./car.php" class="d-block text-decoration-none rounded-lg p-4 py-3 shadow-sm">
                                <h5 class="text-dark mb-2">No of cars: </h5>
                                <h1 class="text-muted m-0"><?= count(getCars($connect));  ?></h1>
                            </a>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <a href="./car.php" class="d-block text-decoration-none rounded-lg p-4 py-3 shadow-sm">
                                <h5 class="text-dark mb-2">No of available car: </h5>
                                <h1 class="text-muted m-0"><?=  count(getAvailableCars($connect)); ?></h1>
                            </a>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <a href="" class="d-block text-decoration-none rounded-lg p-4 py-3 shadow-sm">
                                <h5 class="text-dark mb-2">No of costumer: </h5>
                                <h1 class="text-muted m-0"><?= count(getAllUsers($connect)); ?></h1>
                            </a>
                        </div>

                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <a href="#" class="d-block text-decoration-none rounded-lg p-4 py-3 shadow-sm">
                                <h5 class="text-dark mb-2">No of booked cars: </h5>
                                <h1 class="text-muted m-0"><?= count(getBookedCars($connect)); ?></h1>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
