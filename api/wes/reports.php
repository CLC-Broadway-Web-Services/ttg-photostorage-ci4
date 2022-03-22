<?
require('fdpi.php');
$pdf = new \setasign\Fpdi\Fpdi();;
if($filedata['is_reject']=='yes')
{
   $pageCount = $pdf->setSourceFile('/home/ttgphoto/public_html/wes/templates/TTG-Rejected'); 
   
}
else
{
 $pageCount = $pdf->setSourceFile('/home/ttgphoto/public_html/wes/templates/TTG-Accepted');
}
 $pageId = $pdf->importPage(1, setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);
$pdf->addPage();
$pdf->useImportedPage($pageId, 2, 3, 207);
/**
$code='eyIxIjp7IjEiOjMwLCIyIjo2NywiMyI6MTE0LCI0IjoxNTR9LCIyIjp7IjEiOjQ2LCIyIjo3OSwiMyI6OTgsIjQiOjEzMSwiNSI6MTQ5LjUsIjYiOjE4NC41LCI3IjoyNTEuNSwiOCI6MjEzLjV9fQ==';
$z=json_decode(base64_decode($code),true);

$z=getmat();
$x=$z[1];
$y=$z[2];
**/


$x[1]=30;
$x[2]=$x[1]+37;
$x[3]=$x[2]+47;
$x[4]=$x[3]+40;
$y[1]=43;
$y[2]=$y[1]+30;
$y[3]=$y[2]+30;
$y[4]=$y[3]+27;
$y[5]=$y[4]+15;
$y[6]=$y[5]+27;
$y[7]=$y[6]+75;
$y[8]=$y[7]-45;
$y[9]=$y[2]+15;
$y[10]=52;
$y[11]=$y[10]+17;
$y[12]=$y[11]+34;

/**
$z=array(1=>$x,2=>$y);
echo base64_encode(json_encode($z));
exit();
**/



if($filedata['is_reject']!='yes')
{
     $pdf->SetFont('Arial','',12);
 // CRN Number
$pdf->SetXY($x[1],$y[1]);
$pdf->Write(1, $filedata['crn']);
 // Date
$pdf->SetXY($x[3],$y[1]);
$pdf->Write(1, date("d-m-Y",$filedata['ship_time']));
 // Time
$pdf->SetXY($x[4],$y[1]);
$pdf->Write(1, date("g:i:s a",$filedata['ship_time']));

// Logistic Company Name
$pdf->SetXY($x[1],$y[2]);
$pdf->Write(1,  $filedata['logistic_company']);

// Way bill
$pdf->SetXY($x[1],$y[9]);
$pdf->Write(1,  $filedata['logistic_waybill']);

// Box seal 
$pdf->SetXY($x[4],$y[9]);
$pdf->Write(1,  $filedata['box_seal']);

// Packahing quality
$pdf->SetXY($x[4],$y[2]);
if($filedata['box_condition']=='Poor')
{
$pdf->SetTextColor(33,77,32);
}
if($filedata['box_condition']=='Good')
{
$pdf->SetTextColor(0,100,0);
}
if($filedata['box_condition']=='Fair')
{
$pdf->SetTextColor(234,154,7);
}
$pdf->Write(1,  $filedata['box_condition']);
$pdf->SetTextColor(0,0,0);
// Number of Staff
$pdf->SetXY($x[1],$y[3]);
$pdf->Write(1,  $filedata['no_of_staff']);
// No of boxes 
$pdf->SetXY($x[2],$y[3]);
$pdf->Write(1,  $filedata['no_of_box']);
// Number of Pallets  
$pdf->SetXY($x[3],$y[3]);
$pdf->Write(1,  $filedata['no_of_pallets']);
// Number of Devices  
$pdf->SetXY($x[4],$y[3]);
$pdf->Write(1,  $filedata['no_of_devices']);
// Number of Vahicles
$pdf->SetXY($x[1],$y[4]);
$pdf->Write(1,  $filedata['no_of_vahicle']);
// Vehicle type
$pdf->SetXY($x[3],$y[4]);
$pdf->Write(1,  $filedata['vahicle_type']);
// vahicle Number
$pdf->SetXY($x[1],$y[5]);
$pdf->Write(1,  $filedata['vahicle_number']);
// Name
$pdf->SetXY($x[1],$y[6]);
$pdf->Write(1,  $filedata['supervisor_name']);
// Phone Number 
$pdf->SetXY($x[3],$y[6]);
$pdf->Write(1,  $filedata['supervisor_ph_no']);
$pdf->SetFont('','',10);

if(file_exists($filedata['supervisor_sign']))
{
$pdf->Image( $filedata['supervisor_sign'],$y[1]+9,$y[8],25);
}

if(strtoupper($filedata['declr_tick'])=='YES')
{
$dclsimage='/home/ttgphoto/public_html/wes/declr_no.png';
}
else
{
    $dclsimage='/home/ttgphoto/public_html/wes/declr_yes.png';
}
$pdf->Image( $dclsimage,$x[1]+1,$y[6]+11,5);
// Comment
$pdf->SetXY($x[1]+2,$y[7]);
$pdf->MultiCell(150,5,$filedata['note']);
}
else
{
     $pdf->SetFont('Arial','',12);
 // CRN Number
$pdf->SetXY($x[1],$y[10]);
$pdf->Write(1, $filedata['crn']);
 // Date
$pdf->SetXY($x[3],$y[10]);
$pdf->Write(1, date("d-m-Y",$filedata['ship_time']));
 // Time
$pdf->SetXY($x[4],$y[10]);
$pdf->Write(1, date("g:i:s a",$filedata['ship_time']));

// Logistic Company Name
$pdf->SetXY($x[1],$y[11]);
$pdf->Write(1,  $filedata['logistic_company']);


    $pdf->SetXY($x[1]+5,$y[12]);
    $pdf->MultiCell(150,5,$filedata['note']);
}
if($_GET['inline']=='true')
{
   $pdf->Output('I',$filedata['crn'].'-'.$filedata['hash'].'.pdf'); 
}
else
{
    $pdf->Output('D',$filedata['crn'].'-'.$filedata['hash'].'.pdf');
}


function getmat()
{
    $code='eyIxIjp7IjEiOjMwLCIyIjo2NywiMyI6MTE0LCI0IjoxNTR9LCIyIjp7IjEiOjQ2LCIyIjo3OSwiMyI6OTgsIjQiOjEzMSwiNSI6MTQ5LjUsIjYiOjE4NC41LCI3IjoyNTEuNSwiOCI6MjEzLjV9fQ==';
return json_decode(base64_decode($code),true);

}