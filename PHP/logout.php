<?php
    session_start();
    if(isset($_SESSION['ID'])){
        session_unset();
        session_destroy();
        header("Location: ../proyecto/usuarioHTML/InicioSesion.html");
    }else{
        header("Location: ../proyecto/usuarioHTML/InicioSesion.html");
    }
?>