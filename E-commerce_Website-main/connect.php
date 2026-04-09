<?php
$hostname = "localhost";
$port = "5433";
$dbname = "database";
$username = "super";
$pw = "postgres";


//<!----connect Database---->
$DB_connection = pg_connect($hostname, $port, $dbname, "postgres", $pw)
or die('Could not connect: ' . pg_last_error() );
echo "Connected successfully";

//<!----check DB connect ----->
$DBstat = pg_connection_status($DB_connection);
if ($DBstat === PGSQL_CONNECTION_OK) {
    echo 'Connection status ok';
} else {
    echo 'Connection status bad';
}

$_SESSION["test1"] = "userconnect";
$_COOKIE["test2"] = "cookieconnect";


?>