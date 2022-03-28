<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $country = session()->get('loginType') == 'superadmin' ? null : session()->get('user.country');
        if (session()->get('country') && session()->get('country') != '') {
            $country = session()->get('country');
        }

        // echo json_encode(crn_statistics($country));
        // return;

        if ($this->request->getVar('globalCapabilities')) {
            $globalCapabilities = globalCapabilities();
            // return print_r($globalCapabilities);
            return json_encode($globalCapabilities);
        }

        // SHIPMENT DATA
        $this->data['shipments'] = total_shipments($country);

        // CRNS DATA
        $this->data['crns'] = total_crns($country);

        // ASSETS DATA
        $this->data['assets'] = total_assets($country);

        // CLIENTS DATA
        $this->data['clients'] = total_clients($country);

        // PACKING QUALITY DATA
        $packagin_quality = packagin_quality_chart($country);
        $this->data['packagin_quality'] = $packagin_quality;
        if ($this->request->getVar('packingQualityChartData')) {
            $packagin_quality_names = [];
            $packagin_quality_counts = [];
            $packagin_quality_colors = [];
            foreach ($packagin_quality as $key => $value) {
                array_push($packagin_quality_names, $value['name']);
                array_push($packagin_quality_counts, $value['count']);
                array_push($packagin_quality_colors, $value['color']);
            }
            $packagin_quality_data = [
                'names' => $packagin_quality_names,
                'counts' => $packagin_quality_counts,
                'colors' => $packagin_quality_colors,
            ];

            $this->data['packagin_quality_data'] = $packagin_quality_data;

            return json_encode($packagin_quality_data);
        }
        if ($this->request->getVar('crn_statistics')) {
            $crn_statistics = crn_statistics($country);
            // $this->data['crn_statistics'] = crn_statistics($country);
            return json_encode($crn_statistics);
        }
        if ($this->request->getVar('asset_statistics')) {
            $asset_statistics = asset_statistics($country);
            // $this->data['asset_statistics'] = asset_statistics($country);
            return json_encode($asset_statistics);
        }
        if ($this->request->getVar('shipment_statistics')) {
            $shipment_statistics = shipment_statistics($country);
            // $this->data['shipment_statistics'] = shipment_statistics($country);
            return json_encode($shipment_statistics);
        }

        // return print_r($globalCapabilities);

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
