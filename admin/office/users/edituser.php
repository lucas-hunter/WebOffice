<?php
    include('../../include/connection.php');

    $userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
    $username = mysqli_real_escape_string($mysqli, $_POST['editusername']);
    $password = mysqli_real_escape_string($mysqli, $_POST['editpassword']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $firstname = $_POST['editfirstname'];
    $lastname = mysqli_real_escape_string($mysqli, $_POST['editlastname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['editemail']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['editphone']);
    $role = mysqli_real_escape_string($mysqli, $_POST['editrole']);

    if(!empty($username)){
        mysqli_query($mysqli, "UPDATE users SET username='$username' WHERE id='$userid'");
    }
    if(!empty($password)){
        mysqli_query($mysqli, "UPDATE users SET password='$password_hash' WHERE id='$userid'");
    }
    if(!empty($firstname)){
        mysqli_query($mysqli, "UPDATE users SET firstname='$firstname' WHERE id='$userid'");
    }
    if(!empty($lastname)){
        mysqli_query($mysqli, "UPDATE users SET lastname='$lastname' WHERE id='$userid'");
    }
    if(!empty($email)){
        mysqli_query($mysqli, "UPDATE users SET email='$email' WHERE id='$userid'");
    }
    if(!empty($phone)){
        mysqli_query($mysqli, "UPDATE users SET phone='$phone' WHERE id='$userid'");
    }
    if(!empty($role)){
        mysqli_query($mysqli, "UPDATE users SET role='$role' WHERE id='$userid'");
    }

    echo json_encode(array("statusCode"=>200,"result"=>"User Updated!"));
?>