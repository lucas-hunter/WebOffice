<?php
 include('../../include/connection.php');

 $firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
 $lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
 $username = mysqli_real_escape_string($mysqli, $_POST['username']);
 $password = mysqli_real_escape_string($mysqli, $_POST['password']);
 $passhash = password_hash($password, PASSWORD_DEFAULT);
 $email = mysqli_real_escape_string($mysqli, $_POST['email']);
 $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
 $role = mysqli_real_escape_string($mysqli, $_POST['role']);

 $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
 
 if(mysqli_num_rows($query) == 0){
    $usercreate = mysqli_query($mysqli, "INSERT INTO users (
        firstname,
        lastname,
        username,
        password,
        email,
        phone,
        role
    ) VALUES (
        '$firstname',
        '$lastname',
        '$username',
        '$passhash',
        '$email',
        '$phone',
        '$role'
    )");
    if($usercreate){
        echo json_encode(array("statusCode"=>200,"result"=>"User Created!"));
    }
    else{
        echo json_encode(array("statusCode"=>201,"result"=>"User not created, please try again!"));
    }
 }
 else{
    echo json_encode(array("statusCode"=>201,"result"=>"User already exists!"));
 }

 
?>