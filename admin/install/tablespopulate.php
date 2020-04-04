<?php
    include('../include/connection.php');

    // Populate Site Info table
    $siteinfo_check = mysqli_query($mysqli, "SELECT * FROM site_info");
    $siteinfo_rows = mysqli_num_rows($siteinfo_check);
    if($siteinfo_rows == 0){
        mysqli_query($mysqli, "INSERT INTO site_info (site_title,site_url) VALUES ('Page Title', 'http://localhost/admin')");
    }

    // Populate Users table
    $password = password_hash('password', PASSWORD_DEFAULT);
    $users_check = mysqli_query($mysqli, "SELECT * FROM users");
    $users_rows = mysqli_num_rows($users_check);
    if($users_rows == 0){
        mysqli_query($mysqli, "INSERT INTO users (username,password,firstname,lastname,email,role) VALUES ('admin','$password','Default','User','admin@localhost.me','Administrator')");
    }

    // Populate Roles table
    $roles_check = mysqli_query($mysqli, "SELECT * FROM roles");
    $roles_rows = mysqli_num_rows($roles_check);
    if($roles_rows == 0){
        mysqli_query($mysqli, "INSERT INTO roles (name,description) VALUES ('Administrator', 'Has full access over the entire website')");
    }

    // Populate Permissions table
    $perm_check = mysqli_query($mysqli, "SELECT * FROM permissions");
    $perm_rows = mysqli_num_rows($perm_check);
    if($perm_rows == 0){
        mysqli_query($mysqli, "INSERT INTO permissions (name,description) VALUES ('manage_users', 'Can add/edit users'), ('permission_plus', 'Can manage roles and permissions')");
    }

    // Populate Themes table
    $themes_check = mysqli_query($mysqli, "SELECT * FROM themes");
    $themes_rows = mysqli_num_rows($themes_check);
    if($themes_rows == 0){
        mysqli_query($mysqli, "INSERT INTO themes (theme_name) VALUE ('default')");
    }

    echo json_encode('
        <p>Congratulations, the installation has just finished!</p>
        <p>You can login and start using the script now, the default username is "<b>admin</b>" the default password is "<b>password</b>"</p>
        <p>Make sure to change the username/password before doing anything else.</p>
        <p>Enjoy!</p>
    ');
?>
