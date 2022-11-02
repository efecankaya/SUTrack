<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['title']) && !empty($_POST['rating']) && !empty($_POST['release'])) {
            $title = $_POST['title'];
            $rating = $_POST['rating'];
            $release = $_POST['release'];
            $sql_statement = "INSERT INTO Media(med_name, med_rating, med_release) VALUES ('$title','$rating','$release')";
            $result = mysqli_query($db, $sql_statement);
    
            header("Location: admin.php");
    
        } else {
            echo "The form is not set.";
        }
    } else {
        echo "Unauthorized.";
        header("Location: index.php");
    }
?>