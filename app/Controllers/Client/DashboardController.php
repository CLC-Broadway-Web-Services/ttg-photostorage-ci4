<?php

namespace App\Controllers\Client;

use App\Controllers\Admin\ClientController;
use App\Controllers\BaseController;
use App\Models\Admin\CrnModel;
use App\Models\Admin\ManageShipmentModel;
use App\Models\Admin\PostsModel;
use Dompdf\Dompdf;

class DashboardController extends BaseController
{
    protected $client;
    protected $manageDataDb;
    protected $manageShipDb;
    protected $crnData;

    public function __construct()
    {
        $this->client = (object) session()->get('user');
        $this->manageDataDb = new PostsModel();
        $this->manageShipDb = new ManageShipmentModel();
        $this->crnData = new CrnModel();
    }
    public function index()
    {
        // return print_r($this->client);
        return view('Dashboard/Client/index');
    }
    public function byCrn()
    {
        // print_r(strtotime(date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '23:59:59'));
        // return;
        $data = [];
        // if ($this->request->getMethod() == 'post') {
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
        $manageData = [];
        $shipmentsData = [];

        $multiSearch = $this->request->getGet('crns') ? explode(',', $this->request->getGet('crns')) : [];
        $startDate = $this->request->getGet('start_date') ? strtotime(date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00') : null;
        $endDate = $this->request->getGet('end_date') ? strtotime(date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '23:59:59') : null;

        if ($this->request->getGet('crns')) {
            foreach ($multiSearch as $key => $value) {
                $multiSearch[$key] = ltrim($value);
            }

            // compulsory data
            $select = 'ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry';

            if ($startDate && $endDate) {
                $manageData = $this->manageDataDb->distinct()
                    ->select($select)
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->where('ttg_login.country', $this->client->country)
                    ->where("ttg_post.time BETWEEN '$startDate' AND '$endDate'")
                    ->whereIn('ttg_post.crn', $multiSearch)
                    ->orderBy('ttg_post.id', 'desc')
                    ->findAll();
                // return print_r($manageData);
                // $manageData->findAll();
            } else {
                $manageData = $this->manageDataDb->distinct()
                    ->select($select)
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->where('ttg_login.country', $this->client->country)
                    ->whereIn('ttg_post.crn', $multiSearch)
                    ->orderBy('ttg_post.id', 'desc')->findAll();
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
                $actionsHtml = '<a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a><a href="javascript:void(0);" class="btn btn-icon" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')" title="Share"><em class="icon ni ni-share"></em></a>';

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
            $data['manageData'] = $manageData;

            // $country = session()->get('user.country');
            if ($startDate && $endDate) {
                // ->where("ttg_login.country", $country)
                $shipmentsData = $this->manageShipDb->distinct()
                    ->select('ttg_ship.*, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                    ->where("ttg_ship.time BETWEEN '$startDate' AND '$endDate'")
                    ->whereIn('ttg_ship.crn', $multiSearch)
                    ->orderBy('ttg_ship.id', 'desc')->findAll();
            } else {
                // ->where("ttg_login.country", $country)
                $shipmentsData = $this->manageShipDb->distinct()
                    ->select('ttg_ship.*, ttg_login.country as userCountry')
                    ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
                    ->whereIn('ttg_ship.crn', $multiSearch)
                    ->orderBy('ttg_ship.id', 'desc')->findAll();
            }

            foreach ($shipmentsData as $key => $shipment) {
                $id = $shipment['id'];
                $popupWindowUrl = base_url(route_to('manage_shipment_details', base64_encode($id)));
                $actionsHtml = '<a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="after_divider btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>/<a href="javascript:void(0);" onclick="copyToClipboard(this)" data-copy="' . $popupWindowUrl . '" class="after_divider btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';

                $shipmentsData[$key]['condition'] = $shipment['box_condition'];
                $shipmentsData[$key]['actions'] = $actionsHtml;
                if ($shipment['box_condition'] == 'Poor') {
                    $shipmentsData[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Fair') {
                    $shipmentsData[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-warning">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Good') {
                    $shipmentsData[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-success">' . $shipment['box_condition'] . '</span>';
                } elseif ($shipment['box_condition'] == 'Rejected') {
                    $shipmentsData[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs">' . $shipment['box_condition'] . '</span>';
                }
                $shipmentsData[$key]['time'] = '<span>' . date("d M Y, g:s A", $shipment['time']) . '</span>';
            }

            $data['shipmentsData'] = $shipmentsData;
            // return print_r($data);
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

        return view('Dashboard/Client/crn_search', $data);
    }
    public function byAssetId()
    {
        $data = [];
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
        }
        $manageData = [];
        $shipmentsData = [];

        $multiSearch = $this->request->getGet('assets') ? explode(',', $this->request->getGet('assets')) : [];
        $startDate = $this->request->getGet('start_date') ? strtotime(date('Y-m-d ', strtotime($this->request->getGet('start_date'))) . '00:00:00') : null;
        $endDate = $this->request->getGet('end_date') ? strtotime(date('Y-m-d ', strtotime($this->request->getGet('end_date'))) . '23:59:59') : null;

        if ($this->request->getGet('assets')) {
            foreach ($multiSearch as $key => $value) {
                $multiSearch[$key] = ltrim($value);
            }

            // compulsory data
            $select = 'ttg_post.id, ttg_post.userid, ttg_post.files, ttg_post.time, ttg_post.uid, ttg_post.crn, ttg_post.verifyStatus, ttg_post.uid, ttg_login.country as userCountry';

            if ($startDate && $endDate) {
                $manageData = $this->manageDataDb->distinct()
                    ->select($select)
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->where('ttg_login.country', $this->client->country)
                    ->where("ttg_post.time BETWEEN '$startDate' AND '$endDate'")
                    ->whereIn('ttg_post.uid', $multiSearch)
                    ->orderBy('ttg_post.id', 'desc')
                    ->findAll();
                // return print_r($manageData);
                // $manageData->findAll();
            } else {
                $manageData = $this->manageDataDb->distinct()
                    ->select($select)
                    ->join('ttg_login', 'ttg_login.id = ttg_post.userid')
                    // ->where('ttg_login.country', $this->client->country)
                    ->whereIn('ttg_post.uid', $multiSearch)
                    ->orderBy('ttg_post.id', 'desc')->findAll();
            }

            foreach ($manageData as $key => $manage) {
                $id = $manage['uid'];
                $popupWindowUrl = base_url(route_to('manage_data_details', base64_encode($id)));
                // $id = $manage['uid'];
                $actionsHtml = '<a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a><a href="javascript:void(0);" class="btn btn-icon" onclick="myFunction(' . "'" . $popupWindowUrl . "'" . ')" title="Share"><em class="icon ni ni-share"></em></a>';

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

            // $country = session()->get('user.country');
            // if ($startDate && $endDate) {
            //     // ->where("ttg_login.country", $country)
            //     $shipmentsData = $this->manageShipDb->distinct()
            //         ->select('ttg_ship.*, ttg_login.country as userCountry')
            //         ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
            //         ->where("ttg_ship.time BETWEEN '$startDate' AND '$endDate'")
            //         ->whereIn('ttg_ship.crn', $multiSearch)
            //         ->orderBy('ttg_ship.id', 'desc')->findAll();
            // } else {
            //     // ->where("ttg_login.country", $country)
            //     $shipmentsData = $this->manageShipDb->distinct()
            //         ->select('ttg_ship.*, ttg_login.country as userCountry')
            //         ->join('ttg_login', 'ttg_login.id = ttg_ship.userid')
            //         ->whereIn('ttg_ship.crn', $multiSearch)
            //         ->orderBy('ttg_ship.id', 'desc')->findAll();
            // }

            // foreach ($shipmentsData as $key => $shipment) {
            //     $id = $shipment['id'];
            //     $popupWindowUrl = base_url(route_to('manage_shipment_details', base64_encode($id)));
            //     $actionsHtml = '<a href="javascript:void(0);" onclick="openPopup(' . "'" . $popupWindowUrl . "'" . ')" class="after_divider btn btn-icon open_new_window" title="View Details"><em class="icon ni ni-eye"></em></a>/<a href="javascript:void(0);" onclick="copyToClipboard(this)" data-copy="' . $popupWindowUrl . '" class="after_divider btn btn-icon" title="Share"><em class="icon ni ni-share"></em></a>';

            //     $shipmentsData[$key]['condition'] = $shipment['box_condition'];
            //     $shipmentsData[$key]['actions'] = $actionsHtml;
            //     if ($shipment['box_condition'] == 'Poor') {
            //         $shipmentsData[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs badge-danger">' . $shipment['box_condition'] . '</span>';
            //     } elseif ($shipment['box_condition'] == 'Fair') {
            //         $shipmentsData[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-warning">' . $shipment['box_condition'] . '</span>';
            //     } elseif ($shipment['box_condition'] == 'Good') {
            //         $shipmentsData[$key]['box_condition'] = '<span class="badge badge-dot badge-dot-xs badge-success">' . $shipment['box_condition'] . '</span>';
            //     } elseif ($shipment['box_condition'] == 'Rejected') {
            //         $shipmentsData[$key]['box_condition'] =  '<span class="badge badge-dot badge-dot-xs">' . $shipment['box_condition'] . '</span>';
            //     }
            //     $shipmentsData[$key]['time'] = '<span>' . date("d M Y, g:s A", $shipment['time']) . '</span>';
            // }


            // return print_r($data);
        }
        $data['manageData'] = $manageData;
        // $data['shipmentsData'] = $shipmentsData;
        return view('Dashboard/Client/asset_search', $data);
    }
}
