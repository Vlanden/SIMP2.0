<?php
session_start();
include_once "conexionBD.php";
$email = mysqli_real_escape_string($conexion, $_POST['correo']);
$password = mysqli_real_escape_string($conexion, $_POST['pass']);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if (password_verify($password, $row['pass'])) {
           // $_SESSION['ID'] = $row['ID'];
            header("Location:../Succesful.html");
        } else {
            echo "¡Correo electrónico o la contraseña son incorrectos!";
        }
    } else {
        echo '$email <script type="text/javascript">
        alert("¡Correo electrónico o contraseña incorrectos!");
        window.location.href="login.php";
        </script>';
    }
} else {
    echo "¡Todos los campos de entrada son obligatorios!";
}
?>

/*
Protección contra inyección SQL:
Aunque estás utilizando mysqli_real_escape_string es preferible utilizar (prepared statements) para proteger contra ataques de inyección SQL. 
Manejo de errores y mensajes de usuario:
En lugar de mostrar mensajes de error directamente en la página, considera redirigir al usuario a una página de error o mostrar un mensaje más amigable.
Validación de campos de entrada:
Asegúrate de validar los campos de entrada (correo electrónico y contraseña) antes de procesarlos. Por ejemplo, verifica si el correo electrónico tiene un formato válido y si la contraseña cumple con ciertos requisitos (longitud mínima, caracteres especiales, etc.).
Manejo de sesiones:
Aunque has incluido session_start(), no veo dónde se está utilizando la variable de sesión $_SESSION['ID']. Asegúrate de usarla en otras partes de tu aplicación para mantener la sesión del usuario.
*/
