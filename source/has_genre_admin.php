<table class="table">
    <thead>
        <tr>
            <th scope="col">Media ID</th>
            <th scope="col">Media Name</th>
            <th scope="col">Genre ID</th>
            <th scope="col">Genre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);
        $sql_statement = "SELECT * FROM Media NATURAL JOIN Has_genre NATURAL JOIN Genre";
        $result = mysqli_query($db, $sql_statement);
        $userid = $user_data["usr_id"];

        while($row = mysqli_fetch_assoc($result)) {
            $med_id = $row['med_id']; 
            $med_name = $row['med_name']; 
            $gen_id = $row['gen_id']; 
            $gen_name = $row['gen_name']; 

            echo "<tr>
                    <th scope='row'>$med_id</th>
                    <td><a href='media.php?id=$med_id'>$med_name</a></td>
                    <th scope='row'>$gen_id</td>
                    <td><a href='genre.php?id=$gen_id'>$gen_name</a></td>";
                    

            echo '  <td>
                    <form style="display:inline-block; margin:0;" action="delete_has_genre.php" method="POST">
                    <input type="hidden" name="med_id" value="' . $med_id . '">
                    <input type="hidden" name="gen_id" value="' . $gen_id . '">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>