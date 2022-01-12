<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('Dashboard/Client/index');
    }
    public function byCrn()
    {
        return view('Dashboard/Client/crn_search');
    }
    public function byAssetId()
    {
        return view('Dashboard/Client/asset_search');
    }
    public function manage_users()
    {
        return view('Dashboard/Client/users');
    }
}
