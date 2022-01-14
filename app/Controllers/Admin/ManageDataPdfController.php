<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ManageShipmentModel;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader\PageBoundaries;
use App\Models\Admin\PostsModel;

class ManageDataPdfController extends BaseController
{
    protected $pdf;
    protected $manageDataDb;
    public function __construct()
    {
        $this->pdf = new Fpdi();
        $this->manageDataDb = new PostsModel();
    }
    public function manage_data_pdf($file, $inline = false)
    {

        // query for getting filedata

        $filedata = $this->manageDataDb->where('uid', $file)->first();

        if ($filedata) {
            if (!$filedata) {
                $pageCount = $this->pdf->setSourceFile(WRITEPATH . 'Templates/TTG-Rejected');
            } else {
                $pageCount = $this->pdf->setSourceFile(WRITEPATH . 'Templates/TTG-Accepted');
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



            if ($filedata) {
                $this->pdf->SetFont('Arial', '', 12);

                // Logistic Company Name
                $this->pdf->SetXY($x[1], $y[2]);
                $this->pdf->Write(1,  $filedata['files']);
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
                $this->pdf->Output('I', $filedata['crn'] . '-' . $filedata['uid'] . '.pdf');
            } else {
                $this->pdf->Output('D', $filedata['crn'] . '-' . $filedata['uid'] . '.pdf');
            }
        } else {
            die("File Not Found !");
        }
    }

    public function manage_data_excel($file)
    {
        $filedata = $this->manageDataDb->where('uid', $file)->first();
        // echo '<pre>';
        // return print_r($filedata);
        // echo '</pre>';
        $filename = "manage_excel";
        $file_ending = "xls";
        //header info for browser
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        /*******Start of Formatting for Excel*******/
        //define separator (defines columns in excel & tabs in word)
        $sep = "\t"; //tabbed character
        //start of printing column names as names of MySQL fields
        for ($i = 0; $i < count($filedata); $i++) {
            // echo list_fields('ttg_posts') . "\t";
        }
        print("\n");
        //end of printing column names  
        //start while loop to get data
        $schema_insert = "";
        foreach ($filedata as $x => $x_value) {
            echo '"' . $x . '",' . '"' . $x_value . '"' . "\r\n";
        }
    }

    public function downloadAllData($type = 'shipment')
    {
        if ($type == 'shipment') {
            $db = new ManageShipmentModel();
        } else {
            $db = new PostsModel();
        }

        return print_r($db->findAll());
    }
}
