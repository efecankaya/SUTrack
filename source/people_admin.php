<table class="table">
    <thead>
        <tr>
            <th scope="col">Person ID</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);
        $sql_statement = "SELECT * FROM Person";
        $result = mysqli_query($db, $sql_statement);
        $userid = $user_data["usr_id"];

        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['per_id']; 
            $name = $row['per_name']; 
            $role = $row['per_role']; 
            echo "<tr>
                    <th scope='row'>$id</th>
                    <td><a href='person.php?id=$id'>$name</a></td>
                    <td>$role</td>";

            echo '  <td>
                    <form style="display:inline-block; margin:0;" action="delete_person.php" method="POST">
                    <button name="per_id" value="' . $id . '" type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>