<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['per_id'])) {
            $selected_id = $_POST['per_id'];
    
            $sql_statement = "DELETE FROM Person WHERE per_id = $selected_id";
            $result = mysqli_query($db, $sql_statement);
    
            header("Location: admin.php");
    
        } else {
            echo "The option was not selected.";
        }
    } else {
        echo "Unauthorized.";
        header("Location: index.php");
    }
?>