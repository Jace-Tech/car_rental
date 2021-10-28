<?php

require "../../db/config.php";
require "../../functions/index.php";

if (isset($_POST['add'])):
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $ID = generateId();

    $query = "INSERT INTO `car`(`vehicle_id`, `vehicle_model`, `vehicle_number`, `seat_capacity`, `rent`, `availability`)
    VALUES (:id, :model, :number, :capacity, :rent, :availability)";
    $result = $connect->prepare($query);
    $result->execute([
        "id" => $ID,
        "model" => $model,
        "number" => $number,
        "capacity" => $capacity,
        "rent" => $rent,
        "availability" => true,
    ]);

    if($result){
        header("location: ../car.php?alert=car_added");
    }
    else{
        header("location: ../car.php?alert=e");
    }
endif;

if(isset($_GET['car'])):
    $ID = $_GET['car'];

    $query = "DELETE FROM `car` WHERE `vehicle_id` = ?";
    $result = $connect->prepare($query);
    $result->execute([$ID]);

    if ($result) {
        header("location: ../car.php?alert=car_del");
    }
endif;

if(isset($_POST['edit'])):
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $query = "UPDATE `car` SET `vehicle_model` = :model, `vehicle_number` = :number, `seat_capacity` = :seat, `rent` = :rent WHERE `vehicle_id` = :id";
    $result = $connect->prepare($query);
    $result->execute([
        "model" => $model,
        "number" => $number,
        "seat" => $capacity,
        "rent" => $rent,
        "id" => $edit
    ]);

    if($result){
        header("location: ../car.php?alert=car_updated");
    }
endif;
