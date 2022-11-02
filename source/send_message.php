<?php
    session_start();
    include "config.php";
    include "functions.php";
    $user_data = check_login($db);

    function send_msg_to($username, $msg, $from) {
        $ch = curl_init();
        $msg_json = new stdClass();

        $msg_json->msg = $msg;
        $msg_json->from = $from;
        $msg_json->time = date('H:i');

        $encoded_json_obj = json_encode($msg_json); 
        curl_setopt_array($ch, array(CURLOPT_URL => "https://cs306p-default-rtdb.firebaseio.com/" . $username . ".json",
                                    CURLOPT_POST => TRUE,
                                    CURLOPT_RETURNTRANSFER => TRUE,
                                    CURLOPT_HTTPHEADER => array('Content-Type: application/json' ),
                                    CURLOPT_POSTFIELDS => $encoded_json_obj ));
        $response = curl_exec($ch); 
        return $response;
    }

    function create_issue($username, $issueType) {
        $ch = curl_init();
        $msg_json = new stdClass();

        $msg_json->type = $issueType;

        $encoded_json_obj = json_encode($msg_json); 
        curl_setopt_array($ch, array(CURLOPT_URL => "https://cs306p-default-rtdb.firebaseio.com/" . $username . "/issueType.json",
                                    CURLOPT_CUSTOMREQUEST => "PUT",
                                    CURLOPT_POST => TRUE,
                                    CURLOPT_RETURNTRANSFER => TRUE,
                                    CURLOPT_HTTPHEADER => array('Content-Type: application/json' ),
                                    CURLOPT_POSTFIELDS => $encoded_json_obj ));
        $response = curl_exec($ch); 
        return $response;
    }

    function delete_conversation($username) {
        $url = "https://cs306p-default-rtdb.firebaseio.com/" . $username . ".json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        $result = curl_exec($ch);
        curl_close($ch);
    }
?>

<?php if($user_data["usr_isadmin"]) : ?>

<?php
    $username = $user_data['usr_username'];

    if (isset($_POST['end'])) {
        delete_conversation($_POST['username']);
    } elseif (isset($_POST['username']) && isset($_POST['usermsg'])) {
        $username = $_POST['username'];
        $user_msg = $_POST['usermsg'];
        send_msg_to($username, $user_msg, "admin");
    }

    header("Location: support.php?username=" . $username);
?>

<?php else : ?>

<?php
    $username = $user_data['usr_username'];

    if (isset($_POST['end'])) {
        delete_conversation($username);
    } elseif (isset($_POST['usermsg'])) {
        $user_msg = $_POST['usermsg'];
        send_msg_to($username, $user_msg, "user");
    } else {
        //Create new issue
        if (isset($_POST['issueType'])) {
            $issueType = $_POST['issueType'];
            create_issue($username, $issueType);

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

            //send_msg_to($username, "I would like help on an issue with type " . $issue, "user");
        }
    }

    header("Location: support.php");
    
?>

<?php endif; ?>