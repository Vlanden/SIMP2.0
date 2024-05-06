<?php
    require_once("conexionBD.php");
    $name = $_POST['email'];
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    if(!empty($pass) and !empty($pass1) and !empty($email)  ){
        echo"Campos vacios";
    }else{
        if($pass===$pass1){
            $pass=password_hash($pass, PASSWORD_DEFAULT,['cost' => 15]);
            $sql = "UPDATE simp SET pass='$pass' WHERE correo='$name'";
            $envio = mysqli_query($conexion, $sql);
            header('Location:recuperacion.html');
        }else{
            echo"Contraseña no coincide";
        }
    }
    
    
   


