<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        header("Location: ../proyecto/usuarioHTML/InicioSesion.html");
    }
    require_once('../PHP/conexionBD.php');
    $sql = mysqli_query($conexion, "DELETE FROM simp WHERE ID = '{$ID}'");
?>