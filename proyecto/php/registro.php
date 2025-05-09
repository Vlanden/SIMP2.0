<?php
session_start();
include_once "conexionBD.php";
// Recoger los datos del formulario
$name = mysqli_real_escape_string($conexion,$_POST['Nom']);
$email= mysqli_real_escape_string($conexion,$_POST['Email']);
$id = mysqli_real_escape_string($conexion,$_POST['ID']);

if ( !empty($name)  && !empty($email) ) {
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
            if (!in_array($img_ext, $extensions) === true && in_array($img_type, $types) === true) {
                    $url = "https://superiorteam.site/SIMP2.0/proyecto/Rostros/";
                    $img_name = $name .'.png';

                    //Mover imagen a la carpeta deseada
                    if (move_uploaded_file($tmp_name, "../Rostros/" . $img_name)) {
                        $encrypt_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT,['cost' => 15]);
                        $ran_id = rand(time(), 100000000);
                        $img_name = $url.$name .'.png';

                            if ($id !== null) {

                                // Insertar con ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, ID, pass, img)
                                    VALUES ('$name', '$email', '$id', '$encrypt_pass', '$img_name')");
                            } else {
                                
                                // Insertar sin ID
                                $insert_query = mysqli_query($conexion, "INSERT INTO simp(nom, correo, ID, pass, img)
                                    VALUES ('$name', '$email', $ran_id,'$encrypt_pass', '$img_name')");
                            }
                            if ($insert_query) {

                                $select_sql2 = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['ID'] = $result['ID'];
                                    header("Location:../usuarioHTML/InicioSesion.html");
                                    echo "Proceso Exitoso";
                                }else{
                                echo "Algo salió mal. ¡Inténtalo de nuevo!";
                            }
                        }
                } else {
                    echo "Cargue un archivo de imagen: jpeg, png, jpg. PRUEBAA";
                }
            }
        }
    } 
} 
}
