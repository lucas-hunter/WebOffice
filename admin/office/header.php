<?php
session_start();
if(!isset($_SESSION['access'])){
    header("Location: ../login/");
}

include('../include/connection.php');

$userid = $_SESSION['access'];
$usercheck = mysqli_query($mysqli, "SELECT * FROM users WHERE id='$userid'");

$row = $usercheck->fetch_assoc();
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$fullname = $row['firstname'].' '.$row['lastname'];
$userrole = $row['role'];
$userimg = $row['userimg'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            
        </title>
        <link rel="stylesheet" type="text/css" href="../styles/main.css" />
        <script src="https://kit.fontawesome.com/5ad62dde49.js" crossorigin="anonymous"></script>
        <script src="../scripts/jquery-3.4.1.min.js"></script>
        <script src="../scripts/main.js"></script>
    </head>
    <body>
        <?php
            include('assets/mainmenu.php');
        ?>
        <div id="main">
            <div class="header">
                <?php
                include('assets/usermenu.php');
                ?>
            </div>
            <div id="container"></div>
