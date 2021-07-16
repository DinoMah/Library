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
$iduser=$_POST['iduser'];

$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}

$arenta="SELECT * FROM usuarios WHERE id='$iduser'";
$res=mysqli_query($conexion,$arenta);
$fil=mysqli_num_rows($res);
$fi=mysqli_fetch_assoc($res);
if($fil<1){
    echo $fi['id'];
    echo "<br>El alumno no existe";
    header("Refresh:5; url=panelAdministrador.php",true,303);
    die();
}


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
        <img src="rentBook.png" alt="">
        <p id="seccion">Renta</p></div>
        <div class="principal">
        
            
                <?php                
                if (mysqli_num_rows($resultado)>0) 
                {
                        while($row = mysqli_fetch_assoc($resultado)) 
                        {
                            if($row["cantidad"]==0){
                                echo "<div class=results>";
                                echo "<b>Libro sin existencia por el momento</b><br>";
                                echo "</div>";
                            }else{
                                echo "<div class=results>";
                                if($fi['prestamos']<3){
                                    $fi['prestamos']=$fi['prestamos']+1;
                                    $pres=$fi['prestamos'];
                                    $usr=$fi['usuario'];
                                    $prestar="UPDATE usuarios SET prestamos='$pres' WHERE id='$iduser'";
                                    mysqli_query($conexion,$prestar);
                                    $hora=time();
                                    switch($fi['prestamos']){
                                        case 1:
                                            $p1=$row['id'];
                                            $prestar="UPDATE usuarios SET p1='$p1' WHERE id='$iduser'";
                                            $tiempo="UPDATE usuarios SET t1='$hora' WHERE id='$iduser'";
                                            mysqli_query($conexion,$prestar);
                                            mysqli_query($conexion,$tiempo);
                                            break;
                                        case 2:
                                            $p2=$row['id'];
                                            $prestar="UPDATE usuarios SET p2='$p2' WHERE id='$iduser'";
                                            $tiempo="UPDATE usuarios SET t2='$hora' WHERE id='$iduser'";
                                            mysqli_query($conexion,$prestar);
                                            mysqli_query($conexion,$tiempo);
                                            break;
                                        case 3:
                                            $p3=$row['id'];
                                            $prestar="UPDATE usuarios SET p3='$p3' WHERE id='$iduser'";
                                            $tiempo="UPDATE usuarios SET t3='$hora' WHERE id='$iduser'";
                                            mysqli_query($conexion,$prestar);
                                            mysqli_query($conexion,$tiempo);
                                            break;
                                    }                                                                        
                                    echo "<br>";
                                    echo "<b>ID</b>: " , $row["id"], "<br>";
                                    echo "<b>Nombre</b>: " , $row["nombre"], "<br>";
                                    echo "<b>Autor</b>: " , $row["autor"], "<br>";
                                    echo "<b>Editorial</b>: " , $row["editorial"], "<br>";
                                    echo "<b>Año</b>: " , $row["ano"], "<br>";
                                    echo "<b>Ubicacion</b>: " , $row["ubicacion"], "<br>";
                                    echo "<b>Volumen</b>: " , $row["volumen"], "<br>";
                                    echo "<b>Edicion</b>: " , $row["edicion"], "<br>";
                                    echo "<b>Cantidad</b>: " , $row["cantidad"], "<br>";
                                    $cant=$row["cantidad"]-1;
                                    echo " ";
                                    echo "<b>RENTADO</b><br>"; 
                                    echo " ";
                                    echo "Prestamos:";
                                    echo "[",$fi['prestamos'],"/3]<br>";
                                    $rentar="UPDATE libros SET cantidad=".$cant." WHERE id=".$row["id"];
                                    mysqli_query($conexion,$rentar);
                                    echo " ";
                                    echo "<b>Nueva cantidad</b>: " , $cant, "<br>";
                                    echo "</div>"; 
                                    mysqli_free_result($resultado);
                                    mysqli_close($conexion);
                                }else{
                                    echo "Tienes el limite de libros prestados";
                                }
                            }
                        }
                } else {    
                            echo " ";
                            echo "No hubo coincidencias";
                }
                ?>
                                    
        </div>
        <div class="return">
            <p class="links">
            <a href="panelAdministrador.php" id="link">Volver a Renta</a><br>    
            <a href="bienvenido.php" id="link">Volver a Pagina principal</a><br>
            <a href="cerrar_session.php" id="link">Cerrar sesion</a><br>
            </p>
        </div>
        
    
    
    </body>
</html>