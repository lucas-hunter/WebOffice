<?php
    session_start();
    include('../include/connection.php');

    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    $usercheck = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username'");
    $rowcheck = mysqli_num_rows($usercheck);

    if($rowcheck == 1){
        $row = $usercheck->fetch_assoc();
        $hash = $row['password'];
        $password_verify = password_verify($password, $hash);
        if($password_verify){
            $_SESSION['access'] = $row['id'];
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>201,"result"=>"Incorrect Password"));
        }
    }
    else{
        echo json_encode(array("statusCode"=>201,"result"=>"User does not exist!"));
    }
?>