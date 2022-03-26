<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageUserModel;

class ManageUsersController2 extends BaseController
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
        if ($this->client->crn_status != 'super') {
            return redirect()->route('client_index');
            exit;
        }
    }

    public function creat_user()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['manage_user'] = $this->manageClient->where('type', 'guest')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['manage_user'] = $this->manageClient->where('type', 'guest')->orderBy('id', 'desc')->findAll();
        }


        if ($this->request->getVar('add_guest_user')) {
            $userData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                // 'crn_status' => $this->request->getVar('crn_status') ? $this->request->getVar('crn_status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveUser = $this->createUser($userData, 'guest', intval($this->request->getVar('modal_create_user_id')));
            session()->set('guestsave', $saveUser);
            return redirect()->route('creat_user');
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


    private function createUser($data, $type = NULL, $id = 0)
    {
        $response = ['success' => false];
        $clientData = $data;
        $clientData['type'] = $type;
        $clientData['time'] = time();
        $clientData['creator_id'] = session()->get('user.id');
        unset($clientData['pass']);

        $haveProfilePic = false;

        if (isset($data['profile_pic'])) {
            // $validationRules['profile_pic'] = [
            //     'label' => 'Profile picture',
            //     'rules'  => 'max_size[profile_pic,1024]',
            //     'errors' => [
            //         'max_size' => 'Image size should be maximum 1MB or less',
            //     ],
            // ];
            $haveProfilePic = true;
        } else {
            unset($clientData['profile_pic']);
        }
        $email = $this->userMd->where('email', $data['email'])->first();

        if ($id > 0) {
            $user = $this->userMd->find($id);
            if ($email && $data['email'] != $user['email']) {
                // $response['success'] = false;
                $response['message'] = 'This email is already in use, please input another email.';
            } else {
                $response['success'] = true;
                $mobile = $this->userMd->where('mobile', $data['mobile'])->first();
                if ($mobile) {
                    // $response['success'] = false;
                    $response['message'] = 'This mobile number is already in use, please input another mobile number.';
                } else {
                    $response['success'] = true;
                }
            }
            $clientData['id'] = $id;
            if ($data['name'] && $data['name'] != $user['name']) {
                $clientData['name'] = $data['name'];
            } else {
                unset($clientData['name']);
            }
            if ($data['status'] && $data['status'] != $user['status']) {
                $clientData['status'] = $data['status'];
            } else {
                unset($clientData['status']);
            }
            if ($data['email'] && $data['email'] != $user['email']) {
                $clientData['email'] = $data['email'];
            } else {
                unset($clientData['email']);
            }
            if ($data['mobile'] && $data['mobile'] != $user['mobile']) {
                $clientData['mobile'] = $data['mobile'];
            } else {
                unset($clientData['mobile']);
            }
            if ($data['country'] && $data['country'] != $user['country']) {
                $clientData['country'] = $data['country'];
            } else {
                unset($clientData['country']);
            }
            if (isset($data['crn_status']) && $data['crn_status'] != $user['crn_status']) {
                $clientData['crn_status'] = $data['crn_status'];
            } else {
                unset($clientData['crn_status']);
            }
            if ($type && $type != $user['type']) {
                $clientData['type'] = $type;
            } else {
                unset($clientData['type']);
            }
            unset($clientData['time']);
        } else {
            if ($email) {
                // $response['success'] = false;
                $response['message'] = 'This email is already in use, please input another email.';
            } else {
                $response['success'] = true;
                $mobile = $this->userMd->where('mobile', $data['mobile'])->first();
                if ($mobile) {
                    // $response['success'] = false;
                    $response['message'] = 'This mobile number is already in use, please input another mobile number.';
                } else {
                    $response['success'] = true;
                }
            }
        }
        if ($data['pass']) {
            $clientData['pass'] = passwordHash($data['pass']);
        }
        // $this->validation->setRules($validationRules);

        // if (!$this->validation->run($clientData)) {
        // if (!$this->validation->run($clientData)) {
        //     $response['success'] = false;
        //     $response['error_type'] = 'validation';
        //     $response['message'] = $this->validation->listErrors();
        // } else {
        // save data to database
        if ($response['success']) {
            if ($haveProfilePic) {
                $img = $data['profile_pic'];
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('uploads/profile_pic', $newName);
                    $imgUrl = '/uploads/profile_pic/' . $newName;
                    $clientData['profile_pic'] = $imgUrl;
                } else {
                    unset($clientData['profile_pic']);
                }
            } else {
                unset($clientData['profile_pic']);
            }
            if ($this->userMd->save($clientData)) {
                $response['success'] = true;
                $message = $id > 0 ? 'Profile updated successfully.' : ucfirst($type) . ' created successfully.';
                $response['message'] = $message;
            } else {
                $response['success'] = false;
                $response['error_type'] = 'user_model';
                $response['message'] = json_encode($this->userMd->error());
            }
        }
        // }
        // $success = json_encode($response['success']);
        // $response['success'] = $success;

        return $response;
        // return $this->validation->listErrors();
        // return $this->validate($validationRules);

        // $validationRules = [];
        // $this->userMd->setValidationRules($validationRules);
    }
}
