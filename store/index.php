<?php


function getUser($connect, string $id, string $type){
    if($type === "USER"):
        $query = "SELECT * FROM `costumer` WHERE `id` = ?";
    else:
        $query = "SELECT * FROM `admin` WHERE `id` = ?";
    endif;

    $result = $connect->prepare($query);
    $result->execute([$id]);

    return $result->fetch();
}

function getCars($connect){
    $query = "SELECT * FROM `car`";
    $result = $connect->prepare($query);
    $result->execute();

    return $result->fetchAll();
}

function getCar($connect, $id){
    $query = "SELECT * FROM `car` WHERE `vehicle_id` = ?";
    $result = $connect->prepare($query);
    $result->execute([$id]);

    return $result->fetch();
}

function getAllAdmin($connect){
    $query = "SELECT * FROM `admin`";
    $result = $connect->prepare($query);
    $result->execute();

    return $result->fetchAll();
}

function getAvailableCars($connect){
    $query = "SELECT * FROM `car` WHERE `availability` = 1";
    $result = $connect->prepare($query);
    $result->execute();

    return $result->fetchAll();
}

function getAllUsers($connect){
    $query = "SELECT * FROM `costumer`";
    $result = $connect->prepare($query);
    $result->execute();

    return $result->fetchAll();
}

function getBookedCars($connect){
    $query = "SELECT * FROM `booking`";
    $result = $connect->prepare($query);
    $result->execute();

    return $result->fetchAll();
}
