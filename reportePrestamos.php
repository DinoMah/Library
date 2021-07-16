<?php

    require 'fpdf/fpdf.php';
        
    class PDF extends FPDF
    {
        function Header(){
            $this->Image('Imagenes/th.jpg',5,5,15);
            $this->SetFont('Arial','B',15);
            $this->Cell(30);
            $this->Cell(120,10,'Reporte De Prestamos',0,0,'C');
            $this->Ln(20);
        }
        
        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

?>
<?php
    $servidor="localhost";
    $usuario="daniel";
    $contrasena="12345";
    $db="biblioteca";

    $conexion=mysqli_connect($servidor,$usuario,$contrasena,$db);
    if(!$conexion){
        echo "Error: No se pudo conectar a la base de datos de MySQL".PHP_EOL;
        echo "errno de depuracion". mysqli_connect_errno().PHP_EOL;
        echo "error de depuracion".mysqli_connect_error().PHP_EOL;
        exit;
    }

    //include 'plantilla.php';

    $pdf = new PDF();

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,6,'ID. Libro',1,0,'C',1);
    $pdf->Cell(70,6,'Nombre Libro',1,0,'C',1);
    $pdf->Cell(70,6,'Usuario',1,1,'C',1);

    $resultado=mysqli_query($conexion,"SELECT * FROM usuarios U INNER JOIN libros L ON U.p1=L.id OR U.p2=L.id OR U.p3=L.id");
    while($row = mysqli_fetch_assoc($resultado)){
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20,6,$row["id"],1,0,'C');
        $pdf->Cell(70,6,$row["nombre"],1,0,'C');
        $pdf->Cell(70,6,$row["usuario"],1,1,'C');
    }

    $pdf->Output();
?>