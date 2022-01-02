<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ActivityLogModel;
use App\Models\Admin\ObjectionsModel;

class ReportsController extends BaseController
{
    protected $activityLogs;
    protected $performanceReport;

    public function __construct(){

        $this->activityLogs = new ActivityLogModel();
        $this->performanceReport = new ObjectionsModel();
    }

    public function activity_logs()
    {
        $this->data['activity_logs'] = $this->activityLogs->orderBy('id', 'desc')->findAll(100);
        return view('Dashboard/Admin/activity_logs', $this->data);
    }

    public function performance_report()
    {

        $this->data['dataper'] = $this->performanceReport->distinct()
                ->select('ttg_objections.*, ttg_login.type, ttg_login.id, ttg_login.name, ttg_login.email, ttg_login.country as userCountry')
                ->join('ttg_login', 'ttg_login.id = ttg_objections.userid')
                ->orderBy('ttg_objections.id', 'desc')->findAll(100);

                
        // $this->data['performance_report'] = $this->performanceReport->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/performance_report', $this->data);
    }
}
