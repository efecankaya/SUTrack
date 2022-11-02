<?php
session_start();
include("config.php");
include("functions.php");

$error = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(!empty($username) && !empty($password)) {
        //read from database
        $query = "SELECT * FROM Users WHERE usr_username = '$username' LIMIT 1";
        $result = mysqli_query($db, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if($user_data["usr_password"] === $password) {
                $_SESSION["usr_id"] = $user_data["usr_id"];
                header("Location: index.php");
                die;
            } else {
                $error = 3;
            }
        } else {
            $error = 2;
        }
    } else {
        $error = 1;
    }
}

?>

<html>
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title> Main Page </title>
		<style></style>
	</head>
	<body>
		<br>
		<div class="container">
			<div align="center">
				<h2>Login</h2>
            </div>
            <?php if($error === 1) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid input!</strong> Please fill the input fields.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif($error === 2) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong username!</strong> Please check the username.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php elseif($error === 3) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Wrong password!</strong> Please check the password.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <form action="login.php" method="POST" style="width: 22rem;">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="username" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
                <small id="signupHelp" class="form-text text-muted">Don't have an account? <a href="signup.php">Sign Up.</a></small>
                </form>
            </div>
        </div>
	</body>
</html>