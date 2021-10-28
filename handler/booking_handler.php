<?php

require '../db/config.php';
require '../functions/index.php';

session_start();

if(isset($_POST['rent'])):

    if(isset($_SESSION['TYPE'])){
        if($_SESSION['TYPE'] === "ADMIN"){
            header("location: ../index.php?alert=users_only");
            die();
        }
    }else{
        header("location: ../login.php?alert=login");
        die();
    }

    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);
    $bookingId = generateId(12);
    $formatted_date = date("Y-m-d", strtotime($start_date));
    // Add days to date and display it
    $end_date = date('Y-m-d', strtotime($formatted_date. " + {$endDate} days"));

    $query = "INSERT INTO `booking`(`booking_id`, `vehicle_id`, `user_id`, `start_date`, `end_date`)
    VALUES (:id, :vehicleId, :userId, :startId, :endDate)";
    $result = $connect->prepare($query);
    $result->execute([
        "id" => $bookingId,
        "vehicleId" => $vehicle_id,
        "userId" => $user_id,
        "startId" => $start_date,
        "endDate" => $end_date
    ]);

    if($result){
        $query = "UPDATE `car` SET `availability` = 0 WHERE `vehicle_id` = ?";
        $result = $connect->prepare($query);
        $result->execute([$vehicle_id]);

        if($result) header("location: ../index.php?alert=car_booked");
    }

endif;
