<?php

function mostrarError($errores, $campo) {

    if (isset($errores[$campo]) && !empty($campo)) {

        $alerta = "<div class = 'alert alerta-error'>" . $errores[$campo] . '</div>';
    }

    return $alerta;
}

function conseguirCategorias($conexion) {

    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($conexion, $sql);

    $result = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {

        $result = $categorias;
    }

    return $result;
}

function borrarErrores() {

    $_SESSION['errores'] = null;
    $borrado = session_unset($_SESSION['errores']);

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        session_unset($_SESSION['completado']);
    }


    return $borrado;
}

function conseguirUltimasEntradas($conexion) {

    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e" .
            "INNER JOIN categorias c ON e.categoria_id = c.id" .
            "ORDER BY e.id DESC LIMIT 4";


    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {

        $resultado = $entradas;
    }
    return $entradas;
}
