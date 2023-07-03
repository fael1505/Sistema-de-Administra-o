<?php

  if(isset($_SESSION['loggedin'])) { return; }

  require_once 'php/global.php';
  require_once 'php/login.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="style/global.css" />
    <script type="text/javascript" src="js/global.js"></script>
  </head>
  <body>
    <div class="login loginSize">
      <div class="descriptionBox">
        <img
          src="style/imgs/loginDescriptionLogo.png"
          alt="Sistema de Administração"
          class="logo"
        />
        <div class="description">
          <h1>Sistema de administração</h1>
          <p>Tudo que você precisa em um só lugar!</p>
        </div>
      </div>
      <div class="loginBox">
        <form method="POST">
          <input
            type="text"
            name="user"
            placeholder="Nome de usuário"
            id="user"
          />
          <input type="password" placeholder="Senha" name="pass" id="pass" />
          <input
            type="submit"
            value="Entrar"
            id="btnLogin"
          />
          <p id="login_result"><?php echo $login_result; ?></p>
          <p>
            Ainda não tem uma conta?<br />Clique <a href="#">aqui</a> e crie
            agora mesmo!
          </p>
        </form>
      </div>
    </div>
  </body>
</html>