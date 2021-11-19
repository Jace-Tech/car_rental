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
                        <a href="./dashboard.php" class="text-decoration-none text-dark font-weight-bold  d-block">
                            Carrs.
                        </a>
                    </h2>

                    <ul class="p-0 m-0 d-flex align-items-center scroll-menu">
                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./dashboard.php" class="text-decoration-none text-dark">
                                Home
                            </a>
                        </li>

                        <li class="list-unstyled d-inline-block mr-3">
                            <a href="./car.php" class="text-decoration-none">
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
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-lg-8">
                            <?php if(isset($_GET["car"])): extract(getCar($connect, $_GET["car"])); ?>
                                <h3 class="mb-5">Update Car</h3>
                                <form action="./handler/car_handler.php" method="post">
                                    <div class="row gy-2">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="model">Vehicle Model</label>
                                                <input required type="text" value="<?= $vehicle_model; ?>" id="model" name="model" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="number">Vehicle Number</label>
                                                <input required type="text" id="number" value="<?= $vehicle_number; ?>" name="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="capacity">Seating capacity</label>
                                                <input required type="number" id="capacity" name="capacity" value="<?= $seat_capacity; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="rent">Rent per day</label>
                                                <input required type="number" id="rent" name="rent" value="<?= $rent; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit" name="edit" value="<?= $_GET["car"]; ?>" class="btn btn-dark">Update car</button>
                                        </div>
                                    </div>

                                </form>
                            <?php else:  ?>
                                <h3 class="mb-5">Add Car</h3>
                                <form action="./handler/car_handler.php" method="post">
                                    <div class="row gy-2">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="model">Vehicle Model</label>
                                                <input required type="text" id="model" name="model" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="number">Vehicle Number</label>
                                                <input required type="text" id="number" name="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="capacity">Seating capacity</label>
                                                <input required type="number" id="capacity" name="capacity" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="my-1">
                                                <label class="mb-2" for="rent">Rent per day</label>
                                                <input required type="number" id="rent" name="rent" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit" name="add" class="btn btn-dark">Add car</button>
                                        </div>
                                    </div>

                                </form>
                            <?php endif; ?>


                            <div class="mt-5">
                                <?php if(count(getCars($connect))):  ?>
                                    <h3 class="mb-5 mt-4">All Cars</h3>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Vehicle Model</th>
                                                    <th>Vehicle Number</th>
                                                    <th>Seating Capacity</th>
                                                    <th>Rent</th>
                                                    <th>Availability</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $x = 1; foreach (getCars($connect) as $car): extract($car); ?>
                                                    <tr>
                                                        <td><?= $x ?></td>
                                                        <td><?= $vehicle_model; ?></td>
                                                        <td><?= $vehicle_number; ?></td>
                                                        <td><?= $seat_capacity; ?></td>
                                                        <td><?= "$" . number_format($rent); ?></td>
                                                        <td><?= $available = ($availability) ? "Available" : "Booked" ; ?></td>
                                                        <th>
                                                            <div class="d-flex align-items-center">
                                                                <a href="?car=<?= $vehicle_id ?>" class="text-primary text-decoration-none font-weight-light text-small">Edit</a>
                                                                <a href="./handler/car_handler.php?car=<?= $vehicle_id ?>" class="text-danger ml-3 text-decoration-none font-weight-light text-small">Delete</a>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                <?php $x++; endforeach;  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <h4 class="text-muted font-weight-light text-center">No car added yet!</h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
