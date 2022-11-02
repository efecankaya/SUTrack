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
        $userid = $user_data["usr_id"];

        $sql_statement = "SELECT med_id, med_name, med_rating, med_release FROM Users NATURAL JOIN Watched NATURAL JOIN Media WHERE usr_id = $userid";

        $result = mysqli_query($db, $sql_statement);

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
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="favorite.php" method="POST" target="i">
                    <button name="med_id" value="' . $id . '" style="box-shadow: none; color: ' . (($is_favorite) ? "red" : "black") .
                    '" onclick="ToggleF(document.getElementById(\'fav' . $id . '-2\'))" id="fav' . $id . '-2" class="btn"><i class="fa-solid fa-heart"></i></button>
                    </form>
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="watched.php" method="POST" target="i">
                    <button name="med_id" value="' . $id . '" style="box-shadow: none; color: ' . (($is_watched) ? "blue" : "black") .
                    '" onclick="ToggleW(document.getElementById(\'wat' . $id . '-2\'))" id="wat' . $id . '-2" class="btn"><i class="fa-solid fa-eye"></i></button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>