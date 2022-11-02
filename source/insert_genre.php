<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['genre'])) {
            $genre = $_POST['genre'];
            $sql_statement = "INSERT INTO Genre(gen_name) VALUES ('$genre')";
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