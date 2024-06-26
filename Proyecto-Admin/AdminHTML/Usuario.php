<?php

    include_once("../PHP/conexionBD.php");

    $sentencia = 'SELECT * FROM usuarios';

    $enviar = mysqli_query($conexion,$sentencia);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Administrador</title>
    <link rel="stylesheet" type="text/css" href="../AdminCSS/Admin.css">
    <script src="https://kit.fontawesome.com/16f865f1da.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../AdminJS/FuncionesJS.js"></script>
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

        <article id="feed">
            <section id="info">
                <h1>BIENVENIDO</h1>
                <div id="foto-item">
                    <img id="fotoUsuario" src="../Imagenes/LOGO-SIMP-Photoroom.png">
                </div>
                
                <p id="N">Nombre de ejemplo</p>
                <p id="ID">ID de ejemplo</p>
                <p id="C">Correo de ejemplo</p>
            </section>
        </article>

        <article id="opc">
            <section>
                <!-- <div class="Busqueda">
                    <input type="text" placeholder="Busqueda" id="br">
                <button id="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div> -->
                <form method="post" action="#" class="Busqueda">
                    <input type="text" placeholder="Buscar usuarios">
                    <button type="submit" value="busqueda"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                
                <br>
                <div id="tabla">
                    <table class="usuarios">
                        <thead>
                            <tr>
                           
                                <th  id="nu">Nombre</th>
                                <th id="cu">Correo</th>
                                <th id="vp">Validar perfil</th>
                                <th id="hp">Ver perfil</th>
                            </tr>
                            
                        </thead>
                        
                                <?php
                                while($mostrar = mysqli_fetch_array($enviar)){
                                   
                                ?>
                        <tbody>
                            <tr>
                           
                               
                                <td class="ud"> <?php echo($mostrar['name']);?></td>
                                <td class="ud"> <?php echo($mostrar['Correo']);?></td>
                                <td><button class="Perfil" onclick="location.href='verfificacion.php'">Validar perfil</button></td>
                                <td><button class="Perfil" onclick="location.href='../AdminHTML/Usuarios.html'">Ingresar al perfil</button></td>
                                
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>
                </div>
            </section>
        </article>

    </main>

</body>
</html>
