<?php
session_start();
include_once("config.php");
include_once("BuscarUsuario.php")
$hash = password_hash($password, PASSWORD_DEFAULT, [12]);

?>