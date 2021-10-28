<?php
    session_start();
    require "./store/index.php";
    require './db/config.php';

    if(isset($_SESSION["USER"]) || isset($_SESSION["ADMIN"])){
        switch ($_SESSION["TYPE"]) {
            case 'ADMIN':
                $USER_DATA = getUser($connect, $_SESSION['ADMIN'], $_SESSION["TYPE"]);
                break;

            default:
                $USER_DATA = getUser($connect, $_SESSION['USER'], $_SESSION["TYPE"]);
                break;
        }
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

                    <?php if(isset($USER_DATA)): ?>
                        <ul class="p-0 m-0 d-flex align-items-center">
                            <li class="list-unstyled d-inline-block mr-4">
                                <h5 class="text-dark m-0">Welcome, <span><?= $USER_DATA['firstname']; ?></span> </h4>
                            </li>

                            <li class="list-unstyled d-inline-block mr-2">
                                <a href="./handler/user_handler.php?logout" class="text-danger text-decoration-none text-capitalize small">
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

        <section class="py-5">
            <div class="container">
                <div class="row g-2 justify-content-center">
                    <div class="col-12">
                        <div class="">
                            <h3 class="mb-4 mt-4">Available Cars</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Vehicle Model</th>
                                        <th>Vehicle Number</th>
                                        <th>Seating Capacity</th>
                                        <th>Rent</th>
                                        <th>Start Date</th>
                                        <th>Number of Days</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 1; foreach (getAvailableCars($connect) as $car): extract($car); ?>
                                        <form action="./handler/booking_handler.php" method="post">
                                            <tr>
                                                <td><?= $x ?></td>
                                                <td><?= $vehicle_model; ?></td>
                                                <td><?= $vehicle_number; ?></td>
                                                <td><?= $seat_capacity; ?></td>
                                                <td><?= "$ " . number_format($rent) . " / <span class='text-info' style='font-size: 12px;'>per day </span>"; ?></td>
                                                <td>
                                                    <input type="date" class="form-control" required name="start_date" value="">
                                                    <input type="hidden" name="vehicle_id" value="<?= $vehicle_id;  ?>">
                                                    <input type="hidden" name="user_id" value="<?= $USER_DATA['id']; ?>">
                                                </td>
                                                <td>
                                                    <select class="form-control" required name="endDate">
                                                        <?php for($i = 1; $i <= 31; $i++): ?>
                                                            <option value="<?= $i; ?>"> <?= $i . " " . $app = ($i == 1) ? "day" : "days"; ?> </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </td>
                                                <th>
                                                    <div class="d-flex align-items-center">
                                                        <?php if($availability):  ?>
                                                            <button type="submit" name="rent" class="btn btn-primary btn-sm">Rent Car</button>
                                                        <?php else:  ?>
                                                            <a href="?car=<?= $vehicle_id ?>" class="btn btn-primary btn-sm disabled">Booked</a>
                                                        <?php endif;  ?>
                                                    </div>
                                                </th>
                                            </tr>
                                        </form>
                                    <?php $x++; endforeach;  ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
