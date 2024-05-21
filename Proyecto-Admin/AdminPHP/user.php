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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../AdminCSS/Usuario.css">
    <link href="https://fonts.googleapis.com/css2?family=Briem+Hand:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Briem+Hand:wght@100..900&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../AdminJS/Funciones.js"></script>
    <title>Usuario</title>
</head>
<body>
    <header class="header">
        <article>
            <section class="logo" >
                <a href="../AdminHTML/Usuario.html"><img src="../Imagenes/LOGO-SIMP-Photoroom.png" alt="somos simp"></a>
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
    <main>
        <article id="contenedor">
            <section class="data">
                <div class="contenedor-Int">
                    <form method="post" action="deleteUser.php">
                    <h1 class="T">Datos del usuario</h1>
                    <br>
                    <h2 class="t">Nombre: <?php echo $sql['nom'];?></h2>
                    <br>
                    <h2 class="t">Correo: <?php echo $sql['correo'];?></h2>
                    <br>
                    <h2 class="t">Identificador: <?php echo $sql['ID'];?></h2>
                    <br>
                    <h2 class="t">Nivel de acceso: <?php echo $sql['LAccess'];?></h2>
                    <br>
                    <input type="hidden" name="ID" value="<?php echo $sql['ID'];?>">
                    <br>
                        <input type="submit" value="Borrar" id="borrar">
                    </form>
                </div>
            </section>

            <section class="data">
                <div class="contenedor-Int">
                    <form method="POST" action="actualizacion">
                        <h1 class="T">Modificar al usuario</h1>
                        <br>
                        <label for="NA"><h2 class="t">Nombre</h2></label>
                        <br>
                        <input type="text" id="NA" placeholder="Nombre actualizado">
                        <br><br>
                        <label for="CA"><h2 class="t">Correo</h2></label>
                        <br>
                        <input type="text" id="CA" placeholder="Correo actualizado">
                        <br><br>
                        <label for="IDA"><h2 class="t">Identificador</h2></label>
                        <br>
                        <input type="text" id="IDA" placeholder="ID actualizada">
                        <br><br>
                        <h2 class="t">Area</h2>
                        <br>
                        <select>
                            <option value="Docente">Docente</option>
                            <option value="Alumno" selected>Alumno</option>
                            <option value="Academico">Academico</option>
                            <option value="Seguridad">Seguridad</option>
                            <option value="Administracion">Administracion</option>
                            <option value="Rector">Rector</option>
                            <option value="Director">Director</option>
                            <option value="Visitante">Visitante</option>
                            <option value="Proveedor">Proveedor</option>
                        </select>
                        <br><br><br>
                        <input type="submit" value="Modificar">
                    </div>
                </form>
            </section>
        </article>
    </main>
</body>
</html>