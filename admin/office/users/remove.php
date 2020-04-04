<?php
    include('../../include/connection.php');

    //Get the ID passed through AJAX
    $userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
    //Remove everything related to the table record
    $userremove = mysqli_query($mysqli, "DELETE FROM users WHERE id='$userid'");
    //Return result messages
    if($userremove){
        echo json_encode(array("statusCode"=>200,"result"=>"Done!"));
    }
    else{
        echo json_encode(array("statusCode"=>201,"result"=>"Error!"));
    }
?>