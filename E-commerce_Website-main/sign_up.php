<?php

$user_id = trim( $_POST[ 'user_id']);
$user_pw = $_POST[ 'user_pw'];
$user_email = trim( strtolower( $_POST[ 'user_email']));

function gohome($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}


$userlist = array($user_id,$user_pw,$user_email);

if ( isset( $_POST[ 'submit'])) {
    if ( !empty( $user_id)) {
        if ( !empty( $user_pw)) {
            if ( !empty( $user_email)) {
                if ( filter_var( $email, FILTER_VALIDATE_EMAIL)) {
                    $db_user_check = pg_query_params($DB_connection,"SELECT user_id FROM userdata WHERE user_id = '$user_id'");
                    if( !pg_num_rows( $db_user_check)) {
                        $msg = "You need to enter other user name";
                        gohome("index.html");
                    }
                    $db_insert=pg_query_params( $DB_connection,"INSERT INTO userdata (user_id, user_pw, user_email) VALUES ('$user_id', '$user_pw', '$user_email')");
                    if ( !$db_insert){
                        $msg = "Can't add new user";
                        gohome("index.html");
                    }
                    $db_user_select = pg_query_params( $DB_connection,"SELECT user_id, user_number FROM userdata WHERE user_id = '$user_id'");
                    $_SESSION[ 'user_id'] = $db_user_select[0]['user_id'];
                    $_SESSION[ 'user_number'] = $db_user_select[0]['user_number'];
                    $_SESSION[ 'valid'] = true;
                    $_SESSION[ 'timeout'] = time();
                    $msg = "You have entered correct username and password";
                    gohome("index.html");
                } else {
                    $msg = "You have entered wrong Email";
                    gohome("index.html");
                }
            } else {
                $msg = "You need to enter Email";
                gohome("index.html");
            }
        } else {
            $msg = "You have entered wrong Password";
            gohome("index.html");
        }
    } else {
        $msg = "You have entered wrong user name";
        gohome("index.html");
    }
}