<?php
    include('../../include/connection.php');
    $roleid = mysqli_real_escape_string($mysqli, $_POST['editroleid']);
    $query = mysqli_query($mysqli, "SELECT * FROM roles WHERE id = '$roleid'");
    $rows = mysqli_num_rows($query);
    $row = $query->fetch_assoc();
    $rolename = $row['name'];
    if($roleid = '' || $rows == 0){
        $allchecks = mysqli_query($mysqli, "SELECT * FROM permissions");
        while($row = $allchecks->fetch_assoc()){
            $permid = $row['id'];
            $permname = $row['name'];
            $permdesc = $row['description'];
            echo "<label class='checks' title='$permdesc'><input type='checkbox' class='selected' data-id='$permid'/> $permname</label>";
        }
    }
    else{
        $checked = mysqli_query($mysqli, "SELECT * FROM permissions WHERE $rolename = 1");
        while($checkedrow = $checked->fetch_assoc()){
            $permid = $checkedrow['id'];
            $permname = $checkedrow['name'];
            $permdesc = $checkedrow['description'];
            echo "<label class='checks' title='$permdesc'><input type='checkbox' class='selected' data-id='$permid' checked/> $permname</label>";
        }
        $unchecked = mysqli_query($mysqli, "SELECT * FROM permissions WHERE $rolename = 0");
        while($uncheckedrow = $unchecked->fetch_assoc()){
            $permid = $uncheckedrow['id'];
            $permname = $uncheckedrow['name'];
            $permdesc = $uncheckedrow['description'];
            echo "<label class='checks' title='$permdesc'><input type='checkbox' class='selected' data-id='$permid' /> $permname</label>";
        }
    }
?>