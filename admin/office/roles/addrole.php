<?php
    include('../../include/connection.php');

    $permissions = $_POST['permissions'];
    
    $rolename = mysqli_real_escape_string($mysqli, $_POST['rolename']);
    $roledesc = mysqli_real_escape_string($mysqli, $_POST['roledesc']);

    $rolecheck = mysqli_query($mysqli, "SELECT * FROM roles WHERE name = '$rolename'");
    if(mysqli_num_rows($rolecheck) == 0){
        mysqli_query($mysqli, "INSERT INTO roles (
            name,
            description
        ) VALUES (
            '$rolename',
            '$roledesc'
        )");

        mysqli_query($mysqli, "ALTER TABLE permissions ADD $rolename BOOLEAN DEFAULT FALSE");
        
        foreach($permissions as $permission){
            mysqli_query($mysqli, "UPDATE permissions SET $rolename = 1 WHERE id = '$permission'");
        }

        echo json_encode(array("statusCode"=>200,"result"=>"Role Created!"));
    }
    else{
        echo json_encode(array("statusCode"=>201,"result"=>"User already exists!"));
    }
?>