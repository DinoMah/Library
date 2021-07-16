<?php

    require 'fpdf/fpdf.php';
        
    class PDF extends FPDF
    {
        function Header(){
            $this->Image('Imagenes/th.jpg',5,5,15);
            $this->SetFont('Arial','B',15);
            $this->Cell(30);
            $this->Cell(120,10,'Reporte De Usuarios',0,0,'C');
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

    //include 'plantilla.php';
    
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

    $resultado=mysqli_query($conexion,"SELECT * FROM usuarios");

    $pdf = new PDF();

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(20,6,'ID',1,0,'C',1);
    $pdf->Cell(70,6,'Nombre',1,0,'C',1);
    $pdf->Cell(70,6,'Tipo',1,1,'C',1);

    while($row = mysqli_fetch_assoc($resultado)){
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20,6,$row["id"],1,0,'C');
        $pdf->Cell(70,6,$row["usuario"],1,0,'C');
        $pdf->Cell(70,6,$row["tipo"],1,1,'C');
    }

    $pdf->Output();
    /*require 'fpdf/fpdf.php';
    //$pdf = new fpdf('L','mm','legal');
    $pdf = new fpdf();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);

    $pdf->SetX(50);
    $pdf->SetY(50);
    $y = $pdf->GetY();
    
    $pdf->Cell(100,10,'Hola Mundo',1,1,'C');
    $pdf->Cell(100,10,'Hola Mundo2',1,0,'C');

    $pdf->MultiCell(100,5,1,'L',0);

    $pdf->Output();
    
    Para el problema de los acentos -> utf8_decode($row["?"])
    $pdf->Output('D') -> Descargarlo automaticamente
    $pdf->Output('F','nombre.pdf') -> Guardar en disco*/
?>