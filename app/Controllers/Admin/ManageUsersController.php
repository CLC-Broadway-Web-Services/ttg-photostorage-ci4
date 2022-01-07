<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageUserModel;

class ManageUsersController extends BaseController
{

    protected $manageClient;
    protected $manageUser;
    protected $session;

    public function __construct()
    {

        $this->manageClient = new AdminModel();
        $this->manageUser = new ManageUserModel();
        $this->session = session();
    }

    public function manage_client()
    {

        $this->data['manage_client'] = $this->manageClient->where('type', 'client')->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/manage_client', $this->data);
    }

    public function testing_staff()
    {

        $this->data['testing_staff'] = $this->manageClient->where('type', 'staff')->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/testing_staff', $this->data);
    }

    public function edit_testing_staff()
    {
        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageClient->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                return json_encode($this->manageClient->find($getId));
            }

            $testingId = $this->request->getVar('modal_testing_staff_id');
            $testingName = $this->request->getVar('name');
            $testingEmail = $this->request->getVar('email');
            $testingMobile = $this->request->getVar('mobile');
            $testingCountry = $this->request->getVar('country');
            $testingPassword = $this->request->getVar('pass');
            // return print_r($clientPassword);
            // $this->clientDb = new AdminModel();
            $testingData = [
                'name' => $testingName,
                'email' => $testingEmail,
                'time' => time(),
                'mobile' => $testingMobile,
                'country' => $testingCountry,
                'type' => 'staff',
            ];

            if ($testingPassword) {
                $testingData['pass'] = $testingPassword;
            }

            if ($testingId > 0) {

                $testingData['id'] = $testingId;
            } else {
                // new client here
                // $check = $this->clientDb->where('email', $clientEmail)->first();
                // if ($check) {
                //     return redirect()->route('manage_client')->with('error', 'email exist');
                // }
                if (isset($testingData['id'])) {
                    unset($testingData['id']);
                }
            }
            // return print_r($clientData);
            $saveQuery = $this->manageClient->save($testingData);

            if ($saveQuery) {
                $this->session->setFlashdata("success", "This is success message");
                return redirect()->route('testing_staff');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }

    public function shipping_satff()
    {

        $this->data['shipping_staff'] = $this->manageClient->where('type', 'ship')->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/shipping_satff', $this->data);
    }

    public function edit_shipping_staff()
    {
        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageClient->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                return json_encode($this->manageClient->find($getId));
            }

            $shippingId = $this->request->getVar('modal_shipping_id');
            $shippingName = $this->request->getVar('name');
            $shippingEmail = $this->request->getVar('email');
            $shippingMobile = $this->request->getVar('mobile');
            $shippingCountry = $this->request->getVar('country');
            $shippingPassword = $this->request->getVar('pass');
            // return print_r($clientPassword);

            // $this->clientDb = new AdminModel();
            $shippingData = [
                'name' => $shippingName,
                'email' => $shippingEmail,
                'time' => time(),
                'mobile' => $shippingMobile,
                'country' => $shippingCountry,
                'type' => 'ship',
            ];
            if ($shippingPassword) {

                $shippingData['pass'] = $shippingPassword;
            }

            if ($shippingId > 0) {

                $shippingData['id'] = $shippingId;
            } else {
                // new client here
                // $check = $this->clientDb->where('email', $clientEmail)->first();
                // if ($check) {
                //     return redirect()->route('manage_client')->with('error', 'email exist');
                // }
                if (isset($shippingData['id'])) {
                    unset($shippingData['id']);
                }
            }
            // return print_r($clientData);
            $saveQuery = $this->manageClient->save($shippingData);

            if ($saveQuery) {
                $this->session->setFlashdata("success", "This is success message");
                return redirect()->route('shipping_satff');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }

    public function manage_admin()
    {
        $this->data['manage_admin'] = $this->manageClient->where('type !=', 'staff')->where('type !=', 'client')->where('type !=', 'ship')->orderBy('id', 'desc')->findAll();
        return view('Dashboard/Admin/manage_admin', $this->data);
    }

    public function edit_manage_admin()
    {
        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageClient->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                return json_encode($this->manageClient->find($getId));
            }

            $adminId = $this->request->getVar('modal_admin_id');
            $adminName = $this->request->getVar('name');
            $adminEmail = $this->request->getVar('email');
            $adminMobile = $this->request->getVar('mobile');
            $adminCountry = $this->request->getVar('country');
            $adminPassword = $this->request->getVar('pass');
            // return print_r($clientPassword);

            // $this->clientDb = new AdminModel();
            $adminData = [
                'name' => $adminName,
                'email' => $adminEmail,
                'time' => time(),
                'mobile' => $adminMobile,
                'country' => $adminCountry,
                'type' => 'admin',
            ];
            if ($adminPassword) {

                $adminData['pass'] = $adminPassword;
            }

            if ($adminId > 0) {

                $adminData['id'] = $adminId;
            } else {
                // new client here
                // $check = $this->clientDb->where('email', $clientEmail)->first();
                // if ($check) {
                //     return redirect()->route('manage_client')->with('error', 'email exist');
                // }
                if (isset($adminData['id'])) {
                    unset($adminData['id']);
                }
            }
            // return print_r($clientData);
            $saveQuery = $this->manageClient->save($adminData);

            if ($saveQuery) {
                $this->session->setFlashdata("success", "This is success message");
                return redirect()->route('manage_admin');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }


    public function creat_user()
    {
        $this->data['manage_user'] = $this->manageUser->orderBy('adduserID ', 'desc')->findAll(100);
        return view('Dashboard/Admin/creat_user', $this->data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->manageUser->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                return json_encode($this->manageUser->find($getId));
            }

            $createUserId = $this->request->getVar('modal_create_user_id');
            $createUserUserName = $this->request->getVar('username');
            $createUserName = $this->request->getVar('name');
            $createUserEmail = $this->request->getVar('email');
            $createUserMobile = $this->request->getVar('mobile');
            $createUserCountry = $this->request->getVar('country');
            $createUserPassword = $this->request->getVar('password');
            // return print_r($clientPassword);

            // $this->clientDb = new AdminModel();
            $createUserData = [
                'name' => $createUserName,
                'username' => $createUserUserName,
                'email' => $createUserEmail,
                'created_date' => time(),
                'mobile' => $createUserMobile,
                'country' => $createUserCountry,
                'type' => 'client',
            ];
            if ($createUserPassword) {

                $createUserData['password'] = $createUserPassword;
            }

            if ($createUserId > 0) {

                $createUserData['adduserID'] = $createUserId;
            } else {
                // new client here
                // $check = $this->clientDb->where('email', $clientEmail)->first();
                // if ($check) {
                //     return redirect()->route('manage_client')->with('error', 'email exist');
                // }
                if (isset($createUserData['adduserID'])) {
                    unset($createUserData['adduserID']);
                }
            }
            // return print_r($createUserData);
            $saveQuery = $this->manageUser->save($createUserData);

            if ($saveQuery) {
                $this->session->setFlashdata("success", "This is success message");
                return redirect()->route('creat_user');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }
}
