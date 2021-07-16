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
        </style>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <div><p id="titulo">Biblioteca Virtual</p><br>  
        <img src="books.png" alt=""> 
        <p id="seccion">Panel Admin</p><br>
        <p id="sseccion">Rentar Libro</p></div>                                     
                       
        <div id="todo">
            <div id="busqueda">            
                <form class="search" action="rentarLibro.php" method="post">
                    <p id="search"><input type="text" name="id" placeholder="ID"></p>
                    <p id="search"><input type="text" name="nombre" placeholder="Nombre de libro"></p>
                    <p id="search"><input type="text" name="editorial" placeholder="Editorial"></p>
                    <p id="search"><input type="text" name="autor" placeholder="Autor"></p>
                    <p id="search"><input type="text" name="ano" placeholder="Año de publicacion"></p>
                    <p id="search"><input type="text" name="volumen" placeholder="VOL"></p>                
                    <p id="search"><input type="text" name="edicion" placeholder="Edicion"></p>
                    <p id="search"><input type="text" name="cantidad" placeholder="Cantidad"></p>
                    <p id="search"><input type="text" name="ubicacion" placeholder="Ubicación"></p>
                    <select name="categoria" class="search">
                        <option value="">Selecciona Categoria</option>
                        <option value="bio">Biologia</option>
                        <option value="hist">Historia</option>
                        <option value="mate">Matematicas</option>
                        <option value="admin">Administracion</option>
                        <option value="quim">Quimica</option>
                        <option value="fis">Fisica</option>
                        <option value="prog">Programacion</option>
                        <option value="esta">Estadistica</option>
                        <option value="ciso">Ciencias sociales</option>
                        <option value="filo">Filosofia</option>
                    </select>

                    <p id="search"><input type="text" name="iduser" placeholder="ID de usuario"></p>
                    <input type="submit" name="search" value="Rentar">
                </form>
            </div>
            <div id="busqueda">            
                <form class="search" action="entregarLibro.php" method="post">
                    <p id="search"><input type="text" name="eid" placeholder="ID de libro"></p>
                    <p id="search"><input type="text" name="eiduser" placeholder="ID de usuario"></p>
                    <input type="submit" name="search" value="Entregar">
                </form>
            </div>
            <div id="busqueda">            
                <form class="search" action="renovarLibro.php" method="post">
                    <p id="search"><input type="text" name="eid" placeholder="ID de libro"></p>
                    <p id="search"><input type="text" name="eiduser" placeholder="ID de usuario"></p>
                    <input type="submit" name="search" value="Renovar">
                </form>
            </div>
        </div>
        
        <p class="links">
        <a href="bienvenido.php" id="link">Volver a Pagina principal</a><br>
        <a href="cerrar_session.php" id="cerrar">Cerrar sesion</a><br>
        </p>
        
    </body>
    
</html>