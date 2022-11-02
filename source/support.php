<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);
?>

<?php
    //header("refresh: 5");

    function get_messages($username) { 
        $ch = curl_init();
        curl_setopt_array($ch, [ CURLOPT_URL => "<insert firebase url here>" . $username . ".json",
                                CURLOPT_POST => FALSE, // It will be a get request 
                                CURLOPT_RETURNTRANSFER => true, ]);
        $response = curl_exec($ch); 
        curl_close($ch);
        return json_decode($response, true); 
    }

    if ($user_data["usr_isadmin"] && isset($_GET['username'])) {
        $username = $_GET['username'];

        $messages = get_messages($username);
        if($username === ""||$messages === null) {
            header("Location: support.php");
        }
    } else if (!$user_data["usr_isadmin"] && !isset($_GET['create'])) {
        $username = $user_data['usr_username'];
        $messages = get_messages($username);
        if($messages === null) {
            header("Location: support.php?create=true");
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <title>Support Page</title>
        <style>
            .chat-list {
                padding: 0;
                font-size: .8rem;
            }

            .chat-list li {
                margin-bottom: 10px;
                overflow: auto;
                color: #ffffff;
            }

            .chat-list .chat-img {
                float: left;
                width: 40px;
                color: #000000;
                text-align: center;
            }

            .chat-list .chat-img img {
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                border-radius: 50px;
                width: 100%;
            }

            .chat-list .chat-message {
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                border-radius: 50px;
                background: #5a99ee;
                display: inline-block;
                padding: 10px 20px;
                position: relative;
            }

            .chat-list .chat-message:before {
                content: "";
                position: absolute;
                top: 15px;
                width: 0;
                height: 0;
            }

            .chat-list .chat-message h5 {
                margin: 0 0 5px 0;
                font-weight: 600;
                line-height: 100%;
                font-size: .9rem;
            }

            .chat-list .chat-message p {
                line-height: 18px;
                margin: 0;
                padding: 0;
            }

            .chat-list .chat-body {
                margin-left: 20px;
                float: left;
                width: 70%;
            }

            .chat-list .in .chat-message:before {
                left: -12px;
                border-bottom: 20px solid transparent;
                border-right: 20px solid #5a99ee;
            }

            .chat-list .out .chat-img {
                float: right;
            }

            .chat-list .out .chat-body {
                float: right;
                margin-right: 20px;
                text-align: right;
            }

            .chat-list .out .chat-message {
                background: #fc6d4c;
            }

            .chat-list .out .chat-message:before {
                right: -12px;
                border-bottom: 20px solid transparent;
                border-left: 20px solid #fc6d4c;
            }

            .card .card-header:first-child {
                -webkit-border-radius: 0.3rem 0.3rem 0 0;
                -moz-border-radius: 0.3rem 0.3rem 0 0;
                border-radius: 0.3rem 0.3rem 0 0;
            }
            .card .card-header {
                background: #17202b;
                border: 0;
                font-size: 1rem;
                padding: .65rem 1rem;
                position: relative;
                font-weight: 600;
                color: #ffffff;
            }

            .content{
                margin-top:40px;    
            }
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
                    <li class="nav-item active">
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
                          echo '
						
						<li class="nav-item">
							<a class="nav-link" href="admin.php">Admin Panel</a>
						</li>';
                        }
                    ?> 
                    <li class="nav-item active">
                        <a class="nav-link" href="support.php">Support</a>
                    </li>
                    <li class="nav-item dropdown">
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
        <?php if($user_data["usr_isadmin"]) : ?>
        <!--This part will be rendered if this person is an admin -->
        <div class="container">
            <br>
            <div align="center">
                <h2>User Support</h2>
            </div>

            <?php if(isset($_GET['username'])) : ?>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 class="float-start" style="margin: 0">Chatting with: <?php echo $username; ?></h5>
                        </div>
                        <div class="col">
                            <form style="display:inline;" action="send_message.php" method="POST">
                                <input type="hidden" name="username" value="<?php echo $username; ?>">
                                <button class="btn btn-danger float-right" name="end" value="1" type="submit">End Conversation</button>
                            </form>
                            <form style="display:inline;" action="support.php" method="POST">
                                <button style="margin-right: 10px" class="btn btn-primary float-right" type="submit">Go back</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <br>

                <?php
                    $issueType = $messages["issueType"]["type"];
                    if($issueType === "0") {
                        $issue = "Suggestion";
                    } elseif($issueType === "1") {
                        $issue = "Unexpected Error";
                    } elseif($issueType === "2") {
                        $issue = "Database Issue";
                    } elseif($issueType === "3") {
                        $issue = "Server Issue";
                    } elseif($issueType === "4") {
                        $issue = "Account Issue";
                    } else {
                        $issue = "Unknown Issue";
                    }
                ?>

                <div class="container">
                    <div class="card">
                        <div class="card-header">Issue type: <?php echo $issue; ?></div>
                            <div class="card-body height3">
                                <ul class="chat-list">
                                    <?php
                                        $keys = array_keys($messages);
                                        for ($i = 0; $i < count($keys); $i++){
                                            if($keys[$i] === "issueType") continue;
                                            $chat_msg = $messages[$keys[$i]];
                                            $from = $chat_msg['from'];
                                            $msg = $chat_msg['msg'];
                                            $time = $chat_msg['time'];
                                            
                                            if($from === "admin") {
                                                echo '
                                                <li class="out">
                                                <div class="chat-img">
                                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                                    ' . $time . '
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <h5>Admin</h5>
                                                        <p>' . $msg . '</p>
                                                    </div>
                                                </div>
                                                </li>';
                                            } else {
                                                echo '<li class="in">
                                                <div class="chat-img">
                                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                                    ' . $time . '
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <h5>' . $username . '</h5>
                                                        <p>' . $msg . '</p>
                                                    </div>
                                                </div>
                                            </li>';
                                            }
                                        }
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form action="send_message.php" method="POST">
                        <div class="input-group mb-3">
                            <input name="username" value="<?php echo $username; ?>" type="hidden">
                            <input type="text" name="usermsg" class="form-control" placeholder="Write a message...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </form>
                </div>

            <?php else : ?>

                <br>

                <?php
                    $messages = get_messages("");
                ?>

                <?php if($messages === null) : ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>There are no help requests.</h5>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>Users who need help:</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                                foreach($messages as $key => $value) {
                                    echo "<a class='list-group-item list-group-item-action' href='support.php?username=" . $key . "'>" . $key . "</a>";
                                }
                            ?>
                        </ul>
                    </div>
                    
                <?php endif; ?>
            <?php endif; ?>

        </div>

        <?php else : ?>
        <!--This part will be rendered if this person is not an admin -->
        <div class="container">
            <br>
            <div align="center">
                <h2>Get Support</h2>
            </div>

            <?php if(!isset($_GET['create'])) : ?>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 class="float-start" style="margin: 0">Chatting with an admin</h5>
                        </div>
                        <div class="col">
                            <form style="display:inline;" action="send_message.php" method="POST">
                                <button class="btn btn-danger float-right" name="end" value="1" type="submit">End Conversation</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <br>

                <?php
                    $username = $user_data["usr_username"];
                    $messages = get_messages($username);
                    $issueType = $messages["issueType"]["type"];
                    if($issueType === "0") {
                        $issue = "Suggestion";
                    } elseif($issueType === "1") {
                        $issue = "Unexpected Error";
                    } elseif($issueType === "2") {
                        $issue = "Database Issue";
                    } elseif($issueType === "3") {
                        $issue = "Server Issue";
                    } elseif($issueType === "4") {
                        $issue = "Account Issue";
                    } else {
                        $issue = "Unknown Issue";
                    }
                ?>

                <div class="container">
                    <div class="card">
                        <div class="card-header">Issue type: <?php echo $issue; ?></div>
                            <div class="card-body height3">
                                <ul class="chat-list">
                                    <?php
                                        $keys = array_keys($messages);
                                        for ($i = 0; $i < count($keys); $i++){
                                            if($keys[$i] === "issueType") continue;
                                            $chat_msg = $messages[$keys[$i]];
                                            $from = $chat_msg['from'];
                                            $msg = $chat_msg['msg'];
                                            $time = $chat_msg['time'];
                                            
                                            if($from === "user") {
                                                echo '
                                                <li class="out">
                                                <div class="chat-img">
                                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                                    ' . $time . '
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <h5>' . $username . '</h5>
                                                        <p>' . $msg . '</p>
                                                    </div>
                                                </div>
                                                </li>';
                                            } else {
                                                echo '<li class="in">
                                                <div class="chat-img">
                                                    <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                                                    ' . $time . '
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <h5>Admin</h5>
                                                        <p>' . $msg . '</p>
                                                    </div>
                                                </div>
                                            </li>';
                                            }
                                        }
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <form action="send_message.php" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="usermsg" class="form-control" placeholder="Write a message...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                

            <?php else : ?>
                <br>
                <h5>Start a new conversation:</h5>
                <form action="send_message.php" method="POST">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect">Select Issue type:</label>
                        </div>
                        <select name="issueType" class="custom-select" id="inputGroupSelect">
                            <option value="0" selected>Suggestion</option>
                            <option value="1">Unexpected Error</option>
                            <option value="2">Database Issue</option>
                            <option value="3">Server Issue</option>
                            <option value="4">Account Issue</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Start Chat</button>
                        </div>
                    </div>
                </form>

            <?php endif; ?>
        </div>

        <?php endif; ?>
    </body>
</html>

