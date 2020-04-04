<?php 
    include('include/connection.php'); 

    $dbcheck = "SHOW TABLES FROM $database";
    $result = mysqli_query($mysqli,$dbcheck);   

    if($result->num_rows == 0){
        header ('Location: install/');
	die;
    }

    else{
        header ('Location: login/');
	die;
    }
?>