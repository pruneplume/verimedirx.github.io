<?php

$input_data = json_decode( file_get_contents( 'php://input'), true);

if (!$input_data) {
    echo json_encode( [ "error" => "Invalid json data"]);
    exit;
}

$user_id = trim( $input_data['user_id'] ?? '');
$user_pw = $input_data['user_pw'] ?? '';

function gohome($url) {
    ob_start();
    header( 'Location: ' . $url);
    ob_end_flush();
    die();
}


$userlist = array( $user_id,$user_pw);

if ( !empty( $user_id)) {
    if ( !empty( $user_pw)) {
        $db_user_check = pg_query_params( $DB_connection, "SELECT user_id, user_pw, user_number FROM userdata WHERE user_id = '$user_id' AND user_pw = '$user_pw'");
        
        if( !pg_num_rows( $db_user_check)) {
            $msg = "You have entered wrong user name or password";
            gohome("log_in.html");
        }

        $user_id = $db_user_check[0]['user_id'];
        $user_number = $db_user_check[0]['user_number'];
        $valid = true;
        $timeout = time();

        $msg = "You logged in successfully";

        echo json_encode( [
            "user_id" => $user_id,
            "user_number" => $user_number,
            "user_email" => $user_email,
            "valid" => $valid,
            "timeout" => $timeout
        ]);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_number'] = $user_number;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['valid'] = $valid;
        $_SESSION['timeout'] = $timeout;

    } else {
        $msg = "You need to enter a valid password";
        gohome("log_in.html");
    }
} else {
    $msg = "You need to enter a valid user name";
    gohome("log_in.html");
}
