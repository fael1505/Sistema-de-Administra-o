<?php

session_start();

//AUTO DESTROY SESSION
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    require_once 'logout.php';
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

//MYSQL CONNECTION
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'administration_db');

/* Attempt to connect to MySQL database */
$sql_link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

?>