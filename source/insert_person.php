<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if($user_data["usr_isadmin"]) {
        if(!empty($_POST['name']) && !empty($_POST['role'])) {
            $name = $_POST['name'];
            $role = $_POST['role'];
            $sql_statement = "INSERT INTO Person(per_name, per_role) VALUES ('$name','$role')";
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