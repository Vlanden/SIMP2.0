<?php
    require_once ("conexionBD.php");
    $user = mysqli_real_escape_string($conexion,$_POST['email']);
    $pass=mysqli_real_escape_string($conexion,$_POST['pass']);
    $pass2=mysqli_real_escape_string($conexion,$_POST['pass2']);

    if(strcmp($pass,$pass2)==0){
        $passNew=$pass2;
        $encrypt_pass = password_hash($passNew, PASSWORD_DEFAULT,['cost' => 15]);
       $sql="UPDATE simp SET pass = '$encrypt_pass' WHERE correo = '$user';";
        $envio = mysqli_query($conexion, $sql);
        if(!$envio) {
            echo "Error: " . mysqli_error($conexion);
        } else {
            header('Location:../usuarioHTML/InicioSesion.html');
        }
    }
    
?>
