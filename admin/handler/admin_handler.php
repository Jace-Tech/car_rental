<?php

require "../../db/config.php";
require '../../functions/index.php';

session_start();

if (isset($_POST['reg'])):
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $type = "ADMIN";
    $userId = generateId(10);

    $query = "INSERT INTO `admin`(`id`, `firstname`, `lastname`, `email`)
    VALUES (:id, :firstname, :lastname, :email)";
    $result = $connect->prepare($query);
    $result->execute([
        "id" => $userId,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email
    ]);

    if($result){
        $query = "INSERT INTO `login`(`user_id`, `email`, `password`, `type`)
        VALUES (:id, :email, :password, :type)";
        $result = $connect->prepare($query);
        $result->execute([
            "id" =>  $userId,
            "email" => $email,
            "password" => $hashed_password,
            "type" => $type
        ]);

        if($result){
            header("Location: ../login.php?alert=r_s");
        }
    }
    else{
        header("Location: ../register.php?alert=r_e");
    }

endif;

if(isset($_POST['login'])):
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    extract($POST);

    $query = "SELECT *  FROM `login` WHERE `email` = ?";
    $result = $connect->prepare($query);
    $result->execute([$email]);

    if($result){
        $row = $result->fetch();
        $hashed_password = $row["password"];

        if(password_verify($password, $hashed_password)){
            $_SESSION['ADMIN'] = $row["user_id"];
            $_SESSION['TYPE'] = $row["type"];

            if($row["type"] === "USER"){
                header("location: ../index.php");
            }
            else{
                header("location: ../dashboard.php");
            }
        }
        else{
            header("location: ../login.php?alert=log_f");
        }
    }
    else{
        header("location: ../login.php?alert=log_f");
    }

endif;

if(isset($_GET["logout"])):
    session_destroy();
    header("location: ../index.php");
endif;
