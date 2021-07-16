<?php
session_start();
error_reporting(0);
$var_session=$_SESSION['usuario'];
if($var_session=='' || $var_session==null){
    echo "No has iniciado sesion...";
    die();
}
$servidor="localhost";
$usuario="javier";
$contrasena="Dcero24";
$db="biblioteca";

$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}

$libro=$_POST['eid'];
$iduser=$_POST['eiduser'];

$consulta="SELECT * FROM libros WHERE id='$libro'";
$resultado=mysqli_query($conexion,$consulta);
if (mysqli_num_rows($resultado)>0)
{
    $con="SELECT * FROM usuarios WHERE id='$iduser'";    
    $res=mysqli_query($conexion,$con);    
    if(mysqli_num_rows($res)>0){
        $ro=mysqli_fetch_assoc($res);
        $p1=$ro["p1"];
        $p2=$ro["p2"];
        $p3=$ro["p3"];
        if($libro==$p1 || $libro==$p2 || $libro==$p3){
            $usr=$ro["usuario"];
            if(mysqli_num_rows($resultado)>0){
                $row = mysqli_fetch_assoc($resultado);

                $hora=time();

                switch($libro){
                    case $p3:
                        $tiempo="UPDATE usuarios Set t3='$hora' where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                    break;
                    case $p2:
                        $tiempo="UPDATE usuarios Set t2='$hora' where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                    break;
                    case $p1:
                        $tiempo="UPDATE usuarios Set t1='$hora' where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                    break;
                }

                echo "<br>Libro renovado con exito";
            }
        }else{
            echo "<br>El usuario no tiene ese libro prestado<br>";
        }
    }
}else{
    echo "<br>Libro no existe en base de datos";
}
?>