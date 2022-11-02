<table class="table">
    <thead>
        <tr>
            <th scope="col">Person ID</th>
            <th scope="col">Actor Name</th>
            <th scope="col">Media ID</th>
            <th scope="col">Media Name</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);
        $sql_statement = "SELECT * FROM Person NATURAL JOIN Stars_in NATURAL JOIN Media";
        $result = mysqli_query($db, $sql_statement);
        $userid = $user_data["usr_id"];

        while($row = mysqli_fetch_assoc($result)) {
            $per_id = $row['per_id']; 
            $per_name = $row['per_name']; 
            $med_id = $row['med_id']; 
            $med_name = $row['med_name']; 

            echo "<tr>
                    <th scope='row'>$per_id</th>
                    <td><a href='person.php?id=$per_id'>$per_name</a></td>
                    <th scope='row'>$med_id</td>
                    <td><a href='media.php?id=$med_id'>$med_name</a></td>";

            echo '  <td>
                    <form style="display:inline-block; margin:0;" action="delete_stars_in.php" method="POST">
                    <input type="hidden" name="per_id" value="' . $per_id . '">
                    <input type="hidden" name="med_id" value="' . $med_id . '">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>