<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    if(isset($_GET["id"])) {
        $userid = $user_data["usr_id"];
        $mediaid = $_GET["id"];

        $result = mysqli_query($db, "SELECT * FROM Media WHERE med_id = $mediaid");
        if(mysqli_num_rows($result) > 0) {
            $currentmedia = mysqli_fetch_assoc($result);
        } else {
            $currentmedia = false;
        }
    } else {
        echo "Error: id parameter is not set.";
        header("Location: media_search.php");
    }
?> 
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <title><?php echo $currentmedia["med_name"]; ?></title>
        <style></style>
        <script>
            function ToggleF(x) {
                x.style.color = (x.style.color == "red") ? "black" : "red"
            }
            function ToggleW(x) {
                x.style.color = (x.style.color == "blue") ? "black" : "blue"
            }
        </script>
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
            <?php if($currentmedia) : ?>
                <?php
                    $mediaid = $_GET["id"];
                    $is_favorite = mysqli_num_rows(mysqli_query($db, "SELECT * FROM Users NATURAL JOIN Favorite NATURAL JOIN Media WHERE usr_id = $userid AND med_id = $mediaid LIMIT 1")) > 0;
                    $is_watched = mysqli_num_rows(mysqli_query($db, "SELECT * FROM Users NATURAL JOIN Watched NATURAL JOIN Media WHERE usr_id = $userid AND med_id = $mediaid LIMIT 1")) > 0;
                ?>
                <div align="center">
                    <h2><?php echo $currentmedia["med_name"]?></h2>
                    <br>
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="favorite.php" method="POST" target="i">
                    <button name="med_id" value="<?php echo $mediaid?>" style="box-shadow: none; color: <?php echo $is_favorite ? "red" : "black"?>" 
                    onclick="ToggleF(document.getElementById('fav'))" id="fav" class="btn"><i class="fa-solid fa-heart fa-2xl"></i></button>
                    </form>
                    <iframe name="i" style="display:none;"></iframe>
                    <form style="display:inline-block; margin:0;" action="watched.php" method="POST" target="i">
                    <button name="med_id" value="<?php echo $mediaid?>" style="box-shadow: none; color: <?php echo $is_watched ? "blue" : "black"?>" 
                    onclick="ToggleW(document.getElementById('wat'))" id="wat" class="btn"><i class="fa-solid fa-eye fa-2xl"></i></button>
                    </form>
                    <br><br>
                </div>
                <div class="container">
                    <br>
                    <h5 style="display: inline">Genres:</h5>
                    <div class="space" style="width: 5px; height: auto; display: inline-block"></div>
                    <?php
                        $genres = mysqli_query($db, "SELECT * FROM Has_genre NATURAL JOIN Genre WHERE med_id = $mediaid");
                        $genre = mysqli_fetch_assoc($genres);
                        $gen_id = $genre['gen_id']; 
                        $gen_name = $genre['gen_name']; 
                        echo "<a href='genre.php?id=$gen_id'>$gen_name</a>";
                        while($genre = mysqli_fetch_assoc($genres)) {
                            $gen_id = $genre['gen_id']; 
                            $gen_name = $genre['gen_name']; 
                            echo ", <a href='genre.php?id=$gen_id'>$gen_name</a>";
                        }
                    ?>
                    <br><br>
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#cast">Cast</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#directors">Directors</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="cast" class="container tab-pane active">
                            <br>
                            <?php
                                include "cast.php";
                            ?>
                        </div>
                        <div id="directors" class="container tab-pane fade">
                            <br>
                            <?php
                                include "directors.php";
                            ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div align="center">
                    <h2>This id does not exist.</h2>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>