<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>People Search</title>
        <style>
        </style>
        
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
                    <li class="nav-item active">
                        <a class="nav-link" href="people_search.php">People</a>
                    </li>
                    <?php
                        if($user_data["usr_isadmin"]) {
                          echo '<li class="nav-item">
                          <a class="nav-link" href="admin.php">Admin Panel</a>
                          </li>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="support.php">Support</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">View Profile</a>
                            <a class="dropdown-item" href="#">Change Password</a>
                            <a class="dropdown-item" href="logout.php">Log Out</a>
                        </div>
                    </li>
                </ul>
                <span class="navbar-text">
                Logged in as: <?php echo $user_data["usr_username"];?>
                </span>
            </div>
        </nav>
        <br><br>
        <div class="container">
            <br>
            <div align="center">
                <h2>Search for People</h2>
            </div>
            <br>
            <form action="" method="GET">
                <div class="container">
                    <div class="row">
                        <div class="col-md-auto">
                            <br>
                            <h4>Apply a filter:</h4>
                            <br>
                        </div>
                        <div class="col-md-auto">
                            <h5>Name</h5>
                            <input name="name" size="25">
                            <br>
                            <em>e.g. Leonardo DiCaprio</em>
                        </div>
                        <div class="col-md-auto">
                            <h5>Role</h5>
                            <select name="role">
                                <option selected="true">-</option>
                                <option>Actor</option>
                                <option>Director</option>
                            </select>
                        </div>
                        <div class="col-md-auto">
                            <br>
                            <button type="submit" class="btn btn-primary">Apply</button>
                        </div>
                    </div>
                    <br>
                </div>
            </form>
            <?php 
                include "people.php";
                ?>
        </div>
    </body>
</html>