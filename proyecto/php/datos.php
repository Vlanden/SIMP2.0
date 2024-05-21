<?php
    session_start();
    if(!isset($_SESSION['ID'])){
        header("Location: ../proyecto/usuarioHTML/InicioSesion.html");
    }

    require_once('proyecto/php/conexionBD.php');
    $ID = $_SESSION['ID'];
    $sql = mysqli_query($conexion, "SELECT * FROM simp WHERE ID = '{$ID}'");

    $sql = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../usuarioCSS/usuarios.css">
    <title>Datos de usuario</title>
</head>
<body>

    <header class="header">
        <article>
            <section class="logo" >
                <a href="datos.html"><img src="../Imagenes/LOGO SIMP-Photoroom.png-Photoroom.png" alt="somos simp"></a>
            </section>
        </article>
        <nav class="navbar">
            <ul class="nav-items">
                <li>
                    <a href="Contactanos.html" class="links-nav">Contactos</a>
                </li>

                <li>
                    <a href="PreguntasF.html" class="links-nav">Preguntas Frecuentes</a> 
                </li>

                <li>
                    <a href="Nosotros.html" class="links-nav">Mas de nosotros</a>
                    
                </li>

                <li>
                    <a href="tyc.html" class="links-nav">Politicas</a>
                </li>               
            </ul>
        </nav>
    </header>

<!--

    Truchas pibes. Este es el diseño para que coloquen los datos del usuario desde la base de datos, segun datos ingresados
    ingresados se veran cmo los textos que terminan en "ejemplo" al igual que la imagen, y claro, borren los ejemplos de la foto
    con los atributos ya configurados para que tengan ciertas, medidas y esten en el centro.

    Los identificadores son los mismos que mis nuevas ventanas, pero estan en otros elementos HTML y con nuevas caracteristicas
    considerablemente distintas.

    Mas notas:

    fotoUsuario: identificador de imagen unico para que aparezca el rostro del usuario
    cf: identificador de la imagen de una tuerca que lleva a la configuracion de los datos del usuario

    :D

-->

    <main>
        <article>
            <section id="info">
                <h1>BIENVENIDO</h1>
                <div id="foto-item"><img id="fotoUsuario" src="../Imagenes/LOGO SIMP-Photoroom.png-Photoroom.png"></div>
                <div id="config">
                <a href="ConfigurarDatos.html"><img src="../Imagenes/configuraciones.png" id="cf"></a>
                </div>
                <!-- <a href="ConfigurarDatos.html"><input type="button" value="Configuracion" id="config"></a> -->
                <p id="N"><?php echo $sql['nom'];?></p>
                <p id="ID"><?php echo $sql['ID'];?></p>
                <p id="C"><?php echo $sql['correo'];?></p>
                <a href="../../PHP/logout.php">Cerrar Sesion</a>
            </section>
        </article>
    </main>

    <footer>

    </footer>

</body>
</html>