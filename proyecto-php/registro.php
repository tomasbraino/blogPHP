<?php

//conexion a la base de datos
require_once 'includes/conexion.php';




if (isset($_POST['submit'])) {

    //Recoger los valores del formulario de registro
    // operadores ternarios
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //array de errores
    $errores = array();



    //Validar los datos antes de guardarlos en la base de datos
    //VALIDAR CAMPO NOMBRE
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
        echo "el nombre es valido";
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";
    }
    //VALIDAR APELLIDOS
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {

        $apellidos_validado = true;
        echo "el apellido es valido";
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "El apellido no es valido";
    }


    //VALIDAR EL EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
        echo "el email es valido";
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es valido";
    }


    //VALIDAR EL PASSWORD
    if (!empty($password)) {
        $password_validado = true;
        echo "el email es valido";
    } else {
        $password = false;
        $errores['password'] = "El password no es valido";
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {


        $guardar_usuario = true;
        //CIFRAR LA CONTRASEÑA
        // cifrando contraseña en 4 pasadas
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        // var_dump($password);
        //var_dump($password_segura);
        //die();
        //var_dump(password_verify($password, $password_segura));
        //INSERTAR USUARIO EN LA TABLA USUARIOS DE BBDD 
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);

//        var_dump(mysqli_error($db));
//        die();


        if ($guardar) {

            $_SESSION['completado'] = "El registro se ha completado con exito";
        } else {

            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }
    } else {

        $_SESSION['errores'] = $errores;
        header('location: index.php');
    }

    header('location: index.php');
}




  
    




