<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['med_id']) && !empty($_POST['gen_id'])) {
            $med_id = $_POST['med_id'];
            $gen_id = $_POST['gen_id'];
            $sql_statement = "INSERT INTO Has_genre(med_id, gen_id) VALUES ('$med_id','$gen_id')";
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