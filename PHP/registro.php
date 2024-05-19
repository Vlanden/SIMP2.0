<?php
session_start();
include_once "php/conexionBD.php";
// Recoger los datos del formulario
$name = $_POST['n'];
$email=$_POST["c"];
$id = isset($_POST['ID']) ? $_POST['ID'] : null;
if ( !empty($fname)  && !empty($email) ) {
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
                    if (move_uploaded_file($tmp_name, "SIMP2.0/Rostros/" . $img_name)) {
                        $encrypt_pass = password_hash($_POST['P'], PASSWORD_DEFAULT,['cost' => 15]);
                        
                        $img_name = $name .'.png';
                        if (move_uploaded_file($tmp_name, "SIMP2.0/Rostros/" . $img_name)) {
                            if ($id !== null) {
                                // Insertar con ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, id, pass, img)
                                    VALUES ('$name', '$email', '$id', '$encrypt_pass', '$img_name')");
                            } else {
                                // Insertar sin ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, pass, img)
                                    VALUES ('$name', '$email', '$encrypt_pass', '$img_name')");
                            }
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['ID'] = $result['ID'];
                                    header("Location:proyecto\usuarioHTML\InicioSesion.html");
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