<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        header("Location: ../proyecto/usuarioHTML/InicioSesion.html");
    }

    require_once('proyecto/php/conexionBD.php');
    $ID = $_SESSION['ID'];
    $name = $_POST['name'];
    $correo = $_POST['correo'];
    $sql = mysqli_query($conexion, "UPDATE simp SET nom = '{$name}', correo = '{$correo}' WHERE ID = '{$ID}'");

?>