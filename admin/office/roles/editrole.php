<?php
    include('../../include/connection.php');

    $roleid = mysqli_real_escape_string($mysqli, $_POST['roleid']);
    $query = mysqli_query($mysqli, "SELECT * FROM roles WHERE id='$roleid'");
    $row = $query->fetch_assoc();
    $name = $row['name'];
    $permissions = $_POST['permissions'];
    $rolename = mysqli_real_escape_string($mysqli, $_POST['rolename']);
    $roledesc = mysqli_real_escape_string($mysqli, $_POST['roledesc']);
    mysqli_query($mysqli, "UPDATE permissions SET $name = 0");
    foreach($permissions as $permission){
        mysqli_query($mysqli, "UPDATE permissions SET $name = 1 WHERE id='$permission'");
    }
    if($rolename != ''){
        mysqli_query($mysqli, "ALTER TABLE permissions CHANGE COLUMN $name $rolename BOOLEAN DEFAULT FALSE");
        mysqli_query($mysqli, "UPDATE roles SET name='$rolename' WHERE id='$roleid'");
    }
    if($roledesc != ''){
        mysqli_query($mysqli, "UPDATE roles SET description='$roledesc' WHERE id='$roleid'");
    }

    echo json_encode(array("statusCode"=>200,"result"=>"User Updated!"));
?>