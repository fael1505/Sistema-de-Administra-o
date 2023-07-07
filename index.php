<?php

require_once 'php/global.php';

if(isset($_SESSION['loggedin'])) {

  include 'game/gameHandler.php';

}else{

  include 'pages/initialPage.php';

}

?>