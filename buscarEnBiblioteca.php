<?php
session_start();
error_reporting(0);
$var_session=$_SESSION['usuario'];
if($var_session=='' || $var_session==null){
    echo "No has iniciado sesion...";
    die();
}
$servidor="localhost";
$usuario="daniel";
$contrasena="12345";
$db="biblioteca";

$id=$_POST['id'];
$nombre=$_POST['nombre'];
$editorial=$_POST['editorial'];
$autor=$_POST['autor'];
$ano=$_POST['ano'];
$ubicacion=$_POST['ubicacion'];
$volumen=$_POST['volumen'];
$edicion=$_POST['edicion'];
$cantidad=$_POST['cantidad'];
$categoria=$_POST['categoria'];

$vid=" id='$id' ";
$vnombre=" AND nombre='$nombre' ";
$veditorial=" AND editorial='$editorial' ";
$vautor=" AND autor='$autor' ";
$vano=" AND ano='$ano' ";
$vubicacion=" AND ubicacion='$ubicacion' ";
$vvolumen=" AND volumen='$volumen' ";
$vedicion=" AND edicion='$edicion' ";
$vcantidad=" AND cantidad='$cantidad' ";
switch($categoria){
    case "bio":
        $vcategoria=" AND ubicacion=1 ";
        break;
    case "hist":
        $vcategoria=" AND ubicacion=2 ";
        break;
    case "mate":
        $vcategoria=" AND ubicacion=3 ";
        break;
    case "admin":
        $vcategoria=" AND ubicacion=4 ";
        break;
    case "quim":
        $vcategoria=" AND ubicacion=5 ";
        break;
    case "fis":
        $vcategoria=" AND ubicacion=6 ";
        break;
    case "prog":
        $vcategoria=" AND ubicacion=7 ";
        break;
    case "esta":
        $vcategoria=" AND ubicacion=8 ";
        break;
    case "ciso":
        $vcategoria=" AND ubicacion=9 ";
        break;
    case "filo":
        $vcategoria=" AND ubicacion=10 ";
        break;
    case "":
        $vcategoria="";
        break;
}

$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}
if($id==null || $id==''){
    $vid="";
    $vnombre=" nombre='$nombre' ";
}
if($nombre==null || $nombre==''){
    $vnombre="";
    $veditorial=" editorial='$editorial' ";
}
if($editorial==null || $editorial==''){
    $veditorial="";
    $vautor=" autor='$autor' ";
}
if($autor==null || $autor==''){
    $vautor="";
    $vano=" ano='$ano' ";
}
if($ano==null || $ano==''){
    $vano="";
    $vubicacion=" ubicacion='$ubicacion' ";
}
if($ubicacion==null || $ubicacion==''){
    $vubicacion="";
    $vvolumen=" volumen='$volumen' ";
}
if($volumen==null || $volumen==''){
    $vvolumen="";
    $vedicion=" edicion='$edicion'";
}
if($edicion==null || $edicion==''){
    $vedicion="";
    $vcantidad=" cantidad='$cantidad'";
}
if($cantidad==null || $cantidad==''){
    $vcantidad="";
    switch($categoria){
        case "bio":
            $vcategoria=" ubicacion=1 ";
            break;
        case "hist":
            $vcategoria=" ubicacion=2 ";
            break;
        case "mate":
            $vcategoria=" ubicacion=3 ";
            break;
        case "admin":
            $vcategoria=" ubicacion=4 ";
            break;
        case "quim":
            $vcategoria=" ubicacion=5 ";
            break;
        case "fis":
            $vcategoria=" ubicacion=6 ";
            break;
        case "prog":
            $vcategoria=" ubicacion=7 ";
            break;
        case "esta":
            $vcategoria=" ubicacion=8 ";
            break;
        case "ciso":
            $vcategoria=" ubicacion=9 ";
            break;
        case "filo":
            $vcategoria=" ubicacion=10 ";
            break;
        case "":
            $vcategoria="";
            break;
    }

}
if($categoria==null || $categoria==''){
    $vcategoria="";
}

$consulta="SELECT * FROM libros WHERE"."$vid"."$vnombre"."$veditorial"."$vautor"."$vano"."$vubicacion"."$vvolumen"."$vedicion"."$vcantidad"."$vcategoria";


$resultado=mysqli_query($conexion,$consulta);
$filas=mysqli_num_rows($resultado);
/*$ti=mysqli_fetch_array($resultado);
echo " Encontrado ",$ti['nombre'],"<br>";*/
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
        @import url('https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz');
        </style>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <div><p id="titulo">Biblioteca Virtual</p><br>  
        <img src="books3.png" alt=""><br><br>
        <p id="seccion">Resultados de busqueda</p></div>
        <div class="principal">
        
            
                <?php                
                if (mysqli_num_rows($resultado)>0) 
                {
                        while($row = mysqli_fetch_assoc($resultado)) 
                        {
                           echo "<div class=results>";
                             echo "
                             <table width=\"100%\" border=\"1\"><center>
                                    <tr>
                                        <td>ID: </td>
                                        <td>".$row['id']."</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre: </td>
                                        <td>".$row['nombre']."</center></td>
                                    </tr>
                                    <tr>
                                        <td>Autor: </td>
                                        <td>".$row['autor']."</center></td>
                                    </tr>
                                    <tr>
                                        <td>Editorial: </td>
                                        <td>".$row['editorial']."</td>      
                                    </tr>
                                    <tr>
                                        <td>Año: </td>
                                        <td>".$row['ano']."</td>
                                    </tr>
                                    <tr>
                                        <td>Ubicacion: </td>
                                        <td>".$row['id']."</td>
                                    </tr>
                                    <tr>
                                        <td>Volumen: </td>
                                        <td>".$row['volumen']."</td>
                                    </tr>
                                    <tr>
                                        <td>Edicion: </td>
                                        <td>".$row['edicion']."</td> 
                                    </tr>
                                    <tr>
                                        <td>Cantidad: </td>
                                        <td>".$row['cantidad']."</td>
                                    </tr>
                            </center> </table>";
                            echo "</div>";            
                        }
                } else {    echo $consulta;
                            echo "0 resultados";
                }
                ?>
                                    
        </div>
        <div class="return">
            <p class="links">
            <a href="buscarLibros.php" id="link">Volver a Busqueda</a><br>    
            <a href="bienvenido.php" id="link">Volver a Pagina principal</a><br>
            <a href="cerrar_session.php" id="link">Cerrar sesion</a><br>
            </p>
        </div>
        
    
    
    </body>
</html>