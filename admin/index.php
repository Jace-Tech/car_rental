<?php
    session_start();
    require "../store/index.php";
    require '../db/config.php';

    if(isset($_SESSION["ADMIN"])){
        header("location: ./dashboard.php");
    }


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
        <main>
            <section class="py-5 mt-5">
                <div class="mid-width">
                    <h3 class="text-dark mb-4 pb-2 font-weight text-center">Login</h3>
                    <form action="./handler/admin_handler.php" method="post">
                        <div class="my-3">
                            <label  for="email" class="label text-dark mb-2">Email</label>
                            <input required type="email" id="email" class="form-control" name="email">
                        </div>

                        <div class="my-3">
                            <label  for="" class="label text-dark mb-2">Password</label>
                            <input required type="password" class="form-control" name="password">
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="login" class="btn btn-dark btn-block">Submit</button>
                        </div>

                        <div class="my-3 d-flex align-items-center justify-content-end">
                            <a href="./register.php" class="text-dark">Don't have an account?</a>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>
