<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageUserModel;

class ManageUsersController extends BaseController
{
    protected $client;
    protected $manageClient;
    protected $manageUser;
    protected $session;

    public function __construct()
    {
        $this->client = (object) session()->get('user');
        $this->manageClient = new AdminModel();
        $this->manageUser = new ManageUserModel();
        $this->session = session();
        if($this->client->crn_status != 'super'){
            return redirect()->route('client_index');
            exit;
        }
    }

    public function creat_user()
    {
        if(session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['manage_user'] = $this->manageClient->where('type', 'guest')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['manage_user'] = $this->manageClient->where('type', 'guest')->orderBy('id', 'desc')->findAll();
        }
        $guestCounts = $this->manageClient->where('type', 'guest')->countAllResults();
        $new_username = 'ttg-000001';
        if ($guestCounts > 0) {
            $lastGuest = $this->manageClient->where('type', 'guest')->orderBy('id', 'desc')->first();
            $lastGuestNumber = str_replace('ttg-', '', $lastGuest['username']);
            // return print_r($lastGuest);
            if ($lastGuestNumber < 10) {
                $new_username = 'ttg-00000' . intval(intval($lastGuestNumber) + 1);
            }
            if ($lastGuestNumber > 9) {
                $new_username = 'ttg-0000' . intval(intval($lastGuestNumber) + 1);
            }
            if ($lastGuestNumber > 99) {
                $new_username = 'ttg-000' . intval(intval($lastGuestNumber) + 1);
            }
            if ($lastGuestNumber > 999) {
                $new_username = 'ttg-00' . intval(intval($lastGuestNumber) + 1);
            }
            if ($lastGuestNumber > 9999) {
                $new_username = 'ttg-0' . intval(intval($lastGuestNumber) + 1);
            }
            if ($lastGuestNumber > 99999) {
                $new_username = 'ttg-' . intval(intval($lastGuestNumber) + 1);
            }
        }
        $this->data['new_username'] = $new_username;
        return view('Dashboard/Client/create_user', $this->data);
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
                return redirect()->route('client_creat_user');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }
    public function edit_manage_user()
    {
        if ($this->request->getMethod() == 'post') {

            // return print_r($this->request->getVar());

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
            $username = $this->request->getVar('username');
            $adminPassword = $this->request->getVar('pass') ? passwordHash($this->request->getVar('pass')) : NULL;

            // $this->clientDb = new AdminModel();
            $adminData = [
                'name' => $adminName,
                'email' => $adminEmail,
                'time' => time(),
                'mobile' => $adminMobile,
                'country' => $adminCountry,
                'username' => $username,
                'type' => 'guest',
                'creator_id' => session()->get('user.id')
            ];
            if ($adminPassword) {
                $adminData['pass'] = $adminPassword;
            }

            if ($adminId > 0) {
                $adminData['id'] = $adminId;
            } else {
                if (isset($adminData['id'])) {
                    unset($adminData['id']);
                }
            }
            // return print_r($clientData);
            $saveQuery = $this->manageClient->save($adminData);

            if ($saveQuery) {
                $this->session->setFlashdata("success", "This is success message");
            } else {
                $this->session->setFlashdata("error", "Unable to save user.");
            }
            return redirect()->route('client_creat_user');
        }
    }
}
