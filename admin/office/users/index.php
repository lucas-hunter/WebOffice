<?php
    include('../../include/connection.php');
?>
<div class="container" id="userscontainer">
    <div id="gridleft">
        <div id="addUser">
            <span class="title" >Add User</span>
            <div class="result" id="useraddresult">
                Last Name Required!
            </div>
            <form method="POST" id="adduser" autocomplete="off">
                <input type="text" id="firstname" placeholder="First Name"/>
                <input type="text" id="lastname" placeholder="Last Name"/>
                <input type="text" id="username" placeholder="Username"/>
                <input type="password" id="password" placeholder="Password"/>
                <input type="email" id="email" placeholder="Email" autocomplete="on"/>
                <input type="tel" id="phone" placeholder="Phone Number" autocomplete="on"/>
                <select id="role">
                    <?php
                        $query = mysqli_query($mysqli, "SELECT * FROM roles");
                        while($row = $query->fetch_array()){
                            echo "<option name=\"$row[1]\">$row[1]</option>";
                        }
                    ?>
                </select>
                <select class="" id="theme">
                    <?php
                        $query = mysqli_query($mysqli, "SELECT * FROM themes");
                        while($row = $query->fetch_array()){
                            echo "<option name=\"$row[1]\">$row[1]</option>";
                        }
                    ?>
                </select>
                <input type="submit" id="register" value="Add User"/>
            </form>
        </div>

        <div id="separator"></div>

        <div id="editUser">
            <span class="title">Edit User</span>
            <div class="result" id="usereditresult">
                Last Name Required!
            </div>
            <form method="POST" id="updateuser" autocomplete="off">
                <input type="number" id="userid" placeholder="ID" />
                <input type="text" id="editfirstname" placeholder="First Name"/>
                <input type="text" id="editlastname" placeholder="Last Name"/>
                <input type="text" id="editusername" placeholder="Username"/>
                <input type="password" id="editpassword" placeholder="Password"/>
                <input type="email" id="editemail" placeholder="Email"/>
                <input type="tel" id="editphone" placeholder="Phone Number"/>
                <select id="editrole">
                    <?php
                        $query = mysqli_query($mysqli, "SELECT * FROM roles");
                        while($row = $query->fetch_array()){
                            echo "<option name=\"$row[1]\">$row[1]</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Update User"/>
            </form>
        </div>
    </div>
    <div id="gridright">
        <div id="userdata">
        <?php
        $query = mysqli_query($mysqli, "SELECT * FROM users");

        if($query->num_rows > 0){
            echo "<table><tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Role</th>
                <th>Theme</th>
                <th>Remove</th></tr>";
            while($row = $query->fetch_assoc()){
                echo "<tr><td>".$row['id']."</td>
                    <td>".$row['firstname']." ".$row['lastname']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['role']."</td>
                    <td>".$row['theme']."</td>
                    <td class='remove' data-id=".$row['id']."><i class='fas fa-times'></i></td></tr>";
            }
            echo "</table>";
        }
        ?>
        </div>
    </div>
</div>