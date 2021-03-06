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

        // return print_r('shipment');
        if ($this->request->getMethod() == 'post') {

            if ($this->request->getVar('csv')) {
                return json_encode($this->get_excel_data($this->request->getVar('id')));
            }

            if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'del') {
                $getId = $this->request->getVar('id');
                return $this->manageShipDb->delete($getId);
            }

            if ($this->request->getVar('download') && $this->request->getVar('download') == 'pdf') {
                $getId = $this->request->getVar('id');
                // return $this->manageShipDb->delete($getId);
                return $this->generateDownloadPdf($getId);
            }

            if ($this->request->getVar('delete') && $this->request->getVar('delete') == 'multiDelete') {
                $ids = $this->request->getVar('id');
                foreach ($ids as $key => $value) {
                    // return $value;
                    $this->manageShipDb->delete($value);
                }
                // return json_encode($this->request->getVar('id'));
                // $getId = $this->request->getVar('id');
                return true;
            }

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
                        // return print_r($startDate);
                        $shipments = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->like('ttg_ship.userid', $search_value)
                            ->orLike('ttg_ship.crn', $search_value)
                            ->orLike('ttg_ship.logistic_company', $search_value)
                            ->orLike('ttg_ship.box_condition', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->like('ttg_ship.userid', $search_value)
                            ->orLike('ttg_ship.crn', $search_value)
                            ->orLike('ttg_ship.logistic_company', $search_value)
                            ->orLike('ttg_ship.box_condition', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                    } else {
                        $shipments = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->where("ttg_login.country", $country)
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
                            // ->orLike('ttg_ship.time', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->like('ttg_ship.userid', $search_value)
                            ->orLike('ttg_ship.crn', $search_value)
                            ->orLike('ttg_ship.logistic_company', $search_value)
                            ->orLike('ttg_ship.box_condition', $search_value)
                            // ->orLike('ttg_ship.time', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                    } else {
                        $shipments = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_login.country", $country)
                            ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                    }
                }
            } else {
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
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->like('ttg_ship.userid', $search_value)
                            ->orLike('ttg_ship.crn', $search_value)
                            ->orLike('ttg_ship.logistic_company', $search_value)
                            ->orLike('ttg_ship.box_condition', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_ship.id', 'desc')->countAllResults();
                    } else {
                        $shipments = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->where("ttg_ship.created_at BETWEEN '$startDate' AND '$endDate'")
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
                            // ->orLike('ttg_ship.time', $search_value)
                            ->orLike('ttg_login.country', $search_value)
                            ->orderBy('ttg_ship.id', 'desc')->offset($start)->findAll($length);
                        $count = $this->manageShipDb->distinct()
                            ->select('ttg_ship.*, ttg_login.country as userCountry')
                            ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                            ->like('ttg_ship.userid', $search_value)
                            ->orLike('ttg_ship.crn', $search_value)
                            ->orLike('ttg_ship.logistic_company', $search_value)
                            ->orLike('ttg_ship.box_condition', $search_value)
                            // ->orLike('ttg_ship.time', $search_value)
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
            }

            foreach ($shipments as $key => $shipment) {
                // $checkBoxHtml = '<div class="custom-control custom-control-sm custom-checkbox notext">
                //             <input type="checkbox" class="custom-control-input" value="uid1" id="uid1">
                //             <label class="custom-control-label" for="uid1"></label>
                //         </div>';
                // <li><a class="text-danger" href="javascript:void(0);" onclick="deleteData(' . "'" . $id . "'" . ')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                $id = $shipment['id'];
                $popupWindowUrl = base_url(route_to('manage_shipment_details', base64_encode($id)));
                // $actionsHtml = '<ul class="nk-tb-actions gx-1" dataLink="' . $popupWindowUrl . '">
                //                     <li>
                //                         <div class="drodown">
                //                             <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                //                             <div class="dropdown-menu dropdown-menu-right">
                //                                 <ul class="link-list-opt no-bdr">
                //                                     <li><a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="open_new_window"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                //                                     <li><a href="javascript:void(0);" onclick="copyToClipboard(this)" data-copy="' . $popupWindowUrl . '"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                //                                 </ul>
                //                             </div>
                //                         </div>
                //                     </li>
                //                 </ul>';
                if ($shipment['files'] && $shipment['files'] !== 'null') {
                    $files = json_decode($shipment['files']);
                    $filesCount = count($files);
                    if ($filesCount) {
                        $actionsHtml = '<a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="after_divider btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>/<a href="javascript:void(0);" onclick="copyToClipboard(this)" data-copy="' . $popupWindowUrl . '" class="after_divider btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';
                        $shipments[$key]['actions'] = $actionsHtml;
                    } else {
                        $actionsHtml = '<a href="javascript:void(0);" onclick="showNoFilesError()" class="after_divider btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>/<a href="javascript:void(0);" onclick="showNoFilesError()" class="after_divider btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';
                        $shipments[$key]['actions'] = $actionsHtml;
                    }
                } else {
                    $actionsHtml = '<a href="javascript:void(0);" onclick="showNoFilesError()" class="after_divider btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>/<a href="javascript:void(0);" onclick="showNoFilesError()" class="after_divider btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';
                    $shipments[$key]['actions'] = $actionsHtml;
                }

                $shipments[$key]['condition'] = $shipment['box_condition'];
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
        return view('Dashboard/Admin/manage_shipment', $this->data);
    }

    public function manage_shipment_details($baseid)
    {
        $id = base64_decode($baseid);
        $this->data['manage_shipment_details'] = $this->manageShipDb->find($id);

        if ($this->request->getMethod() == 'post') {
            // return print_r($this->request->getVar());
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

                    return redirect()->route('manage_shipment_details', [$baseid]);
                } else {
                    // return print_r('not match or not activated');
                    $response['message'] = 'Password or email not matched. Or User not activated yet.';
                }
            }
            if (session()->get('userLoggedIn')) :
                if (session()->get('loginType') == 'client' || session()->get('loginType') == 'superadmin' || session()->get('loginType') == 'admin') :
                    if ($this->request->getVar('form_name') && $this->request->getVar('form_name') == 'single_submition') {
                        $fields = $this->request->getVar();
                        // return json_encode($this->request->getVar());
                        unset($fields['form_name']);
                        $fields['id'] = base64_decode($baseid);
                        // return json_encode($fields);

                        $query = $this->manageShipDb->save($fields);

                        if ($query) {
                            return json_encode(true);
                        }
                        return json_encode($query);
                    }
                endif;
            endif;
        }

        // return print_r($this->data);
        return view('Dashboard/Admin/manage_shipment_details', $this->data);
    }

    public function get_excel_data($id)
    {
        return $this->manageShipDb->first($id);
    }
}
