<?php
session_start();
error_reporting(0);
$var_session=$_SESSION['usuario'];
if($var_session==null || $var_session==''){
    header("location:forbidden.html");
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
        </style>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <div><p id="titulo">Biblioteca Virtual</p><br>  
        <img src="admin.png" alt="">
        <p id="seccion">Bienvenido</p>
        
        <p class="props">Bienvenido 
            <?php 
            echo "<b> [",$_SESSION['tipo'],"] </b>";
            echo $_SESSION['usuario'],"<br>";
            echo "Tienes [",$_SESSION['prestamos'],"/3] libros prestados"?>
        </p><br>
        <p class="links">
        <?php 
        if($_SESSION['tipo']=='admin'){
            echo 'Que tal Administrador<br>';
            echo ' ';
            echo '<a href="reportePrestamos.php">Generar reporte de prestamos</a><br>';
        echo '<a href="reporteUsuarios.php">Generar reporte de usuarios</a><br>';
            echo '<a href="panelAdministrador.php">Panel de Administracion</a><br>';
        }else if($_SESSION['tipo']=='alumno'){
            echo 'Que tal Alumno<br>';
            echo ' ';
            echo '<a href="perfilUsuario.php">Perfil</a><br>';
        }else if($_SESSION['tipo']=='cap'){
            echo 'Que tal Capturista<br>';
            echo ' ';
            echo '<a href="panelCapturista.php">Panel de Captura</a><br>';
        }
        ?>
        <a href="buscarLibros.php" id="link">Buscar Libros</a><br>
        <a href="cerrar_session.php" id="cerrar">Cerrar sesion</a><br>
        </p>
        </div>
    </body>
    
</html>