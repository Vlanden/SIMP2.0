<?php
    require_once("conexionBD.php");
    $name = $_POST['email'];
    $pass=password_hash($_POST['pass'], PASSWORD_DEFAULT,['cost' => 15]);
    $sql = "UPDATE simp SET pass='$pass' WHERE correo='$name'";
    $envio = mysqli_query($conexion, $sql);
    header('Location:recuperacion.html');
   


