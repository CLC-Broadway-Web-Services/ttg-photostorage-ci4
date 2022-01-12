<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageShipmentModel;

class ManageShipmentController extends BaseController
{
    protected $manageShipDb;
    public function __construct()
    {
        $this->manageShipDb = new ManageShipmentModel();
    }

    public function manage_shipment()
    {
        // $shipments = $this->manageShipDb->distinct()
        // ->select('ttg_ship.*, ttg_login.country as userCountry')
        // ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
        // ->orderBy('ttg_ship.id', 'desc')->findAll(100);
        if ($this->request->getMethod() == 'post') {

            if ($this->request->getVar('csv')) {
                return json_encode($this->get_excel_data($this->request->getVar('id')));
            }

            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageShipDb->delete($getId);
            }

            $start_date = $this->request->getVar('start_date');
            $end_date = $this->request->getVar('end_date');
            // return print_r(strtotime($start_date));
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'date_form') {
                $start_date = $this->request->getVar('start_date');
                $end_date = $this->request->getVar('end_date');
                $route = route_to('manage_shipment') . '?start_date=' . $start_date . '&end_date=' . $end_date;
                return redirect()->to($route);
                die();
            }
            // if($this->request->getVar('draw'))
            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search_value = $_REQUEST['search']['value'];
            $startDate = $this->request->getGet('start_date') && strtotime($this->request->getGet('start_date')) ? strtotime($this->request->getGet('start_date')) : null;
            $endDate = $this->request->getGet('end_date') && strtotime($this->request->getGet('end_date')) ? strtotime($this->request->getGet('end_date')) : null;
            if ($startDate && $endDate) {
                if (!empty($search_value)) {
                    // return print_r($startDate);
                    $shipments = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->like('ttg_ship.userid', $search_value)
                        ->orLike('ttg_ship.crn', $search_value)
                        ->orLike('ttg_ship.logistic_company', $search_value)
                        ->orLike('ttg_ship.box_condition', $search_value)
                        ->orLike('ttg_ship.time', $search_value)
                        ->orLike('ttg_login.country', $search_value)
                        ->where('ttg_ship.time <=', $startDate)
                        ->where('ttg_ship.time >=', $endDate)
                        ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->like('ttg_ship.userid', $search_value)
                        ->orLike('ttg_ship.crn', $search_value)
                        ->orLike('ttg_ship.logistic_company', $search_value)
                        ->orLike('ttg_ship.box_condition', $search_value)
                        ->orLike('ttg_ship.time', $search_value)
                        ->orLike('ttg_login.country', $search_value)
                        ->where('ttg_ship.time <=', $startDate)
                        ->where('ttg_ship.time >=', $endDate)
                        ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                } else {
                    $shipments = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->where('ttg_ship.time <=', $startDate)
                        ->where('ttg_ship.time >=', $endDate)
                        ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->where('ttg_ship.time <=', $startDate)
                        ->where('ttg_ship.time >=', $endDate)
                        ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                }
            } else {
                if (!empty($search_value)) {
                    $shipments = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->like('ttg_ship.userid', $search_value)
                        ->orLike('ttg_ship.crn', $search_value)
                        ->orLike('ttg_ship.logistic_company', $search_value)
                        ->orLike('ttg_ship.box_condition', $search_value)
                        ->orLike('ttg_ship.time', $search_value)
                        ->orLike('ttg_login.country', $search_value)
                        ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->like('ttg_ship.userid', $search_value)
                        ->orLike('ttg_ship.crn', $search_value)
                        ->orLike('ttg_ship.logistic_company', $search_value)
                        ->orLike('ttg_ship.box_condition', $search_value)
                        ->orLike('ttg_ship.time', $search_value)
                        ->orLike('ttg_login.country', $search_value)
                        ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                } else {
                    $shipments = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                    $count = $this->manageShipDb->distinct()
                        ->select('ttg_ship.*, ttg_login.country as userCountry')
                        ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                        ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                }
            }

            foreach ($shipments as $key => $shipment) {
                $checkBoxHtml = '<div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" value="uid1" id="uid1">
                            <label class="custom-control-label" for="uid1"></label>
                        </div>';
                $popupWindowUrl = base_url(route_to('manage_shipment_details', $shipment['id']));
                $id = $shipment['id'];
                $actionsHtml = '<ul class="nk-tb-actions gx-1"><li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                        <li><a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="open_new_window"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                            <li><a href="javascript:void(0);" onclick="copyToClipboard(this)" data-copy="'.$popupWindowUrl.'"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                                            
                                            <li><a href="javascript:void(0);" onclick="getExcel(' . "'" . $id . "'" . ')"><em class="icon ni ni-file-docs"></em><span >Excel</span></a></li>
                                            <li><a href="javascript:void(0);" onclick="deleteData(' . "'" . $id . "'" . ')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>';

                $shipments[$key]['condition'] = $shipment['box_condition'];
                $shipments[$key]['id'] = str_replace("uid1", $shipment['id'], $checkBoxHtml);
                $shipments[$key]['actions'] = $actionsHtml;
                if ($shipment['box_condition'] == 'Poor') {
                    $shipments[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Fair') {
                    $shipments[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-warning">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Good') {
                    $shipments[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-success">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Rejected') {
                    $shipments[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs">' . $shipment['box_condition'] . '</span>';
                }
                $shipments[$key]['time'] = '<span>' . date("d M Y, g:s A", $shipment['time']) . '</span>';
            }

            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $shipments   // total data array
            );

            return json_encode($json_data);
        }
        // $this->data['shipments'] = $this->manageShipDb->orderBy('id', 'desc')->findAll(200);
        // $this->data['shipments'] = $shipments;
        // return print_r($this->data);
        return view('Dashboard/Admin/manage_shipment', $this->data);
    }

    public function manage_shipment_details($id)
    {
        $this->data['manage_shipment_details'] = $this->manageShipDb->find($id);


        if ($this->request->getMethod() == 'post') {
            // return print_r($this->request->getVar());
            if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'login_form') {

                $userEmail = $this->request->getVar('email');
                $userPassword = $this->request->getVar('password');

                $userDb = new AdminModel();
                $getUser = $userDb->where('email', $userEmail)->first();
                $response = ['success' => false, 'message' => ''];

                if (password_verify($userPassword, $getUser['pass'])) {
                    // return print_r($getUser);
                    unset($getUser['pass']);
                    unset($getUser['token']);
                    // return print_r($getUser);

                    $sessionData['userLoggedIn'] = true;
                    $sessionData['loginType'] = $getUser['type'];
                    $sessionData['user'] = $getUser;
                    session()->set($sessionData);

                    return redirect()->route('manage_shipment_details', [$id]);
                } else {
                    return print_r('not match');
                    $response['message'] = 'Password or email not matched.';
                }
            }
            if (session()->get('userLoggedIn')) :
                if (session()->get('loginType') == 'client' || session()->get('loginType') == 'superadmin' || session()->get('loginType') == 'admin') :
                    if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'single_submition') {
                        $fields = $this->request->getVar();
                        unset($fields['form_name']);
                        $fields['id'] = $id;

                        $query = $this->manageShipDb->save($fields);

                        if ($query) {
                            return json_decode(true);
                        }
                        return json_decode($query);
                    }
                endif;
            endif;
        }


        return view('Dashboard/Admin/manage_shipment_details', $this->data);
    }

    public function get_excel_data($id)
    {
        return $this->manageShipDb->first($id);
    }

    private function getManageTableData()
    {
    }
}
