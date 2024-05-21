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
            $_SESSION['ID'] = $row['ID'];
            header("Location:../usuarioHTML/datos.html");
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


