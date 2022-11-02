<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);
?>
<?php if($user_data["usr_isadmin"]) : ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Admin Panel</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="people_search.php">People</a>
                    </li>
                    <?php
                        if($user_data["usr_isadmin"]) {
                          echo '<li class="nav-item active">
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
        <br><br><br>
        <div class="container">
            <div align="center">
                <h2>Admin Panel</h2>
            </div>
            <br>
            <div class="container">
                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#media">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#person">Person</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#starsin">Stars In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#directs">Directs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#genre">Genre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#hasgenre">Has Genre</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="media" class="container tab-pane active">
                        <br>
                        <form action="insert_media.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <br>
                                        <h4>Insert a media:</h4>
                                        <br>
                                    </div>
                                    <div class="col-md-auto">
                                        <h5>Title</h5>
                                        <input name="title" size="25">
                                        <br>
                                        <em>e.g. The Godfather</em>
                                    </div>
                                    <div class="col-md-auto">
                                        <h5>Release Date</h5>
                                        <input name="release" size="18" maxlength="10">
                                        <br>
                                        <i>Format: YYYY-MM-DD</i>
                                    </div>
                                    <div class="col-md-auto">
                                        <h5>User Rating</h5>
                                        <select name="rating">
                                            <option value="" selected="true">-</option>
                                            <option>1.0</option>
                                            <option>1.1</option>
                                            <option>1.2</option>
                                            <option>1.3</option>
                                            <option>1.4</option>
                                            <option>1.5</option>
                                            <option>1.6</option>
                                            <option>1.7</option>
                                            <option>1.8</option>
                                            <option>1.9</option>
                                            <option>2.0</option>
                                            <option>2.1</option>
                                            <option>2.2</option>
                                            <option>2.3</option>
                                            <option>2.4</option>
                                            <option>2.5</option>
                                            <option>2.6</option>
                                            <option>2.7</option>
                                            <option>2.8</option>
                                            <option>2.9</option>
                                            <option>3.0</option>
                                            <option>3.1</option>
                                            <option>3.2</option>
                                            <option>3.3</option>
                                            <option>3.4</option>
                                            <option>3.5</option>
                                            <option>3.6</option>
                                            <option>3.7</option>
                                            <option>3.8</option>
                                            <option>3.9</option>
                                            <option>4.0</option>
                                            <option>4.1</option>
                                            <option>4.2</option>
                                            <option>4.3</option>
                                            <option>4.4</option>
                                            <option>4.5</option>
                                            <option>4.6</option>
                                            <option>4.7</option>
                                            <option>4.8</option>
                                            <option>4.9</option>
                                            <option>5.0</option>
                                            <option>5.1</option>
                                            <option>5.2</option>
                                            <option>5.3</option>
                                            <option>5.4</option>
                                            <option>5.5</option>
                                            <option>5.6</option>
                                            <option>5.7</option>
                                            <option>5.8</option>
                                            <option>5.9</option>
                                            <option>6.0</option>
                                            <option>6.1</option>
                                            <option>6.2</option>
                                            <option>6.3</option>
                                            <option>6.4</option>
                                            <option>6.5</option>
                                            <option>6.6</option>
                                            <option>6.7</option>
                                            <option>6.8</option>
                                            <option>6.9</option>
                                            <option>7.0</option>
                                            <option>7.1</option>
                                            <option>7.2</option>
                                            <option>7.3</option>
                                            <option>7.4</option>
                                            <option>7.5</option>
                                            <option>7.6</option>
                                            <option>7.7</option>
                                            <option>7.8</option>
                                            <option>7.9</option>
                                            <option>8.0</option>
                                            <option>8.1</option>
                                            <option>8.2</option>
                                            <option>8.3</option>
                                            <option>8.4</option>
                                            <option>8.5</option>
                                            <option>8.6</option>
                                            <option>8.7</option>
                                            <option>8.8</option>
                                            <option>8.9</option>
                                            <option>9.0</option>
                                            <option>9.1</option>
                                            <option>9.2</option>
                                            <option>9.3</option>
                                            <option>9.4</option>
                                            <option>9.5</option>
                                            <option>9.6</option>
                                            <option>9.7</option>
                                            <option>9.8</option>
                                            <option>9.9</option>
                                            <option>10</option>
                                        </select>
                                    </div>
                                    <div class="col-md-auto">
                                        <br>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "medias_admin.php";
                        ?>
                    </div>

                    <div id="person" class="container tab-pane fade">
                        <br>
                        <form action="insert_person.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <br>
                                        <h4>Insert a person:</h4>
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
                                            <option selected="true">Actor</option>
                                            <option>Director</option>
                                        </select>
                                    </div>
                                    <div class="col-md-auto">
                                        <br>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "people_admin.php";
                        ?>
                    </div>

                    <div id="starsin" class="container tab-pane fade">
                        <br><br>
                        <form action="insert_stars_in.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <h4>Insert into Stars In:</h4>
                                    </div>
                                    <div class="col-md-auto">
                                        <select name="per_id">

                                        <?php

                                        $sql_command = "SELECT per_id, per_name FROM Person";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $per_id = $row['per_id']; 
                                                $per_name = $row['per_name']; 
                                                echo "<option value=$per_id>". $per_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        stars in
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <select name="med_id">

                                        <?php

                                        $sql_command = "SELECT med_id, med_name FROM Media";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $med_id = $row['med_id']; 
                                                $med_name = $row['med_name']; 
                                                echo "<option value=$med_id>". $med_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "stars_in_admin.php";
                        ?>
                    </div>

                    <div id="directs" class="container tab-pane fade">
                        <br><br>
                        <form action="insert_directs.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <h4>Insert into Directs:</h4>
                                    </div>
                                    <div class="col-md-auto">
                                        <select name="per_id">

                                        <?php

                                        $sql_command = "SELECT per_id, per_name FROM Person";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $per_id = $row['per_id']; 
                                                $per_name = $row['per_name']; 
                                                echo "<option value=$per_id>". $per_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        directs
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <select name="med_id">

                                        <?php

                                        $sql_command = "SELECT med_id, med_name FROM Media";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $med_id = $row['med_id']; 
                                                $med_name = $row['med_name']; 
                                                echo "<option value=$med_id>". $med_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "directs_admin.php";
                        ?>
                    </div>

                    <div id="genre" class="container tab-pane fade">
                        <br>
                        <form action="insert_genre.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <br>
                                        <h4>Insert a genre:</h4>
                                        <br>
                                    </div>
                                    <div class="col-md-auto">
                                        <h5>Genre</h5>
                                        <input name="genre" size="25">
                                        <br>
                                        <em>e.g. Action</em>
                                    </div>
                                    <div class="col-md-auto">
                                        <br>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "genres_admin.php";
                        ?>
                    </div>

                    <div id="hasgenre" class="container tab-pane fade">
                        <br><br>
                        <form action="insert_has_genre.php" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <h4>Insert into Has Genre:</h4>
                                    </div>
                                    <div class="col-md-auto">
                                        <select name="med_id">

                                        <?php

                                        $sql_command = "SELECT med_id, med_name FROM Media";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $med_id = $row['med_id']; 
                                                $med_name = $row['med_name']; 
                                                echo "<option value=$med_id>". $med_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        has genre
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <select name="gen_id">

                                        <?php

                                        $sql_command = "SELECT gen_id, gen_name FROM Genre";

                                        $myresult = mysqli_query($db, $sql_command);

                                            while($row = mysqli_fetch_assoc($myresult))
                                            {
                                                $gen_id = $row['gen_id']; 
                                                $gen_name = $row['gen_name']; 
                                                echo "<option value=$gen_id>". $gen_name . "</option>";
                                            }

                                        ?>

                                        </select>
                                        <div class="space" style="width: 15px; height: auto; display: inline-block"></div>
                                        <button type="submit" class="btn btn-success">Insert</button>
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <br>
                        <?php 
                            include "has_genre_admin.php";
                        ?>
                    </div>
                </div>
            </div>
            

        </div>
    </body>
</html>
<?php else : ?>
    You are not authorized to view this page.
<?php endif; ?>