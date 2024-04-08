<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['em']);
$password = mysqli_real_escape_string($conn, $_POST['cn']);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if (password_verify($password, $row['pass']);) {
            $_SESSION['ID'] = $row['ID'];
            header("Location:users.php");
        } else {
            echo "¡Correo electrónico o la contraseña son incorrectos!";
        }
    } else {
        echo '$email <script type="text/javascript">
        alert("¡Este correo electrónico no existe!");
        window.location.href="login.php";
        </script>';
    }
} else {
    echo "¡Todos los campos de entrada son obligatorios!";
}
?>