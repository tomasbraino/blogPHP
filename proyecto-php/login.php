<?php

//LOGIN
//iniciar sesion y la conexion a bd
require_once 'includes/conexion.php';


// recoger datos del formulario
if (isset($_POST)) {

    //Borrar error antiguo
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }


    //       Recoger datos del formulario



    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Comprobar la contraseña / cifrar 
    if (password_verify($password, $hash)) {
        
    }
}
// 
//Consulta para comprobar las crendenciales del usuario
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$login = mysqli_query($db, $sql);

if ($login && mysqli_num_rows($login) == 1) {

    $usuario = mysqli_fetch_assoc($login);
    $verify = password_verify($password, $usuario['password']);
    if ($verify) {
        //Utilizar una sesion para guardar los dtos del usuario logueado
        $_SESSION['usuario'] = $usuario;
    } else {

        //Si algo falla enviar una sesion con el fallo
        $_SESSION['error_login'] = "Login incorrecto";
    }
} else {

    //mensaje de error
    $_SESSION['error_login'] = "Login incorrecto";
}



// redirigir al index.php

header('Location: index.php');





