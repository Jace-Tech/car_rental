<?php


if(isset($_GET['alert'])):

    switch ($_GET['alert']) {
        case 'e':
            ?>
                <script type="text/javascript">
                    swal("Something went wrong!..", "", "error")
                </script>
            <?php
            break;

        case 'login':
            ?>
                <script type="text/javascript">
                    swal("Login to continue", "", "info")
                </script>
            <?php
            break;

        case 'users_only':
            ?>
                <script type="text/javascript">
                    swal("Unauthorized", "only customers can rent", "info")
                </script>
            <?php
            break;

        case 'car_booked':
            ?>
                <script type="text/javascript">
                    swal("Car Booked", "", "success")
                </script>
            <?php
            break;

        case 'r_s':
            ?>
                <script type="text/javascript">
                    swal("Resgitration successful", "", "success")
                </script>
            <?php
            break;

        case 'log_f':
            ?>
                <script type="text/javascript">
                    swal("Login Failed", "Incorrect credentials", "error")
                </script>
            <?php
            break;

        case 'car_added':
            ?>
                <script type="text/javascript">
                    swal("Car Added", "", "success")
                </script>
            <?php
            break;

        case 'car_del':
            ?>
                <script type="text/javascript">
                    swal("Car Deleted", "", "success")
                </script>
            <?php
            break;

        case 'car_updated':
            ?>
                <script type="text/javascript">
                    swal("Car Updated", "", "success")
                </script>
            <?php
            break;

        default:
            // code...
            break;
    }

endif;

?>
