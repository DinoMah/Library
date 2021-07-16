


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

$id=$_POST['eid'];
$iduser=$_POST['eiduser'];

$conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
if(!$conexion){
    echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
    echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
    echo "error de depuracion".mysqli_connect_error().PHP_EOL;
    exit;
}
?>
<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8">
        <title>Entrega de libro</title>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Berkshire+Swash');
        @import url('https://fonts.googleapis.com/css?family=Varela+Round');
        @import url('https://fonts.googleapis.com/css?family=Poppins');
        @import url('https://fonts.googleapis.com/css?family=Questrial');
        </style>
        <link rel="stylesheet" href="estilos.css" type="text/css">
   </head>
    <body>
    <div>
    <p id="titulo">Biblioteca Virtual</p><br>  
        <img src="books1.png" alt="">
<?php
$consulta="SELECT * FROM libros WHERE id='$id'";
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
        if($id==$p1 || $id==$p2 || $id==$p3){
            $p=$ro["prestamos"]-1;
            $usr=$ro["usuario"];
            if(mysqli_num_rows($resultado)>0){
                $row = mysqli_fetch_assoc($resultado);
                $r1 = $row["cantidad"]+1;
                $lid = $row["id"];
                echo "<br>Usuario=",$usr;
                echo "<br>Libro Id=",$lid;
                echo "<br>Prestamo1=",$p1;
                echo "<br>Prestamo2=",$p2;
                echo "<br>Prestamo3=",$p3;
                echo "<br>Prestamos [nuevo]=",$p;
                echo "<br>cantidad nueva=",$r1;

                $hora=time();

                switch($lid){
                    case $p3:
                        $p3=0;
                        $sent="UPDATE usuarios Set p3='$p3' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sent="UPDATE usuarios Set prestamos='$p' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sentActualizar="UPDATE libros Set cantidad='$r1' where id='$lid'";

                        $tiempo_extra = $hora-$ro["t3"];
                        if($tiempo_extra>(60*60*24*2)){
                                $multa = ($tiempo_extra/86400) * 15;
                                echo "<br>Libro entregado fuera de tiempo<br>Multa: $".$multa;
                        }
                        $tiempo="UPDATE usuarios Set t1=0 where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                        mysqli_query($conexion,$sentActualizar);
                    break;
                    case $p2:
                        $p2=0;
                        $sent="UPDATE usuarios Set p2='$p2' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sent="UPDATE usuarios Set prestamos='$p' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sentActualizar="UPDATE libros Set cantidad='$r1' where id='$lid'";

                        $tiempo_extra = $hora-$ro["t2"];
                        if($tiempo_extra>60/*(60*60*24*2)*/){
                                $multa = ($tiempo_extra/60) * 15;
                                echo "<br>Libro entregado fuera de tiempo<br>Multa: $".$multa;
                        }
                        $tiempo="UPDATE usuarios Set t2=0 where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                        mysqli_query($conexion,$sentActualizar);
                    break;
                    case $p1:;
                        $p1=0;
                        $sent="UPDATE usuarios Set p1='$p1' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sent="UPDATE usuarios Set prestamos='$p' where usuario='$usr'";
                        mysqli_query($conexion,$sent);
                        $sentActualizar="UPDATE libros Set cantidad='$r1' where id='$lid'";

                        $tiempo_extra = $hora-$ro["t1"];
                        if($tiempo_extra>60/*(60*60*24*2)*/){
                            $multa = ($tiempo_extra/60) * 15;
                            echo "<br>Libro entregado fuera de tiempo<br>Multa: $".$multa;
                        }
                        $tiempo="UPDATE usuarios Set t1=0 where usuario='$usr'";
                        mysqli_query($conexion,$tiempo);
                        mysqli_query($conexion,$sentActualizar);
                    break;
                }

                echo "<br>Libro retornado con exito";
            }
        }else{
            echo "<br>El usuario no tiene ese libro prestado<br>";
        }
    }
}else{
    echo "<br>Libro no existe en base de datos";
}
?>
        </div>
    </body>
</html>