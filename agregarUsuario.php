<?php
$servidor="localhost";
$usuario="daniel";
$contrasena="12345";
$db="biblioteca";

$user=$_POST['usuario'];
$pass=$_POST['clave'];
$tipo=$_POST['tipo'];
//conexion a la base de datos
$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}
echo "Exito: Se realizo una conexion apropiada a la base datos. Ahora la base de datos esta lista para usarse".PHP_EOL;
echo "Informacion del Host:".mysqli_get_host_info($conexion).PHP_EOL;


$consulta="SELECT * FROM usuarios WHERE usuario='$user' AND contrasena='$pass'";
$resultado=mysqli_query($conexion,$consulta);
$filas=mysqli_num_rows($resultado);

if ($filas>0)
{
    header("location:cuentaExiste.html");
}
else
{

$consulta="INSERT INTO usuarios(id,usuario,contrasena,tipo)VALUES('$id','$user','$pass','$tipo')";
$resultado=mysqli_query($conexion,$consulta);
session_start();
$_SESSION['id']=$id;
$_SESSION['usuario']=$user;
$_SESSION['contrasena']=$pass;
$_SESSION['tipo']=$tipo;
header("location:bienvenido.php");
}


mysqli_close($conexion);

?>