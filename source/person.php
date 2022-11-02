<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if(isset($_GET["id"])) {
        $userid = $user_data["usr_id"];
        $personid = $_GET["id"];

        $result = mysqli_query($db, "SELECT * FROM Person WHERE per_id = $personid");
        if(mysqli_num_rows($result) > 0) {
            $currentperson = mysqli_fetch_assoc($result);
        } else {
            $currentperson = false;
        }
    } else {
        echo "Error: id parameter is not set.";
        header("Location: person_search.php");
    }
?> 
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <title><?php echo $currentperson["per_name"]; ?></title>
        <style></style>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">SUTrack</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="media_search.php">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="people_search.php">People</a>
                    </li> <?php
                        if($user_data["usr_isadmin"]) {
                          echo '
						
						<li class="nav-item">
							<a class="nav-link" href="admin.php">Admin Panel</a>
						</li>';
                        }
                        ?> <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Account </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">View Profile</a>
                            <a class="dropdown-item" href="#">Change Password</a>
                            <a class="dropdown-item" href="logout.php">Log Out</a>
                        </div>
                    </li>
                </ul>
                <span class="navbar-text"> Logged in as: <?php echo $user_data["usr_username"];?> </span>
            </div>
        </nav>
        <br>
        <br>
        <div class="container">
            <br>
            <?php if($currentperson) : ?>
                <?php
                    $personid = $_GET["id"];
                    $name = $currentperson["per_name"];
                    $role = $currentperson["per_role"];
                ?>
                <div align="center">
                    <h2><?php echo $name?></h2>
                </div>
                <?php if($role === "Actor") : ?>
                    <h5><?php echo $name ?> is an actor who stars in:</h5>
                    <br>
                    <?php include "stars_in.php" ?>
                <?php elseif($role === "Director") : ?>
                    <h5><?php echo $name?> is a director who directs:</h5>
                    <br>
                    <?php include "directs.php" ?>
                <?php else : ?>
                    <?php echo "Error: Invalid role"?>
                    <br>
                <?php endif; ?>
            <?php else : ?>
                <div align="center">
                    <h2>This id does not exist.</h2>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>