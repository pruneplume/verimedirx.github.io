 <?php
  

// log out
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_pw"]);

    echo '<h4>You have cleaned session</h4>';
    header('Refresh: 2; URL = log_in.php');


$result = pg_query_params($dbconn, 'SELECT * FROM shops WHERE name = $1', array("Joe's Widgets"));
while ($row = pg_fetch_row($result)) {
    echo "<p>" . htmlspecialchars($row[0]) . "</p>\n";
}

  //<!----disconnect Database ---->
  pg_close($DB_connection);

?>