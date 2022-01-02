<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageUserModel;

class ManageUsersController extends BaseController
{

    protected $manageClient;
    protected $manageUser;

    public function __construct()
    {

        $this->manageClient = new AdminModel();
        $this->manageUser = new ManageUserModel();
        
    }

    public function manage_client()
    {
        
        $this->data['manage_client'] = $this->manageClient->orderBy('id', 'desc')->findAll(100);
        return view('Dashboard/Admin/manage_client', $this->data);
    }

    public function testing_staff()
    {

        $this->data['testing_staff'] = $this->manageClient->orderBy('id', 'desc')->findAll(100);
        return view('Dashboard/Admin/testing_staff', $this->data);
    }

    public function shipping_satff()
    {

        $this->data['shipping_staff'] = $this->manageClient->orderBy('id', 'desc')->findAll(100);
        return view('Dashboard/Admin/shipping_satff', $this->data);
    }

    public function manage_admin()
    {
        $this->data['manage_admin'] = $this->manageClient->orderBy('id', 'desc')->findAll(100);
        return view('Dashboard/Admin/manage_admin', $this->data);
    }
  

    public function creat_user()
    {
        $this->data['manage_user'] = $this->manageUser->orderBy('adduserID ', 'desc')->findAll(100);
        return view('Dashboard/Admin/creat_user', $this->data);
    }
}
