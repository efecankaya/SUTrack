<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['per_id']) && !empty($_POST['med_id'])) {
            $per_id = $_POST['per_id'];
            $med_id = $_POST['med_id'];
            $sql_statement = "INSERT INTO Directs(per_id, med_id) VALUES ('$per_id','$med_id')";
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