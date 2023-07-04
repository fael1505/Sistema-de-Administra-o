<?php

  require_once 'php/global.php';
  if(isset($_SESSION['loggedin'])) { return; }
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
    <script>
      function loginBox(){
        document.getElementById('loginForm').style = "display:flex;opacity:1;";
        document.getElementById('registerForm').style = "display:none;opacity:0;";
      }
      function registerBox(){
        document.getElementById('registerForm').style = "display:flex;opacity:1;";
        document.getElementById('loginForm').style = "display:none;opacity:0;";
      }
    </script>
  </head>
  <body onload="<?php if($request_form=="login"){echo "loginBox()";}elseif($request_form=="register" && $success_msg==false){echo "registerBox()";}else{echo "loginBox()";} ?>">
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
      <form method="POST" id="loginForm" style="display:flex;opacity:1;">
          <input
            type="text"
            name="log_user"
            placeholder="Nome de usuário"
            id="user"
            value="<?php if($request_form=="login"){echo $_POST['log_user'];}elseif($request_form=="register" && $success_msg==true){echo $_POST['reg_user'];} ?>"
          />
          <input type="password" placeholder="Senha" name="log_pass" id="pass" />
          <input
            type="submit"
            value="Entrar"
            id="btnLogin"
          />
          <p id="login_result<?php if($success_msg){echo " success";}else{echo " failed";} ?>"><?php echo $login_result; ?></p>
          <p>
            Ainda não tem uma conta?<br />Clique <a href="javascript:registerBox();">aqui</a> e crie
            agora mesmo!
          </p>
        </form>
        <form method="POST" id="registerForm" style="display:none;opacity:0;">
          <input
            type="text"
            name="reg_user"
            placeholder="Nome de usuário"
            id="user"
            value="<?php if($request_form=="register" && $success_msg==false){echo $_POST['reg_user'];} ?>"
          />
          <input type="password" placeholder="Senha" name="reg_pass" id="pass" value="<?php if($request_form=="register" && $success_msg==false){echo $_POST['reg_pass'];} ?>" />
          <input type="password" placeholder="Confirme sua senha" name="reg_pass2" id="pass" value="<?php if($request_form=="register" && $success_msg==false){echo $_POST['reg_pass2'];} ?>" />
          <input
            type="submit"
            value="Criar conta"
            id="btnRegister"
          />
          <p id="register_result<?php if($success_msg){echo " success";}else{echo " failed";} ?>"><?php echo $register_result; ?></p>
          <p>
            Já tem uma conta?<br />Clique <a href="javascript:loginBox();">aqui</a> para fazer login!
          </p>
        </form>
      </div>
    </div>
  </body>
</html>