<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ActivityLogModel;
use App\Models\Admin\ObjectionsModel;

class ReportsController extends BaseController
{
    protected $activityLogs;
    protected $performanceReport;

    public function __construct()
    {

        $this->activityLogs = new ActivityLogModel();
        $this->performanceReport = new ObjectionsModel();
    }

    public function activity_logs()
    {
        if ($this->request->getMethod() == 'post') {
            $activityData = array();
            $count = 0;
            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search_value = $_REQUEST['search']['value'] ? $_REQUEST['search']['value'] : '';
            if (!empty($search_value)) {
                if (session()->get('loginType') == 'admin') {
                    $country = session()->get('user.country');
                    $activityData = $this->activityLogs
                        ->where("country", $country)
                        ->like('datauid', $search_value)
                        ->orderBy('id', 'desc')->offset($start)->findAll($length);
                    $count = $this->activityLogs
                        ->where("country", $country)
                        ->like('datauid', $search_value)
                        ->orderBy('id', 'desc')->countAllResults();

                    // $this->data['activity_logs'] = $this->activityLogs->where('country', $country)->orderBy('id', 'desc')->findAll();
                } else {
                    // $this->data['activity_logs'] = $this->activityLogs->orderBy('id', 'desc')->findAll(50);
                    $activityData = $this->activityLogs
                        ->like('datauid', $search_value)
                        ->orderBy('id', 'desc')->offset($start)->findAll($length);
                    $count = $this->activityLogs
                        ->like('datauid', $search_value)
                        ->orderBy('id', 'desc')->countAllResults();
                }
            } else {
                if (session()->get('loginType') == 'admin') {
                    $country = session()->get('user.country');
                    $activityData = $this->activityLogs
                        ->where("country", $country)
                        ->orderBy('id', 'desc')->offset($start)->findAll($length);
                    $count = $this->activityLogs
                        ->where("country", $country)
                        ->orderBy('id', 'desc')->countAllResults();

                    // $this->data['activity_logs'] = $this->activityLogs->where('country', $country)->orderBy('id', 'desc')->findAll();
                } else {
                    // $this->data['activity_logs'] = $this->activityLogs->orderBy('id', 'desc')->findAll(50);
                    $activityData = $this->activityLogs
                        ->orderBy('id', 'desc')->offset($start)->findAll($length);
                    $count = $this->activityLogs
                        ->orderBy('id', 'desc')->countAllResults();
                }
            }
            foreach ($activityData as $key => $value) {
                $activityData[$key]['time'] = date("d M Y, g:s A", $value['time']);
            }
            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $activityData   // total data array
            );

            return json_encode($json_data);
        }
        return view('Dashboard/Admin/activity_logs', $this->data);
    }

    public function performance_report()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['dataper'] = $this->performanceReport->distinct()
                ->select('ttg_objections.*, ttg_login.type, ttg_login.id, ttg_login.name, ttg_login.email, ttg_login.country as userCountry')
                ->join('ttg_login', 'ttg_login.id = ttg_objections.userid')
                ->orderBy('ttg_objections.id', 'desc')->findAll();
        } else {
            $this->data['dataper'] = $this->performanceReport->distinct()
                ->select('ttg_objections.*, ttg_login.type, ttg_login.id, ttg_login.name, ttg_login.email, ttg_login.country as userCountry')
                ->join('ttg_login', 'ttg_login.id = ttg_objections.userid')
                ->orderBy('ttg_objections.id', 'desc')->findAll();
        }

        // $this->data['performance_report'] = $this->performanceReport->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/performance_report', $this->data);
    }
}
