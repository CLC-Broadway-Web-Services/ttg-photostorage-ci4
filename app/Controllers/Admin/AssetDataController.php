<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CrnModel;
use App\Models\Admin\PostsModel;


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


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageDataDb->where('uid', $getId)->delete();
            }

            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            /* If we pass any extra data in request from ajax */
            //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

            /* Value we will get from typing in search */
            $search_value = $_REQUEST['search']['value'];

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



            // if(!empty($search_value)){
            //     // If we have value in search, searching by id, name, email, mobile

            //     // count all data
            //     // $total_count = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%'")->getResult();

            //     // $data = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%' limit $start, $length")->getResult();
            // }else{
            //     // count all data
            //     // $total_count = $this->db->query("SELECT * from tbl_students")->getResult();

            //     // get per page data
            //     // $data = $this->db->query("SELECT * from tbl_students limit $start, $length")->getResult();
            // }


            foreach ($manageData as $key => $manage) {

                $checkBoxHtml = '<div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" class="custom-control-input" value="uid1" id="uid1">
                        <label class="custom-control-label" for="uid1"></label>
                    </div>';
                $popupWindowUrl = route_to('manage_data_details', $manage['uid']);
                $id = $manage['uid'];
                $actionsHtml = '<ul class="nk-tb-actions gx-1"><li>
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                    <li><a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="open_new_window"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                    <li><a href="javascript:void(0);" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                                    <li><a href=' . route_to('manage_data_pdf', $manage["uid"]) . '><em class="icon ni ni-file-pdf"></em><span>PDF</span></a></li>
                                    <li><a href=' . route_to('manage_data_excel', $manage["uid"]) . '><em class="icon ni ni-file-docs"></em><span>Excel</span></a></li>
                                    <li><a href="javascript:void(0);" onclick="deleteData(' . "'" . $id . "'" . ')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>';
                $manageData[$key]['id'] = str_replace("uid1", $manage['id'], $checkBoxHtml);
                $manageData[$key]['actions'] = $actionsHtml;

                $manageData[$key]['time'] = '<span>' . date("d M Y, g:s A", $manage['time']) . '</span>';
                $files = json_decode($manage['files']);
                $filesCount = count($files);
                $manageData[$key]['files'] = $filesCount;
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
        return view('Dashboard/Admin/manage_data', $this->data);
    }
    public function manage_data_details($uid)
    {

        $this->data['manage_data_details'] = $this->manageDataDb->where('uid', $uid)->first();
        // echo '<pre>';
        // return print_r($this->data['manage_data_details']);
        // echo '</pre>';
        // if ($this->request->getMethod() == 'post') {

        //     if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'single_submition') {
        //         $fields = $this->request->getVar();
        //         unset($fields['form_name']);
        //         $fields['id'] = $id;

        //         $query = $this->manageShipDb->save($fields);

        //         if ($query) {
        //             return json_decode(true);
        //         }
        //         return json_decode($query);
        //     }
        // }


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

            // if(!empty($search_value)){
            //     // If we have value in search, searching by id, name, email, mobile

            //     // count all data
            //     // $total_count = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%'")->getResult();

            //     // $data = $this->db->query("SELECT * from tbl_students WHERE id like '%".$search_value."%' OR name like '%".$search_value."%' OR email like '%".$search_value."%' OR mobile like '%".$search_value."%' limit $start, $length")->getResult();
            // }else{
            //     // count all data
            //     // $total_count = $this->db->query("SELECT * from tbl_students")->getResult();

            //     // get per page data
            //     // $data = $this->db->query("SELECT * from tbl_students limit $start, $length")->getResult();
            // }
            $checkBoxHtml = '<div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" class="custom-control-input" value="uid1" id="uid1">
                        <label class="custom-control-label" for="uid1"></label>
                    </div>';
            // $actionsHtml = '<ul class="nk-tb-actions gx-1"><li>
            //                 <div class="drodown">
            //                     <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            //                     <div class="dropdown-menu dropdown-menu-right">
            //                         <ul class="link-list-opt no-bdr">
            //                             <li><a href="#"><em class="icon ni ni-share"></em><span>Share</span></a></li>
            //                             <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
            //                             <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
            //                         </ul>
            //                     </div>
            //                 </div>
            //             </li>
            //         </ul>';



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
