<?php
    session_start();
    require "../store/index.php";
    require '../db/config.php';

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

                    <ul class="d-flex align-items-center scroll-menu">
                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./dashboard.php" class="text-decoration-none text-dark">
                                Home
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./car.php" class="text-decoration-none text-dark">
                                Cars
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-2">
                            <a href="./booked.php" class="text-decoration-none">
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
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-lg-10">
                            <div class="mt-5">

                                <?php if(count(getBookedCars($connect))):   ?>
                                    <h3 class="mb-5 mt-4">Booked Cars</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Booking ID</th>
                                                    <th>Vehicle ID</th>
                                                    <th>Customer ID</th>
                                                    <th>Starting Date</th>
                                                    <th>Ending Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $x = 1; foreach (getBookedCars($connect) as $car): extract($car); ?>
                                                    <tr>
                                                        <td><?= $x ?></td>
                                                        <td><?= $booking_id; ?></td>
                                                        <td><?= $vehicle_id; ?></td>
                                                        <td><?= $user_id; ?></td>
                                                        <td><?= date("D d, M Y", strtotime($start_date)); ?></td>
                                                        <td><?= date("D d, M Y", strtotime($end_date)); ?></td>
                                                    </tr>
                                                <?php $x++; endforeach;  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <h4 class="text-muted font-weight-light text-center">No car booked yet!</h4>
                                <?php endif;  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
