<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\FilesModel;
use App\Models\Admin\ManageShipmentModel;
use App\Models\Admin\PostsModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $country = session()->get('loginType') == 'superadmin' ? null : session()->get('user.country');
        // echo json_encode(crn_statistics($country));
        // return;
        // SHIPMENT DATA
        $this->data['shipments'] = total_shipments($country);

        // CRNS DATA
        $this->data['crns'] = total_crns($country);

        // ASSETS DATA
        $this->data['assets'] = total_assets($country);

        // CLIENTS DATA
        $this->data['clients'] = total_clients($country);

        // PACKING QUALITY DATA
        $this->data['packagin_quality'] = packagin_quality_chart($country);
        $packagin_quality_names = [];
        $packagin_quality_counts = [];
        $packagin_quality_colors = [];
        foreach ($this->data['packagin_quality'] as $key => $value) {
            array_push($packagin_quality_names, $value['name']);
            array_push($packagin_quality_counts, $value['count']);
            array_push($packagin_quality_colors, $value['color']);
        }
        $this->data['packagin_quality_data'] = [
            'names' => $packagin_quality_names,
            'counts' => $packagin_quality_counts,
            'colors' => $packagin_quality_colors,
        ];
        $this->data['crn_statistics'] = crn_statistics($country);
        $this->data['asset_statistics'] = asset_statistics($country);
        $this->data['shipment_statistics'] = shipment_statistics($country);
        // return print_r($this->data['packagin_quality_data']);

        // $postdata = $postMd->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);

        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $postMd->save($data);
        // }

        // return print_r($this->data);
        return view('Dashboard/Admin/index', $this->data);
    }
    public function notifications()
    {
        return view('Dashboard/Admin/notifications');
    }
    public function app_chats()
    {
        return view('Dashboard/Admin/app_chats');
    }
}
