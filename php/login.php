<?php

if(isset($_SESSION['loggedin'])) { return; }

require_once 'global.php';

$check_password_without_hash = true;
$login_result = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["user"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["user"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, name, pass FROM users WHERE name='$username';";
        
        if($result = mysqli_query($sql_link, $sql)){
            $num_rows = mysqli_num_rows($result);

            if($num_rows==1){
                //CORRECT USERNAME
                $row = $result->fetch_assoc();
                $password_ = $row['pass'];

                //CHECK HASHED PASSWORD
                if(password_verify($password, $password_)){
                    //CORRECT PASSWORD
                    loginSession($row['id'], $row['name']);
                }elseif($check_password_without_hash && $password_ == $password){
                    //CORRECT PASSWORD WITHOUT HASH
                    loginSession($row['id'], $row['name']);
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
        mysqli_close($sql_link);

    }

}

function loginSession($id, $name){
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['loggedin'] = true;
    header("refresh:0;");
}

?>