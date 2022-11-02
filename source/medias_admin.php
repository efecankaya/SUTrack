<table class="table">
    <thead>
        <tr>
            <th scope="col">Media ID</th>
            <th scope="col">Name</th>
            <th scope="col">Rating</th>
            <th scope="col">Release</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);
        $sql_statement = "SELECT * FROM Media";
        $result = mysqli_query($db, $sql_statement);
        $userid = $user_data["usr_id"];

        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['med_id']; 
            $title = $row['med_name']; 
            $rating = $row['med_rating']; 
            $release = $row['med_release'];
            $release = strtok($release, "-");
            $is_favorite = mysqli_num_rows(mysqli_query($db, "SELECT * FROM Users NATURAL JOIN Favorite NATURAL JOIN Media WHERE usr_id = $userid AND med_id = $id LIMIT 1")) > 0;
            $is_watched = mysqli_num_rows(mysqli_query($db, "SELECT * FROM Users NATURAL JOIN Watched NATURAL JOIN Media WHERE usr_id = $userid AND med_id = $id LIMIT 1")) > 0;

            echo "<tr>
                    <th scope='row'>$id</th>
                    <td><a href='media.php?id=$id'>$title</a></td>
                    <td>$rating</td>
                    <td>$release</td>";
            
            echo '  <td>
                    <form style="display:inline-block; margin:0;" action="delete_media.php" method="POST">
                    <button name="med_id" value="' . $id . '" type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>