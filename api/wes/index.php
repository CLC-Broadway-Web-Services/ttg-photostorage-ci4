<?php
require('mc_table.php');


$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,0,'Hello World!');
$pdf->SetFont('Arial','',14);
//Table with 20 rows and 4 columns
$pdf->SetWidths(array(30,50,30,40));
for($i=0;$i<20;$i++)
    $pdf->Row(array($i,$i,$i,$i));
$pdf->Output();
?>