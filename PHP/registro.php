<?php
session_start();
include_once "conexionBD.php";

$email=$_POST["correo"];
$encrypt_pass=$_POST["pass"];
$email=stripcslashes($email);
$encrypt_pass=stripcslashes($encrypt_pass);
$email = mysqli_real_escape_string($conexion, $email);
$name=$_POST['name'];
$encrypt_pass = password_hash($encrypt_pass, PASSWORD_DEFAULT,['cost' => 15]);
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
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        
                        $img_name = $name .'.png';
                        if (move_uploaded_file($tmp_name, "images/" . $img_name)) {
                            $insert_query = mysqli_query($conexion, "INSERT INTO simp(correo, pass, img )
                                VALUES ('$email', '$encrypt_pass', '$img_name')");
                                
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conexion, "SELECT * FROM simp WHERE correo = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    //$_SESSION['unique_id'] = $result['unique_id'];
                                    header("Location:google.html");
                                    //echo "Proceso Exitoso";
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
