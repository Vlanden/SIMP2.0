<?php
session_start();
include_once "conexionBD.php";
$email = mysqli_real_escape_string($conexion, $_POST['C']);
$password = mysqli_real_escape_string($conexion, $_POST['P']);
$id = mysqli_real_escape_string($conexion, $_POST['ID']);
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conexion, "SELECT * FROM admin WHERE correo = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if (password_verify($password, $row['pass']) && (strcmp($id,$row['ID']))) {
            $_SESSION['ID'] = $row['ID'];
            header("Location: ../AdminHTML/Usuario.html");
        } else {
            echo "¡El correo electrónico, la id o la contraseña son incorrectos!";
        }
    } else {
        echo '$email <script type="text/javascript">
        alert("¡El correo electrónico, la id o la contraseña son incorrectos!");
        window.location.href="Inicio.php";
        </script>';
    }
} else {
    echo "¡Todos los campos de entrada son obligatorios!";
}
?>


