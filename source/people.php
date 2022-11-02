<table class="table">
    <thead>
        <tr>
            <th scope="col">Person ID</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);

        $filter_name = "";
        $filter_role = "-";

        if(!empty($_GET['name'])) {
            $filter_name = $_GET['name'];
        }
        if(!empty($_GET['role'])) {
            $filter_role = $_GET['role'];
        }
        if(empty($_GET['name']) && empty($_GET['role'])) {
            $sql_statement = "SELECT * FROM Person";
        } else {
            $sql_statement = "SELECT * FROM Person 
                        WHERE (per_name LIKE '%$filter_name%') AND 
                        (('$filter_role' <> '-' AND per_role = '$filter_role')
                        OR
                        ('$filter_role' = '-' AND 1))";
        }

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
        }
        
        ?>
    </tbody>
</table>