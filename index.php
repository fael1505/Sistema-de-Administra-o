<?php

require_once 'php/global.php';

if(isset($_SESSION['loggedin'])) {

  echo 'LOGGED';

}else{

  include 'pages/login.php';

}

?>