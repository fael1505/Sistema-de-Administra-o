<?php

session_start();

//AUTO DESTROY SESSION
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800) && isset($_SESSION['loggedin'])) {
    // last request was more than 30 minutes ago
    require_once 'logout.php';
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

?>