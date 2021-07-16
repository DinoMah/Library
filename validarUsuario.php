<?php
$servidor="localhost";
$usuario="daniel";
$contrasena="12345";
$db="biblioteca";
    
$user=$_POST['usuario'];
$pass=$_POST['clave'];
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

$ti=mysqli_fetch_array($resultado);

session_start();
$_SESSION['usuario']=$user;
$_SESSION['contrasena']=$pass;
$_SESSION['tipo']=$ti['tipo'];
$_SESSION['prestamos']=$ti['prestamos'];
$_SESSION['p1']=$ti['p1'];
$_SESSION['p2']=$ti['p2'];
$_SESSION['p3']=$ti['p3'];

if ($filas>0)
{
    header("location:bienvenido.php");
}
else
{
    header("location:cuentaNoExiste.html");
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>