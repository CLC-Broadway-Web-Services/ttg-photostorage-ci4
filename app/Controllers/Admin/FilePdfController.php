<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ManageShipmentModel;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;

class FilePdfController extends BaseController
{

    protected $pdf;
    protected $manageShipmentData;
    public function __construct()
    {
        $this->pdf = new Fpdi();
        $this->manageShipmentData = new ManageShipmentModel();

    }
    public function file_pdf($filehash, $inline = false)
    {

        // query for getting filedata
        
        $filedata =$this->manageShipmentData->where('hash', $filehash)->first();

        if ($filedata) {
            if ($filedata['is_reject'] == 'yes') {
                $pageCount = $this->pdf->setSourceFile(WRITEPATH. 'Templates/TTG-Rejected');
            } else {
                $pageCount = $this->pdf->setSourceFile(WRITEPATH. 'Templates/TTG-Accepted');
            }
            $pageId = $this->pdf->importPage(1, PageBoundaries::MEDIA_BOX);
            $this->pdf->addPage();
            $this->pdf->useImportedPage($pageId, 2, 3, 207);
            // /**
            // $code='eyIxIjp7IjEiOjMwLCIyIjo2NywiMyI6MTE0LCI0IjoxNTR9LCIyIjp7IjEiOjQ2LCIyIjo3OSwiMyI6OTgsIjQiOjEzMSwiNSI6MTQ5LjUsIjYiOjE4NC41LCI3IjoyNTEuNSwiOCI6MjEzLjV9fQ==';
            // $z=json_decode(base64_decode($code),true);

            // $z=getmat();
            // $x=$z[1];
            // $y=$z[2];
            //  **/


            $x[1] = 30;
            $x[2] = $x[1] + 37;
            $x[3] = $x[2] + 47;
            $x[4] = $x[3] + 40;
            $y[1] = 43;
            $y[2] = $y[1] + 30;
            $y[3] = $y[2] + 30;
            $y[4] = $y[3] + 27;
            $y[5] = $y[4] + 15;
            $y[6] = $y[5] + 27;
            $y[7] = $y[6] + 75;
            $y[8] = $y[7] - 45;
            $y[9] = $y[2] + 15;
            $y[10] = 52;
            $y[11] = $y[10] + 17;
            $y[12] = $y[11] + 34;

            // /**
            // $z=array(1=>$x,2=>$y);
            // echo base64_encode(json_encode($z));
            // exit();
            //  **/



            if ($filedata['is_reject'] != 'yes') {
                $this->pdf->SetFont('Arial', '', 12);
                // CRN Number
                $this->pdf->SetXY($x[1], $y[1]);
                $this->pdf->Write(1, $filedata['crn']);
                // Date
                $this->pdf->SetXY($x[3], $y[1]);
                $this->pdf->Write(1, date("d-m-Y", $filedata['ship_time']));
                // Time
                $this->pdf->SetXY($x[4], $y[1]);
                $this->pdf->Write(1, date("g:i:s a", $filedata['ship_time']));

                // Logistic Company Name
                $this->pdf->SetXY($x[1], $y[2]);
                $this->pdf->Write(1,  $filedata['logistic_company']);

                // Way bill
                $this->pdf->SetXY($x[1], $y[9]);
                $this->pdf->Write(1,  $filedata['logistic_waybill']);

                // Box seal 
                $this->pdf->SetXY($x[4], $y[9]);
                $this->pdf->Write(1,  $filedata['box_seal']);

                // Packahing quality
                $this->pdf->SetXY($x[4], $y[2]);
                if ($filedata['box_condition'] == 'Poor') {
                    $this->pdf->SetTextColor(33, 77, 32);
                }
                if ($filedata['box_condition'] == 'Good') {
                    $this->pdf->SetTextColor(0, 100, 0);
                }
                if ($filedata['box_condition'] == 'Fair') {
                    $this->pdf->SetTextColor(234, 154, 7);
                }
                $this->pdf->Write(1,  $filedata['box_condition']);
                $this->pdf->SetTextColor(0, 0, 0);
                // Number of Staff
                $this->pdf->SetXY($x[1], $y[3]);
                $this->pdf->Write(1,  $filedata['no_of_staff']);
                // No of boxes 
                $this->pdf->SetXY($x[2], $y[3]);
                $this->pdf->Write(1,  $filedata['no_of_box']);
                // Number of Pallets  
                $this->pdf->SetXY($x[3], $y[3]);
                $this->pdf->Write(1,  $filedata['no_of_pallets']);
                // Number of Devices  
                $this->pdf->SetXY($x[4], $y[3]);
                $this->pdf->Write(1,  $filedata['no_of_devices']);
                // Number of Vahicles
                $this->pdf->SetXY($x[1], $y[4]);
                $this->pdf->Write(1,  $filedata['no_of_vahicle']);
                // Vehicle type
                $this->pdf->SetXY($x[3], $y[4]);
                $this->pdf->Write(1,  $filedata['vahicle_type']);
                // vahicle Number
                $this->pdf->SetXY($x[1], $y[5]);
                $this->pdf->Write(1,  $filedata['vahicle_number']);
                // Name
                $this->pdf->SetXY($x[1], $y[6]);
                $this->pdf->Write(1,  $filedata['supervisor_name']);
                // Phone Number 
                $this->pdf->SetXY($x[3], $y[6]);
                $this->pdf->Write(1,  $filedata['supervisor_ph_no']);
                $this->pdf->SetFont('', '', 10);

                if (file_exists($filedata['supervisor_sign'])) {
                    $this->pdf->Image($filedata['supervisor_sign'], $y[1] + 9, $y[8], 25);
                }

                if (strtoupper($filedata['declr_tick']) == 'YES') {
                    $dclsimage = WRITEPATH. 'Images/declr_no.png';
                } else {
                    $dclsimage = WRITEPATH. 'Images/declr_yes.png';
                }
                $this->pdf->Image($dclsimage, $x[1] + 1, $y[6] + 11, 5);
                // Comment
                $this->pdf->SetXY($x[1] + 2, $y[7]);
                $this->pdf->MultiCell(150, 5, $filedata['note']);
            } else {
                $this->pdf->SetFont('Arial', '', 12);
                // CRN Number
                $this->pdf->SetXY($x[1], $y[10]);
                $this->pdf->Write(1, $filedata['crn']);
                // Date
                $this->pdf->SetXY($x[3], $y[10]);
                $this->pdf->Write(1, date("d-m-Y", $filedata['ship_time']));
                // Time
                $this->pdf->SetXY($x[4], $y[10]);
                $this->pdf->Write(1, date("g:i:s a", $filedata['ship_time']));

                // Logistic Company Name
                $this->pdf->SetXY($x[1], $y[11]);
                $this->pdf->Write(1,  $filedata['logistic_company']);


                $this->pdf->SetXY($x[1] + 5, $y[12]);
                $this->pdf->MultiCell(150, 5, $filedata['note']);
            }
            if ($inline && $inline == 'true') {
                $this->pdf->Output('I', $filedata['crn'] . '-' . $filedata['hash'] . '.pdf');
            } else {
                $this->pdf->Output('D', $filedata['crn'] . '-' . $filedata['hash'] . '.pdf');
            }
        } else {
            die("File Not Found !");
        }
    }
}
