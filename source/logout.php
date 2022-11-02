<?php
session_start();

if(isset($_SESSION["usr_id"])) {
    unset($_SESSION["usr_id"]);
}

echo "<script>window.location.href='login.php';</script>";
exit;
?>
