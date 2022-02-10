<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Models\Admin\AdminModel;
use App\Models\Admin\CrnModel;
use App\Models\Admin\ObjectionsModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;
use FPDF;

use function PHPSTORM_META\elementType;

// use FPDF;

// use function App\Controllers\attachment_size as ControllersAttachment_size;

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
        if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'del') {
                $getId = $this->request->getVar('id');
                return $this->manageDataDb->where('uid', $getId)->delete();
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
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_multiple_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->whereIn('id', $ids)->findAll();
                return generatePdf($data, 'multiple');
                // return json_encode($data);
            }
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_single_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->where('uid', $ids)->first();
                return generatePdf($data);
                // return json_encode($data);
                // return $this->request->getVar();
            }
            $manageData = array();
            $count = 0;

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search_value = $_REQUEST['search']['value'];

            $startDate = $this->request->getGet('start_date') ? date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00' : null;
            $endDate = $this->request->getGet('end_date') ? date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '00:00:00' : null;

            if (session()->get('loginType') == 'admin') {
                $country = session()->get('user.country');
                if ($startDate && $endDate) {
                    if (!empty($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    }
                } else {
                    if (!empty($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    }
                }
            } else {
                if ($startDate && $endDate) {
                    if (!empty($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    }
                } else {
                    if (!empty($search_value)) {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->like('ttg_post.userid', $search_value)
                            ->orlike('ttg_post.crn', $search_value)
                            ->orlike('ttg_post.uid', $search_value)
                            ->orlike('ttg_login.country', $search_value)
                            ->orlike('ttg_post.verifyStatus', $search_value)
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    } else {
                        $manageData = $this->manageDataDb->distinct()
                            ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageDataDb->distinct()
                            ->select('ttg_post.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                            ->orderBy('ttg_post.id', 'desc')->countAllResults();
                    }
                }
            }

            foreach ($manageData as $key => $manage) {
                $id = $manage['uid'];
                $popupWindowUrl = base_url(route_to('manage_data_details', base64_encode($id)));
                // $id = $manage['uid'];
                $actionsHtml = '<ul class="nk-tb-actions gx-1" dataLink="' . $popupWindowUrl . '">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                <li><a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="open_new_window"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                <li><a href="javascript:void(0);" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                                                <li><button class="btn btn-link" onclick="onclickSinglePdf(' . "'" . $id . "'" . ')"><em class="icon ni ni-file-pdf"></em><span>PDF</span></button></li>
                                                <li><a href=' . route_to('manage_data_excel', base64_encode($id)) . '><em class="icon ni ni-file-docs"></em><span>Excel</span></a></li>
                                                <li><a href="javascript:void(0);" onclick="deleteData(' . "'" . $id . "'" . ')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>';

                $manageData[$key]['actions'] = $actionsHtml;

                $manageData[$key]['time'] = '<span>' . date("d M Y, g:s A", $manage['time']) . '</span>';
                if ($manage['files'] && $manage['files'] !== 'null') {
                    $files = json_decode($manage['files']);
                    $filesCount = count($files);
                    $manageData[$key]['files'] = $filesCount;
                } else {
                    $manageData[$key]['files'] = 0;
                }

                if ($manage['verifyStatus'] == 0) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-warning">Pending</span>';
                }
                if ($manage['verifyStatus'] == 1) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">Varified</span>';
                }
                if ($manage['verifyStatus'] == 2) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">Objected</span>';
                }
                if ($manage['verifyStatus'] == 3) {
                    $manageData[$key]['verifyStatus'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">Re-Verified</span>';
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

    public function manage_data_details($encodedID, $imageId = 0)
    {
        $uid = base64_decode($encodedID);

        $this->data['encodedID'] = $encodedID;

        $manage_data_details = $this->manageDataDb->where('uid', $uid)->first();
        $this->data['manage_data_details'] = $manage_data_details;

        // if ($imageId > 0) {
        //     $files = json_decode($manage_data_details['files']);
        // }

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
            $objection_desckey = 'desc' . $objection_index + 1;
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
        if ($this->request->getMethod() == 'post' && $this->request->getVar('delete_image')) {
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

        // $testData = $this->manageDataDb->selectCount('defect')->select('device_type','crn')->where('crn', 'EOL-000002711')->groupBy(['device_type'])->findAll();
        // $testData = $this->manageDataDb->select('device_type, defect')->where('crn', 'EOL-000002711')->findAll();
        // $testData = $this->manageDataDb->select('device_type, defect')->where('crn', 'EOL-000000589')->groupBy(['device_type', 'defect'])->findAll();
        // return print_r($testData);
        // SELECT * FROM `ttg_post` WHERE `crn` = 'EOL-000000685' GROUP BY `device_type`

        if ($this->request->getVar('asset')) {
            $getCrn = $this->request->getVar('crn');
            $testData['total_crn'] = $this->manageDataDb->where('crn', $getCrn)->groupBy('id')->findAll();
            $noteBook['nootbook'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'notebook')->findAll();
            $otherDevice['otherDevice'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'Other Device')->findAll();
            $desktop['desktop'] = $this->manageDataDb->where('crn', $getCrn)->where('device_type', 'Desktop')->findAll();

            return json_encode(array_merge($testData, $noteBook, $otherDevice, $desktop));
            // return json_encode($this->manageDataDb->where('crn', $getCrn)->countAllResults());
        }

        if ($this->request->getMethod() == 'post') {

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            /* If we pass any extra data in request from ajax */
            //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

            /* Value we will get from typing in search */
            $search_value = $_REQUEST['search']['value'];

            if (session()->get('loginType') == 'admin') {
                $country = session()->get('user.country');
                if (!empty($search_value)) {
                    $defect_analysis = $this->manageDataDb->distinct()
                        ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where("ttg_login.country", $country)
                        ->like('ttg_post.userid', $search_value)
                        ->orlike('ttg_post.crn', $search_value)
                        ->orlike('ttg_post.uid', $search_value)
                        ->orlike('ttg_post.device_type', $search_value)
                        ->orlike('ttg_post.defect', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where("ttg_login.country", $country)
                        ->like('ttg_post.userid', $search_value)
                        ->orlike('ttg_post.crn', $search_value)
                        ->orlike('ttg_post.uid', $search_value)
                        ->orlike('ttg_post.device_type', $search_value)
                        ->orlike('ttg_post.defect', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $defect_analysis = $this->manageDataDb->distinct()
                        ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where("ttg_login.country", $country)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where("ttg_login.country", $country)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
            } else {
                if (!empty($search_value)) {
                    $defect_analysis = $this->manageDataDb->distinct()
                        ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->like('ttg_post.userid', $search_value)
                        ->orlike('ttg_post.crn', $search_value)
                        ->orlike('ttg_post.uid', $search_value)
                        ->orlike('ttg_post.device_type', $search_value)
                        ->orlike('ttg_post.defect', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->like('ttg_post.userid', $search_value)
                        ->orlike('ttg_post.crn', $search_value)
                        ->orlike('ttg_post.uid', $search_value)
                        ->orlike('ttg_post.device_type', $search_value)
                        ->orlike('ttg_post.defect', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $defect_analysis = $this->manageDataDb->distinct()
                        ->select('ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.device_type, ttg_post.defect, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
            }

            $checkBoxHtml = '<div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" class="custom-control-input" value="uid1" id="uid1">
                        <label class="custom-control-label" for="uid1"></label>
                    </div>';

            foreach ($defect_analysis as $key => $defect) {
                $crnDetail = $defect['crn'];
                $defect_analysis[$key]['id'] = str_replace("uid1", $defect['id'], $checkBoxHtml);
                // $defect_analysis[$key]['actions'] = $actionsHtml;

                $defect_analysis[$key]['time'] = '<span>' . date("d M Y, g:s A", $defect['time']) . '</span>';
                $defect_analysis[$key]['crn'] = '<a data-toggle="modal" data-target="#crnData" href="javascript:void(0);" onclick="openPopup(' . "'" . $crnDetail . "'" . ')">' . $defect['crn'] . '</a>';
                // $files = json_decode($defect['files']);
                // $filesCount = count($files);
                // $defect_analysis[$key]['files'] = $filesCount;


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
}
