<?php

namespace App\Controllers\Client;

use App\Controllers\Admin\ClientController;
use App\Controllers\BaseController;
use App\Models\Admin\CrnModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;

class DashboardController extends BaseController
{
    protected $client;
    protected $manageDataDb;
    protected $crnData;

    public function __construct()
    {
        $this->client = (object) session()->get('user');
        $this->manageDataDb = new PostsModel();
        $this->crnData = new CrnModel();
    }
    public function index()
    {
        return view('Dashboard/Client/index');
    }
    public function byCrn()
    {
        if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('delete')) {
                $getId = $this->request->getVar('id');
                return $this->manageDataDb->where('uid', $getId)->delete();
            }
            if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'multiDelete') {
                $ids = $this->request->getVar('id');
                foreach ($ids as $key => $value) {
                    // return $value;
                    $this->manageDataDb->delete($value);
                }
                return true;
            }
            $manageData = array();
            $count = 0;

            $multiSearch = $this->request->getGet('crns') ? explode(',', $this->request->getGet('crns')) : [];
            if ($multiSearch) {
                foreach ($multiSearch as $key => $value) {
                    $multiSearch[$key] = ltrim($value);
                }
            }
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_multiple_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->whereIn('id', $ids)->findAll();
                return generatePdf($data, 'multiple');
            }
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_single_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->where('uid', $ids)->first();
                return generatePdf($data);
            }

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            // $search_value = $_REQUEST['search']['value'];

            $startDate = $this->request->getGet('start_date') ? date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00' : null;
            $endDate = $this->request->getGet('end_date') ? date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '00:00:00' : null;

            // compulsory data
            $select = 'ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry';

            if ($startDate && $endDate) {
                // if (!empty($search_value)) {
                if (count($multiSearch)) {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.crn', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.crn', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
                // } else {
                //     $manageData = $this->manageDataDb->distinct()
                //         ->select($select)
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                //         ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                //     $count = $this->manageDataDb->distinct()
                //         ->select('ttg_post.id')
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                //         ->orderBy('ttg_post.id', 'desc')->countAllResults();
                // }
            } else {
                // if (!empty($search_value)) {
                if (count($multiSearch)) {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.crn', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.crn', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
                // } else {
                //     $manageData = $this->manageDataDb->distinct()
                //         ->select($select)
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                //     $count = $this->manageDataDb->distinct()
                //         ->select('ttg_post.id')
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->orderBy('ttg_post.id', 'desc')->countAllResults();
                // }
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
        return view('Dashboard/Client/crn_search');
    }
    public function byAssetId()
    {
        if ($this->request->getMethod() == 'post') {
            if ($this->request->getVar('delete')) {
                $getId = $this->request->getVar('id');
                return $this->manageDataDb->where('uid', $getId)->delete();
            }
            if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'multiDelete') {
                $ids = $this->request->getVar('id');
                foreach ($ids as $key => $value) {
                    // return $value;
                    $this->manageDataDb->delete($value);
                }
                return true;
            }
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_multiple_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->whereIn('id', $ids)->findAll();
                return generatePdf($data, 'multiple');
            }
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'generate_single_pdf') {
                $ids = $this->request->getVar('id');
                $data = $this->manageDataDb->select('uid, files')->where('uid', $ids)->first();
                return generatePdf($data);
            }
            $manageData = array();
            $count = 0;

            $multiSearch = $this->request->getGet('assets') ? explode(',', $this->request->getGet('assets')) : [];
            if ($multiSearch) {
                foreach ($multiSearch as $key => $value) {
                    $multiSearch[$key] = ltrim($value);
                }
            }

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            // $search_value = $_REQUEST['search']['value'];

            $startDate = $this->request->getGet('start_date') ? date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00' : null;
            $endDate = $this->request->getGet('end_date') ? date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '00:00:00' : null;

            // compulsory data
            $select = 'ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry';

            if ($startDate && $endDate) {
                // if (!empty($search_value)) {
                if (count($multiSearch)) {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.uid', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.uid', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
                // } else {
                //     $manageData = $this->manageDataDb->distinct()
                //         ->select($select)
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                //         ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                //     $count = $this->manageDataDb->distinct()
                //         ->select('ttg_post.id')
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->where("ttg_post.created_at BETWEEN '$startDate' AND '$endDate'")
                //         ->orderBy('ttg_post.id', 'desc')->countAllResults();
                // }
            } else {
                // if (!empty($search_value)) {
                if (count($multiSearch)) {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.uid', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->whereIn('ttg_post.uid', $multiSearch)
                        // ->like('ttg_post.userid', $search_value)
                        // ->orlike('ttg_post.crn', $search_value)
                        // ->orlike('ttg_post.uid', $search_value)
                        // ->orlike('ttg_login.country', $search_value)
                        // ->orlike('ttg_post.verifyStatus', $search_value)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                } else {
                    $manageData = $this->manageDataDb->distinct()
                        ->select($select)
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageDataDb->distinct()
                        ->select('ttg_post.id')
                        ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                        ->where('ttg_login.country', $this->client->country)
                        ->orderBy('ttg_post.id', 'desc')->countAllResults();
                }
                // } else {
                //     $manageData = $this->manageDataDb->distinct()
                //         ->select($select)
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->orderBy('ttg_post.id', 'desc')->offset($start)->findAll($length);
                //     $count = $this->manageDataDb->distinct()
                //         ->select('ttg_post.id')
                //         ->where('ttg_login.country', $this->client->country)
                //         ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                //         ->orderBy('ttg_post.id', 'desc')->countAllResults();
                // }
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
        return view('Dashboard/Client/asset_search');
    }
}
