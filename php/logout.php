<?php

    require_once 'global.php';

    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage

    header('location: ../index.php');
    exit;

?>