<?php

$input_data = json_decode(file_get_contents('php://input'), true);

if (!$input_data) {
    echo json_encode(["error" => "Invalid json data"]);
    exit;
}

$user_id = trim( $input_data['user_id'] ?? '');
$user_pw = $input_data['user_pw'] ?? '';
$user_email = trim( strtolower( $input_data['user_email'] ?? ''));


function gohome($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}



$userlist = array($user_id,$user_pw,$user_email);

if ( !empty( $user_id)) {
    if ( !empty( $user_pw)) {
        if ( !empty( $user_email)) {
            if ( filter_var( $email, FILTER_VALIDATE_EMAIL)) {
                $db_user_check = pg_query_params($DB_connection,"SELECT user_id FROM userdata WHERE user_id = '$user_id'");
                
                if( !pg_num_rows( $db_user_check)) {
                    $msg = "You need to enter other user name";
                    gohome("sign_up.html");
                }
                
                $db_insert=pg_query_params( $DB_connection,"INSERT INTO userdata (user_id, user_pw, user_email) VALUES ('$user_id', '$user_pw', '$user_email')");
                
                if ( !$db_insert){
                    $msg = "Can't add new user";
                    gohome("sign_up.html");
                }

                $db_user_select = pg_query_params( $DB_connection,"SELECT user_id, user_number,user_email FROM userdata WHERE user_id = '$user_id'");
                
                $user_id = $db_user_select[0]['user_id'];
                $user_number = $db_user_select[0]['user_number'];
                $user_email = $db_user_select[0]['user_email'];
                $valid = true;
                $timeout = time();
                
                $msg = "You have entered correct username and password";
                
                echo json_encode([
                    "user_id" => $user_id,
                    "user_number" => $user_number,
                    "user_email" => $user_email,
                    "valid" => $valid,
                    "timeout" => $timeout
                ]);

                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_number'] = $user_number;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['valid'] = $valid;
                $_SESSION['timeout'] = $timeout;

            } else {
                $msg = "You have entered wrong Email";
                gohome("sign_up.html");
            }
        } else {
            $msg = "You need to enter Email";
            gohome("sign_up.html");
        }
    } else {
        $msg = "You have entered wrong Password";
        gohome("sign_up.html");
    }
} else {
    $msg = "You have entered wrong user name";
    gohome("sign_up.html");
}
