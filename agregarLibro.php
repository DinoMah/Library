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

$nombre=$_POST['nombre'];
$editorial=$_POST['editorial'];
$autor=$_POST['autor'];
$ano=$_POST['ano'];
$ubicacion=$_POST['ubicacion'];
$volumen=$_POST['volumen'];
$edicion=$_POST['edicion'];

$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}

$consulta="SELECT * FROM libros WHERE nombre='$nombre' AND editorial='$editorial' AND autor='$autor' AND ano='$ano' AND ubicacion='$ubicacion' AND volumen='$volumen' AND edicion='$edicion'";
$resultado=mysqli_query($conexion,$consulta);
if (mysqli_num_rows($resultado)>0)
{
    $row = mysqli_fetch_assoc($resultado);
    $r1 = $row["cantidad"]+1;
    $id = $row["id"];
    $sentActualizar="UPDATE libros Set cantidad='$r1' where id='$id'";
    mysqli_query($conexion,$sentActualizar);
    echo "Libro actualizado con exito";
}else{
    $consulta="INSERT INTO libros (`id`, `nombre`, `editorial`, `autor`, `ubicacion`, `cantidad`, `volumen`, `edicion`, `ano`) VALUES (NULL, '$nombre', '$editorial', '$autor', '$ubicacion', '1', '$volumen', '$edicion', '$ano')";
    mysqli_query($conexion,$consulta);
    echo "Libro subido con exito";
}
header("Refresh:5; url=panelCapturista.php",true,303);
?>