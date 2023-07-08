<?php

if(isset($_SESSION['loggedin'])) { return; }

require_once 'global.php';
require_once 'class.simpleSQLinjectionDetect.php';

$request_form = "";

$login_result = "";
$register_result = "";
$success_msg = false;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['log_user']) && isset($_POST['log_pass'])){
        //LOGIN FORM
        $request_form="login";

        // Check if username is empty
        if(empty(trim($_POST["log_user"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["log_user"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["log_pass"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["log_pass"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, name, pass, isAdmin FROM users WHERE name='$username';";
            
            if($result = mysqli_query(sql_link, $sql)){
                $num_rows = mysqli_num_rows($result);

                if($num_rows==1){
                    //CORRECT USERNAME
                    $row = $result->fetch_assoc();
                    $password_ = $row['pass'];

                    //CHECK HASHED PASSWORD
                    if(password_verify($password, $password_)){
                        //CORRECT PASSWORD
                        loginSession($row['id'], $row['name'], $row['isAdmin']);
                    }else{
                        //INCORRECT PASSWORD
                        $login_result = "Usuário ou senha incorretos";
                    }
                }else{
                    $login_result = "Usuário ou senha incorretos";
                }
            }else{
                $login_result = "MySql Error";
            }

            // Close statement
            mysqli_close(sql_link);

        }

    } elseif(isset($_POST['reg_user']) && isset($_POST['reg_pass']) && isset($_POST['reg_pass2'])){
        //REGISTER FORM
        $request_form="register";

        $username = trim($_POST['reg_user']);
        $pass1 = trim($_POST['reg_pass']);
        $pass2 = trim($_POST['reg_pass2']);

        if(isset($username) && strlen($username)>=6){
            if(isset($pass1) && strlen($pass1)>=8){
                if($pass1==$pass2){

                    $sql = "SELECT name FROM users WHERE name='$username'";

                    if($result = mysqli_query(sql_link, $sql)){
                        
                        if(!mysqli_num_rows($result)){
                            
                            $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO users (name, pass, playerName) VALUES ('$username', '$pass_hash', '$username')";

                            if($result = mysqli_query(sql_link, $sql)){
                                $success_msg = true;
                                $login_result = "Registrado com sucesso!";
                            }else{
                                $register_result = "MySql Error";
                            }

                        }else{
                            $register_result = "Nome de usuário já existe";
                        }

                    }else{
                        $register_result = "MySql Error";
                    }

                }else{
                    $register_result="Senhas não coincidem";
                }
            }else{
                $register_result="Senha muito curta, mínimo 8 digitos";
            }
        }else{
            $register_result="Nome de usuário muito curto, mínimo 6 digitos";
        }

    }

}

function loginSession($id, $name, $isAdmin){
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['loggedin'] = true;
    if($isAdmin){
        $_SESSION['isAdmin'] = true;
    }
    header("refresh:0");
}

?>