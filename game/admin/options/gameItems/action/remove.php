<?php

    require_once '../../../../../php/global.php';
    require_once '../../../../../php/sql.php';

    if(!isset($_SESSION['adminLoggedin']) || !isset($_GET['id'])) { return; }

    $itemId = $_GET['id'];

    $sql = "DELETE FROM items WHERE id='$itemId'";

    mysqli_query(sql_link, $sql);
    mysqli_close(sql_link);

    header("location: ../");

?>