<?php

require_once 'php/global.php';

if(isset($_SESSION['loggedin'])) {

  $initialPage = "home.php";

  if(!isset($_SESSION['currentPage'])){
    $_SESSION['currentPage'] = $initialPage;
  }

  include 'pages/loggedIn/' . $_SESSION['currentPage'];

}else{

  include 'pages/initialPage.php';

}

?>