<?php
session_start();
include_once "conexionBD.php";
// Recoger los datos del formulario
$name = mysqli_real_escape_string($conexion,$_POST['Nom']);
$email= mysqli_real_escape_string($conexion,$_POST['Email']);
echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA3";
$id = isset($_POST['ID']) ? $_POST['ID'] : null;
echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA4";
if ( !empty($name)  && !empty($email) ) {
    echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA5";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA6";

        $sql = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - ¡Este e-mail ya existe!";
        } else {
            echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA7";

            if (isset($_FILES['image']) ) {
                echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA8";

                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

            $extensions = ["jpeg", "PNG", "jpg"];
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_ext, $extensions) === true && in_array($img_type, $types) === true) {
                echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA9";

                    $img_name = $name .'.png';
                    //Mover imagen a la carpeta deseada
                    if (move_uploaded_file($tmp_name, "./Rostros/" . $img_name)) {
                        echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA10";

                        $encrypt_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT,['cost' => 15]);

                        $img_name = $name .'.png';
                            echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA11";

                            if ($id !== null) {
                                echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA12";

                                // Insertar con ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, ID, pass, img)
                                    VALUES ('$name', '$email', '$id', '$encrypt_pass', '$img_name')");
                            } else {
                                echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA13";
                                $ran_id = rand(time(), 100000000);
                                $ID_Alternative = $img_name . $ran_id;
                                // Insertar sin ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, ID, pass, img)
                                    VALUES ('$name', '$email', $ID_Alternative,'$encrypt_pass', '$img_name')");
                            }
                            if ($insert_query) {
                                echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA14";

                                $select_sql2 = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['ID'] = $result['ID'];
                                    header("Location:./usuarioHTML/InicioSesion.html");
                                    echo "Proceso Exitoso";
                                }{
                                echo "Algo salió mal. ¡Inténtalo de nuevo!";
                            }
                        }
                } else {
                    echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA2";
                }
            }
        }
    } 
} 
}