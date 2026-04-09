<?php

$user_id = trim( $_POST[ 'user_id']);
$user_pw = $_POST[ 'user_pw'];

function gohome($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}


$userlist = array($user_id,$user_pw);

if ( isset( $_POST[ 'submit'])) {
    if ( !empty( $user_id)) {
        if ( !empty( $user_pw)) {
            $db_user_check = pg_query_params($DB_connection,"SELECT user_id, user_pw, user_number FROM userdata WHERE user_id = '$user_id' AND user_pw = '$user_pw'");
            if( !pg_num_rows( $db_user_check)) {
                $msg = "You have entered wrong user name or password";
                gohome("index.html");
            }
            $_SESSION[ 'user_id'] = $db_user_check[0]['user_id'];
            $_SESSION[ 'user_number'] = $db_user_check[0]['user_number'];
            $_SESSION[ 'valid'] = true;
            $msg = "You logged in successfully";
            gohome("index.html");
        } else {
            $msg = "You need to enter a valid password";
            gohome("index.html");
        }
    } else {
        $msg = "You need to enter a valid user name";
        gohome("index.html");
    }
}

