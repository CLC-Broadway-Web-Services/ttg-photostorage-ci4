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
        $dataArray = array();
        $lastMonthLastDay = date('Y-m-d', strtotime("last day of previous month"));
        $last_month_day = strtotime($lastMonthLastDay);
        $lastMonthFirstDay = date('Y-m-d', strtotime("first day of previous month"));
        $last_month_first_day = strtotime($lastMonthFirstDay);

        // SHIPMENTS DATA
        $shipMd = new ManageShipmentModel();
        $shipment_data['total'] = $shipMd->countAll();
        $shipmentsLastMonth = $shipMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
        $shipmentsCurrentMonth = $shipMd->where(['time >' => $last_month_day])->countAllResults();

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

        $dataArray['shipments'] = $shipment_data;

        // CRNS DATA
        $postMd = new PostsModel();
        $crn_data['total'] = $postMd->groupBy('crn')->countAllResults();
        $crnLastMonth = $postMd->groupBy('crn')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
        $crnCurrentMonth = $postMd->groupBy('crn')->where(['time >' => $last_month_day])->countAllResults();

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

        $dataArray['crns'] = $crn_data;

        // ASSETS DATA
        $filesMd = new FilesModel();
        $assets_data['total'] = $filesMd->groupBy('uid')->countAllResults();

        $assetLastMonth = $filesMd->groupBy('uid')->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
        $assetCurrentMonth = $filesMd->groupBy('uid')->where(['time >' => $last_month_day])->countAllResults();

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

        $dataArray['assets'] = $assets_data;

        // CLIENTS DATA
        $clientsMd = new AdminModel();
        $clients_data['total'] = $clientsMd->where('type', 'client')->countAllResults();
        $clientsLastMonth = $clientsMd->where(['time >=' => $last_month_first_day, 'time <=' => $last_month_day])->countAllResults();
        $clientsCurrentMonth = $clientsMd->where(['time >' => $last_month_day])->countAllResults();

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


        $dataArray['clients'] = $clients_data;


        // $postdata = $postMd->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);

        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $postMd->save($data);
        // }

        // return print_r($dataArray);
        return view('Dashboard/Admin/index', $dataArray);
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
