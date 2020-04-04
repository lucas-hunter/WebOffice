<?php
    include('../../include/connection.php');

    //Get the ID passed through AJAX
    $roleid = mysqli_real_escape_string($mysqli, $_POST['roleid']);
    //Run a based on the data you have
    $query = mysqli_query($mysqli, "SELECT * FROM roles WHERE id='$roleid'");
    $row = $query->fetch_assoc();
    //Pull the role name
    $rolename = $row['name'];
    //Remove everything related to the table record
    $columnremove = mysqli_query($mysqli, "ALTER TABLE permissions DROP COLUMN $rolename");
    $roleremove = mysqli_query($mysqli, "DELETE FROM roles WHERE id='$roleid'");
    //Return result messages
    if($columnremove && $roleremove){
        echo json_encode(array("statusCode"=>200,"result"=>"Done!"));
    }
    else{
        echo json_encode(array("statusCode"=>201,"result"=>"Error!"));
    }
?>