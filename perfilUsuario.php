<?php
session_start();
error_reporting(0);
$var_session=$_SESSION['usuario'];
if($var_session==null || $var_session==''){
    echo "Usted no puede entrar a esta pagina, necesita iniciar sesion";
    die();
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Biblioteca - <?php echo $_SESSION['usuario']; ?></title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Berkshire+Swash');
            @import url('https://fonts.googleapis.com/css?family=Varela+Round');
            @import url('https://fonts.googleapis.com/css?family=Poppins');
            @import url('https://fonts.googleapis.com/css?family=Questrial');
            
            #titulo {
                font-family: 'Varela Round';
                text-align: center;
                font-size: 20px;
                color: white;
            }
            
            body {
                background-color: midnightblue;
            }
            
            
            
            
            
            
            
            #seccion {
                font-family: 'Varela Round';
                color: white;
                margin-left: 20px;
            }
        </style>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        
        <div><p id="titulo">Biblioteca Virtual</p><br> 
        <img src="config.png" alt=""> <br><br>
        <p id="seccion">Configuracion de Perfil</p><br>
        
        <p class="links">
            <a href="bienvenido.php" id="link">Volver a Pagina principal</a><br><br>
            <a href="cerrar_session.php" id="cerrar">Cerrar sesion</a><br>
        </p>
        
        </div>
    </body>
    
</html>