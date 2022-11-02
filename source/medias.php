<script>
    function ToggleF(x) {
        x.style.color = (x.style.color == "red") ? "black" : "red"
    }
    function ToggleW(x) {
        x.style.color = (x.style.color == "blue") ? "black" : "blue"
    }
</script>
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

        $filter_title = "";
        $filter_rating_min = 0;
        $filter_rating_max = 10;
        $filter_release_min = '1900-01-01';
        $filter_release_max = '2100-01-01';
        $filter_gen_id = '-';

        if(!empty($_GET['title'])) {
            $filter_title = $_GET['title'];
        }
        if(!empty($_GET['rating_min'])) {
            $filter_rating_min = $_GET['rating_min'];
        }
        if(!empty($_GET['rating_max'])) {
            $filter_rating_max = $_GET['rating_max'];
        }
        if(!empty($_GET['release_min'])) {
            $filter_release_min = $_GET['release_min'];
            $filter_release_min = $filter_release_min . '-01-01';
        }
        if(!empty($_GET['release_max'])) {
            $filter_release_max = $_GET['release_max'];
            $filter_release_max = $filter_release_max . '-01-01';
        }
        if(!empty($_GET['gen_id'])) {
            $filter_gen_id = $_GET['gen_id'];
        }

        if(empty($_GET['title']) && empty($_GET['rating_min']) && empty($_GET['rating_max']) && empty($_GET['release_min']) && empty($_GET['release_max']) && $filter_gen_id === '-') {
            $sql_statement = "SELECT * FROM Media";
        } else {
            $sql_statement = "SELECT * FROM Media NATURAL JOIN Has_genre NATURAL JOIN Genre
                        WHERE (med_name LIKE '%$filter_title%') AND 
                        ($filter_rating_min <= med_rating AND
                        $filter_rating_max >= med_rating) AND
                        (med_release BETWEEN '$filter_release_min' AND
                        '$filter_release_max') AND
                        ($filter_gen_id = '-' OR gen_id = $filter_gen_id)";
        }

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
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="favorite.php" method="POST" target="i">
                    <button name="med_id" value="' . $id . '" style="box-shadow: none; color: ' . (($is_favorite) ? "red" : "black") .
                    '" onclick="ToggleF(document.getElementById(\'fav' . $id . '\'))" id="fav' . $id . '" class="btn"><i class="fa-solid fa-heart"></i></button>
                    </form>
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="watched.php" method="POST" target="i">
                    <button name="med_id" value="' . $id . '" style="box-shadow: none; color: ' . (($is_watched) ? "blue" : "black") .
                    '" onclick="ToggleW(document.getElementById(\'wat' . $id . '\'))" id="wat' . $id . '" class="btn"><i class="fa-solid fa-eye"></i></button>
                    </form>
                    </td>
                </tr>
            ';
        }
        
        ?>
    </tbody>
</table>