<?php
session_start();
include_once "conexionBD.php";
$email=$_POST["correo"];
$password=$_POST["pass"];
$email=stripcslashes($email);
$password=stripcslashes($password);
$email = mysqli_real_escape_string($conexion, $email);
$password = mysqli_real_escape_string($conexion, $password);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if (password_verify($password, $row['pass'])) {
           //$_SESSION['ID'] = $row['ID'];
            header("Location:recuperacion.html");
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
Además, en lugar de mostrar el correo electrónico en el mensaje de error, podrías simplemente decir “Correo electrónico o contraseña incorrectos”.
Redirección después del inicio de sesión:
Después de verificar las credenciales, deberías redirigir al usuario a una página de inicio de sesión exitoso (por ejemplo, “users.php”) en lugar de simplemente mostrar un mensaje.
Validación de campos de entrada:
Asegúrate de validar los campos de entrada (correo electrónico y contraseña) antes de procesarlos. Por ejemplo, verifica si el correo electrónico tiene un formato válido y si la contraseña cumple con ciertos requisitos (longitud mínima, caracteres especiales, etc.).
Manejo de sesiones:
Aunque has incluido session_start(), no veo dónde se está utilizando la variable de sesión $_SESSION['ID']. Asegúrate de usarla en otras partes de tu aplicación para mantener la sesión del usuario.
*/
