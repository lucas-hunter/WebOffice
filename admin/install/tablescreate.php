<?php
include('../include/connection.php');

// Site Info - basic information about the website (name, url...)
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS site_info(
    site_title VARCHAR(255) NOT NULL,
    site_url TEXT NOT NULL
)");

// Users - all the users that will use the website are stored here
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS users(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    role VARCHAR(255) NOT NULL,
    theme VARCHAR(255) DEFAULT 'default',
    userimg VARCHAR(255) DEFAULT 'default.jpg'
)");

// Roles 
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS roles(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
)");

//Permissions
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS permissions(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    Administrator BOOLEAN NOT NULL DEFAULT TRUE
)");

//Themes
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS themes(
    theme_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(255) NOT NULL
)");
?>
