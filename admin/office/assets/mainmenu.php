<?php
    $manage_users = mysqli_query($mysqli, "SELECT * FROM permissions WHERE name = 'manage_users'");
    $musers = $manage_users->fetch_assoc();
    $perm_plus = mysqli_query($mysqli, "SELECT * FROM permissions WHERE name = 'permission_plus'");
    $perm = $perm_plus->fetch_assoc();
?>

<span class="openmenu" id="openmenu">
    <i class="fas fa-bars"></i>
</span>
<div class="mainmenu" id="mainmenu">
    <span class="menutitle">Main Menu</span>
    <span class="closemenu" id="closemenu">
        <i class="fas fa-times"></i>
    </span>
    <div class="menuitems" >
        <a id="dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a id="settings"><i class="fas fa-tasks"></i> Tasks</a>
        <?php if($musers[$userrole] == 1){ echo '
        <span class="category">USERS</span>
        <a id="users"><i class="fas fa-user-edit"></i> Manage Users</a>';}
        if($perm[$userrole] == 1){ echo '
        <span class="category">PERMISSION<sup>+</sup></span>
        <a id="roles"><i class="fas fa-cog"></i> Manage Roles</a>
        <a id="permissions"><i class="fas fa-check-double"></i> Manage Permissions</a>
        <a id="alter"><i class="fas fa-database"></i> Alter DB</a>
        <a id="logs"><i class="fas fa-receipt"></i> Logs</a>
        <a id="settings"><i class="fas fa-sliders-h"></i> Settings</a>';}
        ?>
    </div>
</div>
