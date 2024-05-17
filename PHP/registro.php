<?php
session_start();
include_once "conexionBD.php";

// Recoger los datos del formulario
$name=$_POST['name'];
$email=$_POST["correo"];

/*
// Función para generar un ID único
function generarIDUnico($conexion) {
    $id = uniqid('user_');
    // Aquí podrías agregar lógica adicional para verificar que el ID no se repita
            // Consulta SQL para seleccionar todos los valores de la tabla "id"
        $resultado = mysqli_query($conexion,"SELECT * FROM id");

        // Verificar si hay resultados
        if (mysqli_num_rows($resultado)) {
            // Recorrer los resultados y mostrarlos
            while ($fila = $resultado->) {
                fetch_assoc()
                echo "ID: " . $fila["id"] . "<br>";
            }
        } else {
            echo "No se encontraron registros en la tabla 'id'.";
        }

    return $id;
}

// Verificar si se ha enviado un ID
$id = isset($_POST['ID']) ? $_POST['ID'] : generarIDUnico($conexion);
*/

$id =$_POST["ID"];

$encrypt_pass=$_POST["pass"];
$confirmar_pass = $_POST['confirmar_pass'];

$email=stripcslashes($email);
$encrypt_pass=stripcslashes($encrypt_pass);
$confirmar_pass=stripcslashes($confirmar_pass);


// Seguridad anti inyección SQL
$nombre = mysqli_real_escape_string($conexion, $nombre);
$correo = mysqli_real_escape_string($conexion, $correo);
$contrasena = mysqli_real_escape_string($conexion, $contrasena);

// Verificar que las contraseñas coincidan y encriptar la contraseña

if ($encrypt_pass !== $confirmar_pass) {
    die('Las contraseñas no coinciden.');//die es un exit()Detiene la ejecucion del programa
    
} else {
    $encrypt_pass = password_hash($encrypt_pass, PASSWORD_DEFAULT,['cost' => 15]);
}


if ( !empty($email) ) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - ¡Este e-mail ya existe!";
        } else {
            if (isset($_FILES['image']) ) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

            $extensions = ["jpeg", "PNG", "jpg"];
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_ext, $extensions) === true && in_array($img_type, $types) === true) {
                    
                    $img_name = $name .'.png';
                    //Mover imagen a la carpeta deseada
                    if (move_uploaded_file($tmp_name, "\SIMP2.0\Rostro" . $img_name)) {
                        $encrypt_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT,['cost' => 15]);
                        
                        $img_name = $name .'.png';
                        if (move_uploaded_file($tmp_name, "images/" . $img_name)) {
                            $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, id, pass, img )
                                VALUES ('$name', '$email', '$id', '$encrypt_pass', '$img_name')");//Verificar identificador del id
                                
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    header("Location:google.html");
                                    echo "Proceso Exitoso";
                                }{
                                echo "Algo salió mal. ¡Inténtalo de nuevo!";
                            }
                        }
                    } else {
                        echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA1";
                    }
                } else {
                    echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA2";
                }
            }
        }
    } 
} 
}