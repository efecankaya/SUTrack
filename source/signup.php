<?php
session_start();
include("config.php");
include("functions.php");

$error = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(!empty($username) && !empty($password)) {
        //check if username exists
        $query = "SELECT * FROM Users WHERE usr_username = '$username' LIMIT 1";
        $result = mysqli_query($db, $query);
        if($result && mysqli_num_rows($result) > 0) {
            $error = 2;
        } else {
            //save to database
            $query = "INSERT INTO Users (usr_username, usr_password) VALUES ('$username', '$password')";
            mysqli_query($db, $query);
            header("Location: login.php");
            die;
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
				<h2>Sign Up</h2>
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
                    <strong>Username taken!</strong> Please enter a different username.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <form action="signup.php" method="POST" style="width: 22rem;">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="username" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <small id="loginHelp" class="form-text text-muted">Already have an account? <a href="login.php">Log In.</a></small>
                </form>
            </div>
        </div>
	</body>
</html>