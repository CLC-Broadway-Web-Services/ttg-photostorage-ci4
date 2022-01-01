<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    // public function __construct()
    // {
    //     $session = session();
    //     print_r($session->get('user'));
    //     return;
    //     if($session->get('user.type') != 'ahtesham') {
    //         return redirect()->route('logout');
    //     }
    // }
    public function index()
    {
        
        return view('Dashboard/Admin/index');
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
