<?php
include("config.php");

function check_login($db) {
    if (isset($_SESSION["usr_id"])) {
        $id = $_SESSION["usr_id"];
        $query = "SELECT * FROM Users WHERE usr_id = '$id' LIMIT 1";
        $result = mysqli_query($db, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");
    die;
}
?>