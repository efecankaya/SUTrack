<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if(isset($_POST["med_id"])) {
        $userid = $user_data["usr_id"];
        $mediaid = $_POST["med_id"];

        $result = mysqli_query($db, "SELECT * FROM Favorite WHERE usr_id = $userid AND med_id = $mediaid");
        if(mysqli_num_rows($result) > 0) {
            $result = mysqli_query($db, "DELETE FROM Favorite WHERE usr_id = $userid AND med_id = $mediaid");
        } else {
            $result = mysqli_query($db, "INSERT INTO Favorite(usr_id, med_id) VALUES ('$userid', '$mediaid')");
        }
    }

    header("Location: media_search.php");
?>