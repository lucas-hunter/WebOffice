<?php
    include('../../include/connection.php');
?>
<div class="container" id="rolescontainer">
    <div id="addRole">
        <span class="title">Add Role</span>
        <div class="result" id="addroleresult"></div>
        <form method="POST" id="newrole">
            <input type="text" id="rolename" placeholder="Role Name" />
            <input type="text" id="role_description" placeholder="Role Description" />
            <hr /><span class="title">Include Permissions</span>
            <div id="checks">
                <?php
                $query = mysqli_query($mysqli, "SELECT * FROM permissions");
                while($row = $query->fetch_assoc()){
                    $permid = $row['id'];
                    $permname = $row['name'];
                    $permdesc = $row['description'];
                    echo "<label class='checks' title='$permdesc'><input type='checkbox' class='selected' data-id='$permid'/> $permname</label>";
                }
                ?>
            </div>

            <input type="submit" value="Add Role" />
        </form>
    </div>
    
    <div id="editRole">
        <span class="title">Edit Role</span>
        <div class="result" id="editroleresult"></div>
        <form method="POST" id="updaterole">
            <input type="number" id="roleid" placeholder="Role ID" />
            <input type="text" id="editrolename" placeholder="Role Name" />
            <input type="text" id="editroledesc" placeholder="Role Description" />
            <hr />
            <div id="editchecks">
                <?php
                $query = mysqli_query($mysqli, "SELECT * FROM permissions");
                while($row = $query->fetch_assoc()){
                    $permid = $row['id'];
                    $permname = $row['name'];
                    $permdesc = $row['description'];
                    echo "<label class='checks' title='$permdesc'><input type='checkbox' class='selected' data-id='$permid'/> $permname</label>";
                }
                ?>
            </div>

            <input type="submit" value="Update Role" />
        </form>
    </div>
    
    <div id="roledata">
    <?php
    $query = mysqli_query($mysqli, "SELECT * FROM roles");

    if($query->num_rows > 0){
        echo "<table><tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Remove</th></tr>";
        while($row = $query->fetch_assoc()){
            echo "<tr><td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['description']."</td>
                <td class='remove' data-id=".$row['id']."><i class='fas fa-times'></i></td></tr>";
        }
        echo "</table>";
    }
    ?>
    </div>
</div>