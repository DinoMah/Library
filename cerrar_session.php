<?php
session_start();
error_reporting(0);
$var_session=$_SESSION['usuario'];
if($var_session==null || $var_session==''){
    echo "Usted no puede entrar a esta pagina, necesita iniciar sesion";
    die();
}
session_destroy();
header("location:Inicio.html");
?>