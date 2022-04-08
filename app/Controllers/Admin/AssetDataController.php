<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\CrnModel;
use App\Models\Admin\ObjectionsModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;

class AssetDataController extends BaseController
{
    protected $manageDataDb;
    protected $crnData;

    public function __construct()
    {
        $this->manageDataDb = new PostsModel();
        $this->crnData = new CrnModel();
    }

    public function manage_data()
    {
        if ($this->request->getVar('verifyData')) {
            return $this->verifyData($this->request->getVar('verifyData'));
        }
        $search_value = isset($_GET['search']) && $_GET['searchType'] != 'country' ? explode(',', $_GET['search']) : [];
        foreach ($search_value as $key => $value) {
            $search_value[$key] = trim($value);
        }
        $search_type = isset($_GET['searchType']) && $_GET['searchType'] != 'country' ? $_GET['searchType'] : 'crn';
        // $search_value = isset($_GET['search']) ? explode(',', $_GET['search']) : [];
        // $search_type = isset($_GET['searchType']) ? $_GET['searchType'] : 'crn';
        $countrySearch = isset($_GET['search']) && $_GET['searchType'] == 'country' ? explode(',', $_GET['search']) : [];
        foreach ($countrySearch as $key => $value) {
            $countrySearch[$key] = trim($value);
        }
        // if ($this->request->getMethod() == 'post') {
        if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'del') {
            $getId = $this->request->getVar('id');
            return $this->manageDataDb->where('uid', $getId)->delete();
        }
        if ($this->request->getVar('replace_data')) {
            $dataType = $this->request->getVar('replace_data');
            $replaceText = $this->request->getVar('replaceText');
            $dataIds = explode(',', $this->request->getVar('replaceDataIds'));
            $numberOfData = count($dataIds);
            $completedData = 0;
            foreach ($dataIds as $key => $id) {
                $data = [
                    'id' => $id,
                    $dataType => $replaceText
                ];
                $updateData = $this->manageDataDb->save($data);
                if ($updateData) {
                    $completedData = intval($completedData + 1);
                }
            }
            $response = ['success' => false];
            if ($numberOfData == $completedData) {
                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['data'] = intval($numberOfData - $completedData);
            }
            return json_encode($response);
            // return $this->manageDataDb->where('uid', $getId)->delete();
        }
        if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'multiDelete') {
            $ids = $this->request->getVar('id');
            foreach ($ids as $key => $value) {
                // return $value;
                $this->manageDataDb->delete($value);
            }
            // return json_encode($this->request->getVar('id'));
            // $getId = $this->request->getVar('id');
            return true;
        }
        $manageData = array();
        $count = 0;

        if ($this->request->getVar('draw')) {
            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $startDate = $this->request->getGet('start_date') ? date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00' : null;
            $endDate = $this->request->getGet('end_date') ? date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '23:59:59' : null;

            if (session()->get('loginType') == 'superadmin') {
                if ($startDate && $endDate) {
                    if (count($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else if (count($countrySearch)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->whereIn("ttg_login.country", $countrySearch)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->whereIn("ttg_login.country", $countrySearch)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                } else {
                    if (count($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else  if (count($countrySearch)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->whereIn("ttg_login.country", $countrySearch)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->whereIn("ttg_login.country", $countrySearch)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                }
            } else {
                $country = session()->get('user.country');
                if ($startDate && $endDate) {
                    if (count($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                } else {
                    if (count($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->whereIn('ttg_post.' . $search_type, $search_value)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                }
            }

            foreach ($manageData as $key => $manage) {
                $id = $manage['uid'];
                $popupWindowUrl = base_url(route_to('manage_data_details', base64_encode($id)));
                // $id = $manage['uid'];
                // <li><button class="btn btn-link" onclick="onclickSinglePdf(' . "'" . $id . "'" . ')"><em class="icon ni ni-file-pdf"></em><span>PDF</span></button></li>
                // $actionsHtml = '<ul class="nk-tb-actions gx-1" dataLink="' . $popupWindowUrl . '">
                //                     <li>
                //                         <div class="drodown">
                //                             <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                //                             <div class="dropdown-menu dropdown-menu-right">
                //                                 <ul class="link-list-opt no-bdr">
                //                                 <li><a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="open_new_window"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                //                                 <li><a href="javascript:void(0);" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                //                                 <li><a href="' . route_to('download_data_pdf', 'generate_single_pdf', $id) . '" target="_blank"><em class="icon ni ni-file-pdf"></em><span>PDF</span></a></li>
                //                                 <li><a href="' . route_to('manage_data_excel', base64_encode($id)) . '"><em class="icon ni ni-file-docs"></em><span>Excel</span></a></li>
                //                                 <li><a href="javascript:void(0);" onclick="deleteData(' . "'" . $id . "'" . ')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                //                                 </ul>
                //                             </div>
                //                         </div>
                //                     </li>
                //                 </ul>';


                $manageData[$key]['time'] = '<span>' . date("d M Y, g:s A", $manage['time']) . '</span>';
                if ($manage['files'] && $manage['files'] !== 'null') {
                    $files = json_decode($manage['files']);
                    $filesCount = count($files);
                    $manageData[$key]['files'] = $filesCount;
                    $actionsHtml = '<a href="javascript:void(0);" dataLink="' . $popupWindowUrl . '" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>|<a href="javascript:void(0);" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')" class="btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';

                    $manageData[$key]['actions'] = $actionsHtml;
                } else {
                    $manageData[$key]['files'] = 0;
                    $actionsHtml = '<a href="javascript:void(0);" dataLink="' . $popupWindowUrl . '" onclick="showNoFilesError()" class="btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>|<a href="javascript:void(0);" onclick="showNoFilesError()" class="btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';

                    $manageData[$key]['actions'] = $actionsHtml;
                }

                if ($manage['verifyStatus'] == 0) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-warning">Pending</span>';
                }
                if ($manage['verifyStatus'] == 1) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-success">Verified</span>';
                }
                if ($manage['verifyStatus'] == 2) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">Objected</span>';
                }
                if ($manage['verifyStatus'] == 3) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-success">Re-Verified</span>';
                }
                if ($manage['verifyStatus'] == 4) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">Re-Objected</span>';
                }
            }

            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $manageData   // total data array
            );

            return json_encode($json_data);
        }
        // $this->data['managedata'] = $this->manageDataDb->orderBy('id', 'desc')->findAll(100);
        // return view('Dashboard/Admin/testpage', $this->data);
        return view('Dashboard/Admin/manage_data', $this->data);
    }

    public function generateDirectPdf($pdf = 'generate_single_pdf', $ids = null)
    {
        $type = 'single';
        if ($pdf == 'generate_multiple_pdf') {
            $id_s = json_decode($ids);
            $data = $this->manageDataDb->select('uid, files')->whereIn('id', $id_s)->findAll();
            // return generatePdf($data, 'multiple');
            $type = 'multiple';
        }
        if ($pdf == 'generate_single_pdf') {
            // $ids = $this->request->getVar('id');
            $data = $this->manageDataDb->select('uid, files')->where('uid', $ids)->first();
            // return generatePdf($data);
        }

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
                        $thisImage = $this->base64_encode_html_image($image->$file, '1x1');
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
                    $thisImage = $this->base64_encode_html_image($image->$file, '1x1');
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

        // echo $html;
        // return;

        // instantiate and use the dompdf class
        $encodedHtml = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        // $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);

        $dompdf->setOptions($options);

        $dompdf->loadHtml($html, 'UTF-8');

        $date = date('d-M-Y', time());
        $file_name = 'TTG_PHOTOSTORAGE_' . time() . '.pdf';

        $dompdf->loadHtml($encodedHtml);
        $dompdf->render();
        ob_end_clean();
        return $dompdf->stream($file_name);
    }

    public function manage_data_details($encodedID, $imageId = 0)
    {
        $uid = base64_decode($encodedID);
        if ($this->request->getVar('verifyData')) {
            return $this->verifyData($this->request->getVar('verifyData'));
        }

        $this->data['encodedID'] = $encodedID;

        $manage_data_details = $this->manageDataDb->where('uid', $uid)->first();
        $this->data['manage_data_details'] = $manage_data_details;

        // if ($imageId > 0) {
        //     $files = json_decode($manage_data_details['files']);
        // }
        if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'login_form') {

            $userEmail = $this->request->getVar('email');
            $userPassword = $this->request->getVar('password');

            $userDb = new AdminModel();
            $getUser = $userDb->where('email', $userEmail)->first();
            $response = ['success' => false, 'message' => ''];

            if (password_verify($userPassword, $getUser['pass']) && $getUser['status']) {
                // return print_r($getUser);
                unset($getUser['pass']);
                unset($getUser['token']);
                // return print_r($getUser);

                $sessionData['userLoggedIn'] = true;
                $sessionData['loginType'] = $getUser['type'];
                $sessionData['user'] = $getUser;
                session()->set($sessionData);

                return redirect()->route('manage_data_details', [$encodedID]);
            } else {
                // return print_r('not match or not activated');
                $response['message'] = 'Password or email not matched. Or User not activated yet.';
            }
        }

        if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'comment_update') {
            // return json_encode($this->request->getVar());
            $key = intval($this->request->getVar('datakey'));
            $commentKey = 'desc' . $key;
            $comment = $this->request->getVar('comment');
            $thisFiles = json_decode($manage_data_details['files']);
            $thisFiles[$key - 1]->$commentKey = $comment;
            // return json_encode($thisFiles);
            $manage_data_details['files'] = json_encode($thisFiles);
            // return json_encode($manage_data_details);
            if ($this->manageDataDb->save($manage_data_details)) {
                return json_encode(true);
            } else {
                return json_encode(false);
            }
        }
        if ($this->request->getVar('objection') && $this->request->getVar('objection_filekey') != 'none' && $this->request->getVar('objection_index') != 'none') {
            // return json_encode($this->request->getVar());
            $objection_index = intval($this->request->getVar('objection_index'));
            $objection_filekey = $this->request->getVar('objection_filekey');
            $objection = $this->request->getVar('objection');
            $thisFiles = json_decode($manage_data_details['files']);
            $objection_desckey = 'desc' . ($objection_index + 1);
            // $thisFiles[$key - 1]->$commentKey = $comment;
            // return json_encode($thisFiles);
            // $manage_data_details['files'] = json_encode($thisFiles);
            // return json_encode($manage_data_details);
            $objectionDb = new ObjectionsModel();
            $objectionData = [
                'userid' => $manage_data_details['userid'],
                'crn' => $manage_data_details['crn'],
                'files' => $thisFiles[$objection_index]->$objection_filekey,
                'description' => $objection,
                'c_description' => session()->get('user.name') . ' Objected on your data for Asset ID-' . $manage_data_details['uid'],
                'filen' => $objection_filekey,
                'descn' => $objection_desckey,
                'time' => time(),
                'uid' => $manage_data_details['uid'],
                'sid' => $manage_data_details['sid'],
                'userverify' => session()->get('user.name'),
                'userType' => session()->get('user.type'),
                'UserObID' => session()->get('user.id'),
                'datetimes' => date('Y-m-d H:m:s', time()),
            ];
            if ($objectionDb->save($objectionData)) {
                return json_encode(true);
            } else {
                return json_encode(false);
            }
        }
        if ($this->request->getVar('delete_image')) {
            $index = $this->request->getVar('index');

            $thisFiles = json_decode($manage_data_details['files']);
            unset($thisFiles[$index]);

            $manage_data_details['files'] = json_encode($thisFiles);
            if ($this->manageDataDb->save($manage_data_details)) {
                return json_encode(true);
            }
            return json_encode(false);
        }

        return view('Dashboard/Admin/manage_data_details', $this->data);
    }

    public function defect_analysis()
    {

        $deviceType = isset($_GET['deviceType']) ? $_GET['deviceType'] : '';
        $defectType = isset($_GET['defectType']) ? $_GET['defectType'] : '';
        
        $startDate = $this->request->getVar('start_date') ? date('Y-m-d ', strtotime($this->request->getVar('start_date'))) . '00:00:00' : '';
        $endDate = $this->request->getVar('end_date') ? date('Y-m-d ', strtotime($this->request->getVar('end_date'))) . '23:59:59' : '';
        
        // $search_value = $this->request->getVar('search') && $this->request->getVar('search.value') ? $this->request->getVar('search.value') : '';

        if(!empty($startDate)) {
            $total = [
                'desktops' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Desktop')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                    ->where('ttg_post.defect !=', NULL)->countAllResults(),
                'notebooks' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Notebook')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                    ->where('ttg_post.defect !=', NULL)->countAllResults(),
                'other_devices' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Other Device')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                    ->where('ttg_post.defect !=', NULL)->countAllResults()
            ];
            if ($deviceType == 'Desktop') {
                $defectTotals = [
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Motherboard Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'cpu_missing_faulty' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'CPU Missing/Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'chasis_broken_cracked' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Chassis Broken/Cracked')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'permanent_marking_stained_discolor' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Permanent Marking/Stained/Discolor')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'bios_locked_security_feature_type' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'BIOS Locked/Security Feature Type')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Does Not Power-up')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'engraving_scratch' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Engraving/Scratch')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Other Defect')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'No Defect Found')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
            if ($deviceType == 'Notebook') {
                $defectTotals = [
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Motherboard Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'cpu_missing_faulty' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'CPU Missing/Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'chasis_broken' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Chassis Broken')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'chasis_cracked' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Chassis Cracked')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'permanent_marking_stained_discolor' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Permanent Marking/Stained/Discolor')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'bios_locked_security_feature_type' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'BIOS Locked/Security Feature Type')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Does Not Power-up')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'engraving_scratch' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Engraving/Scratch')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'screen_spot_blemish' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Screen Spots/Blemish')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'screen_broken_line_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Screen Broken/Line/Missing')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'keyword_faulty_key_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Keyboard Faulty/Key Missing')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'keyboard_panel_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Keyboard Panel Missing')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Other Defect')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'No Defect Found')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
            if ($deviceType == 'Other Device') {
                $defectTotals = [
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Motherboard Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Does Not Power-up')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'parts_missing_faulty' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Parts Missing/Faulty')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'broken_cracked' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Broken/Cracked')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Other Defect')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'No Defect Found')
                    ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
        } else {
            $total = [
                'desktops' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Desktop')
                    ->where('ttg_post.defect !=', NULL)->countAllResults(),
                'notebooks' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Notebook')
                    ->where('ttg_post.defect !=', NULL)->countAllResults(),
                'other_devices' => $this->manageDataDb->distinct()
                    ->select('ttg_post.id, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    ->where('ttg_post.device_type', 'Other Device')
                    ->where('ttg_post.defect !=', NULL)->countAllResults()
            ];
            if ($deviceType == 'Desktop') {
                $defectTotals = [
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Motherboard Faulty')->countAllResults(),
                    'cpu_missing_faulty' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'CPU Missing/Faulty')->countAllResults(),
                    'chasis_broken_cracked' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Chassis Broken/Cracked')->countAllResults(),
                    'permanent_marking_stained_discolor' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Permanent Marking/Stained/Discolor')->countAllResults(),
                    'bios_locked_security_feature_type' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'BIOS Locked/Security Feature Type')->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Does Not Power-up')->countAllResults(),
                    'engraving_scratch' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Engraving/Scratch')->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'Other Defect')->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Desktop')->like('defect', 'No Defect Found')->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
            if ($deviceType == 'Notebook') {
                $defectTotals = [
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Motherboard Faulty')->countAllResults(),
                    'cpu_missing_faulty' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'CPU Missing/Faulty')->countAllResults(),
                    'chasis_broken' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Chassis Broken')->countAllResults(),
                    'chasis_cracked' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Chassis Cracked')->countAllResults(),
                    'permanent_marking_stained_discolor' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Permanent Marking/Stained/Discolor')->countAllResults(),
                    'bios_locked_security_feature_type' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'BIOS Locked/Security Feature Type')->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Does Not Power-up')->countAllResults(),
                    'engraving_scratch' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Engraving/Scratch')->countAllResults(),
                    'screen_spot_blemish' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Screen Spots/Blemish')->countAllResults(),
                    'screen_broken_line_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Screen Broken/Line/Missing')->countAllResults(),
                    'keyword_faulty_key_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Keyboard Faulty/Key Missing')->countAllResults(),
                    'keyboard_panel_missing' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Keyboard Panel Missing')->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'Other Defect')->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Notebook')->like('defect', 'No Defect Found')->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
            if ($deviceType == 'Other Device') {
                $defectTotals = [
                    // 'motherboard_faulty' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'Motherboard Faulty')->countAllResults(),
                    // 'does_not_power_up' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'Does Not Power-up')->countAllResults(),
                    // 'parts_missing_faulty' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'Parts Missing/Faulty')->countAllResults(),
                    // 'broken_cracked' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'Broken/Cracked')->countAllResults(),
                    // 'other_defect' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'Other Defect')->countAllResults(),
                    // 'no_defect' => $this->manageDataDb->where(['device_type !=' => 'Desktop', 'device_type !=' => 'Notebook'])->like('defect', 'No Defect Found')->countAllResults(),
                    'motherboard_faulty' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Motherboard Faulty')->countAllResults(),
                    'does_not_power_up' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Does Not Power-up')->countAllResults(),
                    'parts_missing_faulty' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Parts Missing/Faulty')->countAllResults(),
                    'broken_cracked' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Broken/Cracked')->countAllResults(),
                    'other_defect' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'Other Defect')->countAllResults(),
                    'no_defect' => $this->manageDataDb->where('device_type', 'Other Device')->like('defect', 'No Defect Found')->countAllResults(),
                ];
                $this->data['defectTotals'] = $defectTotals;
            }
        }


        $this->data['totals'] = $total;
        // return print_r($this->data);

        if ($this->request->getVar('asset')) {
            $getCrn = $this->request->getVar('crn');
            $testData['total_crn'] = $this->manageDataDb->where('crn', $getCrn)->groupBy('id')->findAll();
            $noteBook['nootbook'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'notebook')->findAll();
            $otherDevice['otherDevice'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'Other Device')->findAll();
            $desktop['desktop'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'Desktop')->findAll();

            return json_encode(array_merge($testData, $noteBook, $otherDevice, $desktop));
            // return json_encode($this->manageDataDb->where('crn', $getCrn)->countAllResults());
        }

        // if ($this->request->getMethod() == 'post') {
        if ($this->request->getVar('draw')) {

            $params['draw'] = $this->request->getVar('draw');
            $start = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            
            $search_value = $this->request->getVar('search') && $this->request->getVar('search.value') ? $this->request->getVar('search.value') : '';

            $defectData = $this->getDefectData($start, $length, $search_value, $deviceType, $defectType, $startDate, $endDate);

            $defect_analysis = $defectData['data'];
            $count = $defectData['count'];

            foreach ($defect_analysis as $key => $defect) {
                $crnDetail = $defect['crn'];
                $defect_analysis[$key]['time'] = '<span>' . date("d-M-Y g:s A", $defect['time']) . '</span>';
                $defect_analysis[$key]['crn'] = '<a data-toggle="modal" data-target="#crnData" href="javascript:void(0);" onclick="openPopup(' . "'" . $crnDetail . "'" . ')">' . $defect['crn'] . '</a>';
            }

            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $defect_analysis   // total data array
            );

            return json_encode($json_data);
        }
        $this->data['crn_data'] = $this->manageDataDb->orderBy('id', 'desc')->groupBy(['crn'])->findAll(10);
        return view('Dashboard/Admin/defect_analysis', $this->data);
    }

    private function base64_encode_html_image($img_file)
    {
        // if (!is_file($img_file)) {
        //     return false;
        // }

        // $b64_file = "{$img_file}.b64";
        // if ($cache && is_file($b64_file)) {
        //     $b64 = file_get_contents($b64_file);
        // } else {
        $bin = file_get_contents($img_file);
        $b64 = base64_encode($bin);

        // if ($cache) {
        //     file_put_contents($b64_file, $b64);
        // }
        // }

        // if (!$ext) {
        $ext = pathinfo($img_file, PATHINFO_EXTENSION);
        // }

        return "<img src='data:image/{$ext};base64,{$b64}' style='height:100%;'/>";
    }
    private function verifyData($dataId)
    {
        $data = $this->manageDataDb->find($dataId);
        $data['verifyStatus'] = 1;
        $saveData = $this->manageDataDb->save($data);
        // return true;
        return redirect()->route('manage_data');
    }

    private function getDefectData($start = 0, $length = 10, $search_value = '', $deviceType = '', $defectType = '', $startDate = '', $endDate = '')
    {
        // ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
        if (!empty($startDate) && !empty($endDate)) {
            if (!empty($deviceType)) {
                if (!empty($defectType)) {
                    if (session()->get('loginType') == 'admin') {
                        $country = session()->get('user.country');
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    } else {
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    }
                } else {
                    if (session()->get('loginType') == 'admin') {
                        $country = session()->get('user.country');
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    } else {
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    }
                }
            } else {
                if (session()->get('loginType') == 'admin') {
                    $country = session()->get('user.country');
                    if (!empty($search_value)) {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                } else {
                    if (!empty($search_value)) {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                }
            }
        } else {
            if (!empty($deviceType)) {
                if (!empty($defectType)) {
                    if (session()->get('loginType') == 'admin') {
                        $country = session()->get('user.country');
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    } else {
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.defect', $defectType, 'both')
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    }
                } else {
                    if (session()->get('loginType') == 'admin') {
                        $country = session()->get('user.country');
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->where('ttg_post.device_type', $deviceType)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    } else {
                        if (!empty($search_value)) {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->like('ttg_post.userid', $search_value)
                                ->orlike('ttg_post.crn', $search_value)
                                ->orlike('ttg_post.uid', $search_value)
                                ->orlike('ttg_post.defect', $search_value)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        } else {
                            $defect_analysis = $this->manageDataDb->distinct()
                                ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                            $count = $this->manageDataDb->distinct()
                                ->select('ttg_post.*, ttg_login.country as userCountry')
                                ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                                ->where('ttg_post.device_type', $deviceType)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                                ->orderBy('ttg_post.time', 'desc')->countAllResults();
                        }
                    }
                }
            } else {
                if (session()->get('loginType') == 'admin') {
                    $country = session()->get('user.country');
                    if (!empty($search_value)) {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                } else {
                    if (!empty($search_value)) {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_post.device_type', $search_value)
                            ->orlike('ttg_post.defect', $search_value)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    } else {
                        $defect_analysis = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->orderBy('ttg_post.time', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.defect !=", NULL)->where("ttg_post.device_type !=", NULL)
                            ->orderBy('ttg_post.time', 'desc')->countAllResults();
                    }
                }
            }
        }

        return ['data' => $defect_analysis, 'count' => $count];
    }
}
