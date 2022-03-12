<?php

use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageShipmentModel;
use App\Models\Admin\ManageUserModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;

// counting for graphs
if (!function_exists('total_shipments')) {
    function total_shipments($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // shipments data
        $shipMd = new ManageShipmentModel();
        if ($country) {
            $shipment_data['total'] = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->countAllResults();
            $shipmentsLastMonth = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->where(['ttg_ship.time >=' => $last_month_first_day, 'ttg_ship.time <=' => $last_month_day])->countAllResults();
            $shipmentsCurrentMonth = $shipMd->distinct()
                ->select('ttg_ship.id, ttg_login.country')
                ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                ->where('ttg_login.country', $country)->where(['ttg_ship.time >' => $last_month_day])->countAllResults();
        } else {
            $shipment_data['total'] = $shipMd->countAllResults();
            $shipmentsLastMonth = $shipMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $shipmentsCurrentMonth = $shipMd->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($shipmentsCurrentMonth == 0) {
            $shipment_data['percentage'] = 0;
        } else {
            if ($shipmentsLastMonth == 0) {
                $shipment_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $shipmentsCurrentMonth / ($shipmentsLastMonth / 100);
                $shipment_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $shipment_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $shipment_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $shipment_data;
    }
}
if (!function_exists('total_crns')) {
    function total_crns($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // CRNS DATA
        $postMd = new PostsModel();
        if ($country) {
            $crn_data['total'] = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->countAllResults();
            $crnLastMonth = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $last_month_first_day, 'ttg_post.time <=' => $last_month_day])->countAllResults();
            $crnCurrentMonth = $postMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->groupBy('ttg_post.crn')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >' => $last_month_day])->countAllResults();
        } else {
            $crn_data['total'] = $postMd->groupBy('crn')->countAllResults();
            $crnLastMonth = $postMd->groupBy('crn')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $crnCurrentMonth = $postMd->groupBy('crn')->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($crnCurrentMonth == 0) {
            $crn_data['percentage'] = 0;
        } else {
            if ($crnLastMonth == 0) {
                $crn_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $crnCurrentMonth / ($crnLastMonth / 100);
                $crn_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $crn_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $crn_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $crn_data;
    }
}
if (!function_exists('total_assets')) {
    function total_assets($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // ASSETS DATA
        $filesMd = new PostsModel();
        if ($country) {
            $assets_data['total'] = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                // ->groupBy('ttg_post.uid')
                ->where('ttg_login.country', $country)->countAllResults();
            $assetLastMonth = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                // ->groupBy('ttg_post.uid')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $last_month_first_day, 'ttg_post.time <=' => $last_month_day])->countAllResults();
            $assetCurrentMonth = $filesMd->distinct()
                ->select('ttg_post.*, ttg_login.id as user')
                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                ->where('ttg_login.country', $country)->where(['ttg_post.time >' => $last_month_day])->countAllResults();
        } else {
            $assets_data['total'] = $filesMd->groupBy('uid')->countAllResults();
            $assetLastMonth = $filesMd->groupBy('uid')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $assetCurrentMonth = $filesMd->groupBy('uid')->where(['time >' => $last_month_day])->countAllResults();
        }


        if ($assetCurrentMonth == 0) {
            $assets_data['percentage'] = 0;
        } else {
            if ($assetLastMonth == 0) {
                $assets_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $assetCurrentMonth / ($assetLastMonth / 100);
                $assets_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $assets_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $assets_data['percentage'] = $lastMonthPercent;
                }
            }
        }

        return $assets_data;
    }
}
if (!function_exists('total_clients')) {
    function total_clients($country = null)
    {
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // CLIENTS DATA
        $clientsMd = new AdminModel();
        if ($country) {
            $clients_data['total'] = $clientsMd->where('country', $country)->where('type', 'client')->countAllResults();
            $clientsLastMonth = $clientsMd->where('country', $country)->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $clientsCurrentMonth = $clientsMd->where('country', $country)->where(['time >' => $last_month_day])->countAllResults();
        } else {
            $clients_data['total'] = $clientsMd->where('type', 'client')->countAllResults();
            $clientsLastMonth = $clientsMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
            $clientsCurrentMonth = $clientsMd->where(['time >' => $last_month_day])->countAllResults();
        }

        if ($clientsCurrentMonth == 0) {
            $clients_data['percentage'] = 0;
        } else {
            if ($clientsLastMonth == 0) {
                $clients_data['percentage'] = 100;
            } else {
                $lastMonthPercent = $clientsCurrentMonth / ($clientsLastMonth / 100);
                $clients_data['percentage'] = $lastMonthPercent;
                if ($lastMonthPercent > 100) {
                    $clients_data['percentage'] = $lastMonthPercent - 100;
                } else {
                    $clients_data['percentage'] = $lastMonthPercent;
                }
            }
        }


        return $clients_data;
    }
}
if (!function_exists('packagin_quality_chart')) {
    function packagin_quality_chart($country = null)
    {
        $shipMd = new ManageShipmentModel();
        $boxConditions = $shipMd->select('box_condition')->groupBy('box_condition')->findAll();
        $conditionsData = [];
        foreach ($boxConditions as $key => $data) {
            $box_condition = $data['box_condition'];
            if ($box_condition) {
                if ($country) {
                    $conditionsData[$box_condition]['count'] = $shipMd->distinct()
                        ->select('ttg_ship.id, ttg_login.country')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->where('ttg_login.country', $country)->where('ttg_ship.box_condition', $box_condition)->countAllResults();
                } else {
                    $conditionsData[$box_condition]['count'] = $shipMd->where('box_condition', $box_condition)->countAllResults();
                }
            }
            if ($box_condition == 'Fair') {
                $conditionsData[$box_condition]['color'] = '#FFB833';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Good') {
                $conditionsData[$box_condition]['color'] = '#008000';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Poor') {
                $conditionsData[$box_condition]['color'] = '#E06061';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Rejected') {
                $conditionsData[$box_condition]['color'] = '#FF2424';
                $conditionsData[$box_condition]['name'] = $box_condition;
            } elseif ($box_condition == 'Unknown') {
                $conditionsData[$box_condition]['color'] = '#13c9f2';
                $conditionsData[$box_condition]['name'] = $box_condition;
            }
        }

        return $conditionsData;
    }
}
if (!function_exists('crn_statistics')) {
    function crn_statistics($country = null)
    {
        $postMd = new PostsModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $postMd->distinct()
                    ->select('ttg_post.*, ttg_login.id as user')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->groupBy('ttg_post.crn')
                    ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $currentDayStart, 'ttg_post.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $postMd->groupBy('crn')->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
if (!function_exists('asset_statistics')) {
    function asset_statistics($country = null)
    {
        $filesMd = new PostsModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $filesMd->distinct()
                    ->select('ttg_post.*, ttg_login.id as user')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->groupBy('ttg_post.uid')
                    ->where('ttg_login.country', $country)->where(['ttg_post.time >=' => $currentDayStart, 'ttg_post.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $filesMd->groupBy('uid')->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
if (!function_exists('shipment_statistics')) {
    function shipment_statistics($country = null)
    {
        $shipMd = new ManageShipmentModel();
        $total15DaysArray = [];
        for ($i = 1; $i <= 15; $i++) {
            array_push($total15DaysArray, $i);
        }
        $dates = [];
        $counts = [];
        foreach ($total15DaysArray as $key => $day) {
            $currentDayStart = strtotime(date('Y-m-d', strtotime('-' . ($day + 1) . ' days', time())));
            $currentDayEnd = strtotime(date('Y-m-d', strtotime('-' . $day . ' days', time())));
            array_push($dates, date('d M Y', $currentDayStart));
            if ($country) {
                $currentCounts = $shipMd->distinct()
                    ->select('ttg_ship.id, ttg_login.country')
                    ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                    ->where('ttg_login.country', $country)->where(['ttg_ship.time >=' => $currentDayStart, 'ttg_ship.time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            } else {
                $currentCounts = $shipMd->where(['time >=' => $currentDayStart, 'time <=' => $currentDayEnd])->countAllResults();
                array_push($counts, $currentCounts);
            }
        }

        $returnData = [
            'dates' => array_reverse($dates),
            'counts' => array_reverse($counts)
        ];
        return $returnData;
    }
}
// if (!function_exists('packagin_quality_chart')) {
//     function packagin_quality_chart($country = null)
//     {
//     }
// }
// if (!function_exists('packagin_quality_chart')) {
//     function packagin_quality_chart($country = null)
//     {
//     }
// }

// other functions
if (!function_exists('logout')) {
    function logout()
    {
        return redirect()->route('logout');
    }
}
if (!function_exists('test_input')) {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('', '', $data);
        return $data;
    }
}

if (!function_exists('add_colon')) {
    function add_colon($data)
    {
        $data = str_replace("'", '', $data);
        $data = str_replace("pdfdownload", '', $data);
        $data = "'" . $data . "'";
        return $data;
    }
}

if (!function_exists('attachment_size')) {
    function attachment_size($data)
    {
        $size = 0;
        foreach ($data as $fr) {

            $ed =  unified(json_decode($fr['files'], true));
            foreach ($ed as $rf) {
                $size = filesize($rf['file']) + $size;
            }
        }
        return $size;
    }
}

if (!function_exists('unified')) {
    function unified($data)
    {
        foreach ($data as $firstdata) {
            foreach ($firstdata as $key => $seconddata) {
                $key = substr($key, 0, 4);
                $newseconddata[$key] = $seconddata;
            }
            $newfirstdata[] = $newseconddata;
        }

        return $newfirstdata;
    }
}
if (!function_exists('remove_empty')) {
    function remove_empty($data)
    {
        if ($data != "") {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('checkUserTypes')) {
    function checkUserTypes($type)
    {
        if (in_array(session()->get('user.type'), $type)) {
            return true;
        }
        logout();
    }
}
if (!function_exists('passwordHash')) {
    function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
if (!function_exists('create_dates')) {
    function create_dates()
    {
        // $db = new ObjectionsModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['datetimes'];
        //     // $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done objection <br>';
        // $db = new AdminModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done admin model <br>';
        // $db = new FilesModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done <br>';
        // $db = new CrnModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done crn <br>';
        // $db = new ActivityLogModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done activity <br>';
        // $db = new EmployeModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['joiningDate'] . ' 00:00:00';
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done employe <br>';
        $db = new ManageUserModel();
        $postdata = $db->findAll();

        foreach ($postdata as $key => $shipment) {
            $createdAt = date('Y-m-d H:s:i', $shipment['created_date']);
            $data = [
                'adduserID' => $shipment['adduserID'],
                'created_at' => $createdAt
            ];
            $db->save($data);
        }

        echo 'done user <br>';
        return;
    }
}

// private function

if (!function_exists('generatePdf')) {
    function generatePdf($data, $type = 'single')
    {
        $pdfTitle = '';
        if ($type == 'multiple') {
            foreach ($data as $key => $value) {
                $pdfTitle = $value['uid'] . ', ';
            }
        } else {
            $pdfTitle = $data['uid'];
        }
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $pdfTitle . '</title>
            </head>
            <body style="margin:auto;">';

        if ($type == 'multiple') {
            foreach ($data as $key => $value) {
                $images = json_decode($value['files']);
                $html .= '<div style="margin-top:20px;page-break-after: always;">
                                <div style="background: #18416c;padding: 7px 0px 8px 7px;text-align: center;color: white;font-size:large;font-weight:700;">
                                    PHOTOS FOR : ' . $value['uid'] . '
                                </div>';
                foreach ($images as $key => $image) {
                    $file = 'file' . ($key + 1);
                    $desc = 'desc' . ($key + 1);
                    if (file_exists($image->$file)) {
                        $thisImage = base64_encode_html_image($image->$file, '1x1');
                        $html .= '<div style="border: 1px solid blue;margin-top: 20px;height: auto;">
                                    <div style="margin-top: 20px;text-align: left;border: 1px solid blue;margin-right: 150px;margin-left: 150px;height: auto;">
                                    <div style="text-align: center;height: 300px;">
                                        ' . $thisImage . '
                                    </div>
                                    <div style="min-height: 40px;">
                                    ' . $image->$desc . '
                                    </div>
                                </div></div>';
                    }
                }

                $html .= '</div>';
            }
        } else {
            $images = json_decode($data['files']);
            $html .= '<div style="page-break-after: always;">
                            <div style="background: #18416c;padding: 7px 0px 8px 7px;text-align: center;color: white;font-size:large;font-weight:700;">
                                PHOTOS FOR : ' . $data['uid'] . '
                            </div>';
            foreach ($images as $key => $image) {
                $file = 'file' . ($key + 1);
                $desc = 'desc' . ($key + 1);
                if (file_exists($image->$file)) {
                    $thisImage = base64_encode_html_image($image->$file, '1x1');
                    $html .= '<div style="border: 1px solid blue;margin-top: 20px;height: auto;">
                                <div style="margin-top: 20px;text-align: left;border: 1px solid blue;margin-right: 150px;margin-left: 150px;height: auto;">
                                <div style="text-align: center;height: 300px;">
                                    ' . $thisImage . '
                                </div>
                                <div style="min-height: 40px;">
                                ' . $image->$desc . '
                                </div>
                            </div></div>';
                }
            }

            $html .= '</div>';
        }

        $html .= '</body></html>';

        // instantiate and use the dompdf class
        $encodedHtml = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        // $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);

        $dompdf->setOptions($options);

        $dompdf->loadHtml($html, 'UTF-8');

        $date = date('d-M-Y', time());
        $file_name = 'TTG_PHOTOSTORAGE_' . $date . '.pdf';

        $dompdf->loadHtml($encodedHtml);
        $dompdf->render();
        ob_end_clean();
        return $dompdf->stream($file_name, array("Attachment" => false));
        
        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        // $dompdf->render();


        // $html = mb_convert_encoding($output1, 'HTML-ENTITIES', 'UTF-8');
        // $pdf = new Pdf();
        // $options = $pdf->getOptions();

        // $pdf->setOptions($options);

        // $file_name = 'Halal-Certificate-' . $row["order_no"] . '.pdf';
        // $pdf->loadHtml($html);
        // $pdf->render();
        // ob_end_clean();
        // $pdf->stream($file_name, array("Attachment" => false));
        // // die();




        // Output the generated PDF to Browser
        // return $dompdf->stream('TTG_PHOTOSTORAGE_' . $date . '.pdf', array("Attachment" => false));
    }
}

if (!function_exists('base64_encode_html_image')) {
    function base64_encode_html_image($img_file, $alt = null, $cache = false, $ext = null)
    {
        if (!is_file($img_file)) {
            return false;
        }

        $b64_file = "{$img_file}.b64";
        if ($cache && is_file($b64_file)) {
            $b64 = file_get_contents($b64_file);
        } else {
            $bin = file_get_contents($img_file);
            $b64 = base64_encode($bin);

            if ($cache) {
                file_put_contents($b64_file, $b64);
            }
        }

        if (!$ext) {
            $ext = pathinfo($img_file, PATHINFO_EXTENSION);
        }

        return "<img alt='{$alt}' src='data:image/{$ext};base64,{$b64}' style='height:100%;'/>";
    }
}

// if (!function_exists('verifyPassword')) {
//     function verifyPassword()
//     {
//     }
// }
