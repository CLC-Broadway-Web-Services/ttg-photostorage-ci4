<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\CrnModel;
use App\Models\Admin\ManageUserModel;

class ManageUsersController extends BaseController
{
    protected $userMd;
    protected $manageUser;
    protected $session;
    protected $crnAssign;
    protected $validation;

    public function __construct()
    {

        $this->userMd = new AdminModel();
        $this->manageUser = new ManageUserModel();
        $this->session = session();
        $this->crnAssign = new CrnModel();
        $this->validation =  \Config\Services::validation();
    }

    public function manage_client()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['manage_client'] = $this->userMd->where('type', 'client')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['manage_client'] = $this->userMd->where('type', 'client')->orderBy('id', 'desc')->findAll();
        }

        if ($this->request->getVar('delete')) {
            $getId = $this->request->getVar('id');
            return $this->userMd->delete($getId);
        }

        if ($this->request->getVar('assign')) {
            $getId = $this->request->getVar('id');
            $new_crn = $this->request->getVar('superheroAlias');
            $crnData = [
                'crn' => $new_crn,
                'userid' => $getId,
                'time' => time(),
            ];
            //   return print_r(json_encode($crnData));
            $this->crnAssign->save($crnData);
            $assi = $this->crnAssign->where('userid', $getId)->find();
            return print_r(json_encode($assi));
            // return json_encode(array_merge($assignedCrn,$assi));
            // if ($assignedCrn) {
            //     $this->session->setFlashdata("success", "This is success message");
            //     return redirect()->route('manage_client');
            // }
        }

        if ($this->request->getVar('edit')) {
            $getId = $this->request->getVar('id');
            return json_encode($this->userMd->find($getId));
        }

        if ($this->request->getVar('add_client')) {
            $clientData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                'crn_status' => $this->request->getVar('crn_status') ? $this->request->getVar('crn_status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'status' => $this->request->getVar('status'),
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveClient = $this->createUser($clientData, 'client', intval($this->request->getVar('client_id')));
            // session()->set('clientsave', $saveClient);
            // return print_r($clientData);
            session()->set('clientsave', $saveClient);
            // session()->set('clientsaveMessage', $saveClient['message']);
            return redirect()->route('manage_client');
        }

        return view('Dashboard/Admin/manage_client', $this->data);
    }

    public function testing_staff()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['testing_staff'] = $this->userMd->where('type', 'staff')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['testing_staff'] = $this->userMd->where('type', 'staff')->orderBy('id', 'desc')->findAll();
        }

        if ($this->request->getVar('edit')) {
            $getId = $this->request->getVar('id');
            return json_encode($this->userMd->find($getId));
        }
        if ($this->request->getVar('add_testing_staff')) {
            $userData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                'status' => $this->request->getVar('status') ? $this->request->getVar('status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveUser = $this->createUser($userData, 'staff', intval($this->request->getVar('modal_testing_staff_id')));
            session()->set('staffsave', $saveUser);
            return redirect()->route('testing_staff');
        }
        return view('Dashboard/Admin/testing_staff', $this->data);
    }

    public function shipping_staff()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['shipping_staff'] = $this->userMd->where('type', 'ship')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['shipping_staff'] = $this->userMd->where('type', 'ship')->orderBy('id', 'desc')->findAll();
        }

        if ($this->request->getVar('edit')) {
            $getId = $this->request->getVar('id');
            return json_encode($this->userMd->find($getId));
        }
        if ($this->request->getVar('add_shipping_staff')) {
            $userData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                'status' => $this->request->getVar('status') ? $this->request->getVar('status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveUser = $this->createUser($userData, 'ship', intval($this->request->getVar('modal_shipping_id')));
            session()->set('shippingsave', $saveUser);
            return redirect()->route('shipping_staff');
        }
        return view('Dashboard/Admin/shipping_staff', $this->data);
    }

    public function manage_admin()
    {
        if (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            $this->data['manage_admin'] = $this->userMd->where('country', $country)->where('type', 'admin')->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['manage_admin'] = $this->userMd->where('type', 'admin')->orderBy('id', 'desc')->findAll();
        }

        if ($this->request->getVar('edit')) {
            $getId = $this->request->getVar('id');
            return json_encode($this->userMd->find($getId));
        }
        if ($this->request->getVar('add_admin')) {
            $userData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                'status' => $this->request->getVar('status') ? $this->request->getVar('status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveUser = $this->createUser($userData, 'admin', intval($this->request->getVar('modal_admin_id')));
            session()->set('adminsave', $saveUser);
            return redirect()->route('manage_admin');
        }
        return view('Dashboard/Admin/manage_admin', $this->data);
    }

    public function creat_user()
    {

        // return print_r(getCountriesListCodes());
        if (session()->get('loginType') == 'client' && session()->get('user.crn_status') != 'super') {
            return redirect()->route('client_index');
        }
        $layout = 'layout';
        if (session()->get('loginType') != 'superadmin') {
            $country = session()->get('user.country');
            $this->data['manage_user'] = $this->userMd->where('type', 'guest')->where('country', $country)->orderBy('id', 'desc')->findAll();
        } else {
            $this->data['manage_user'] = $this->userMd->where('type', 'guest')->orderBy('id', 'desc')->findAll();
        }
        if (session()->get('loginType') == 'admin') {
            $layout = 'layout';
        } elseif (session()->get('loginType') == 'client') {
            $layout = 'clientlayout';
        }
        $this->data['layout'] = $layout;

        if ($this->request->getVar('delete')) {
            $getId = $this->request->getVar('id');
            return $this->userMd->delete($getId);
        }

        if ($this->request->getVar('edit')) {
            $getId = $this->request->getVar('id');
            return json_encode($this->userMd->find($getId));
        }
        if ($this->request->getVar('add_guest_user')) {
            $userData = [
                'name' => $this->request->getVar('name') ? $this->request->getVar('name') : NULL,
                'email' => $this->request->getVar('email') ? $this->request->getVar('email') : NULL,
                'mobile' => $this->request->getVar('mobile') ? $this->request->getVar('mobile') : NULL,
                'country' => $this->request->getVar('country') ? $this->request->getVar('country') : NULL,
                'status' => $this->request->getVar('status') ? $this->request->getVar('status') : NULL,
                'pass' => $this->request->getVar('pass') ? $this->request->getVar('pass') : NULL,
                'profile_pic' => $this->request->getFile('profile_pic')
            ];
            $saveUser = $this->createUser($userData, 'guest', intval($this->request->getVar('modal_create_user_id')));
            session()->set('guestsave', $saveUser);
            return redirect()->route('creat_user');
        }

        $guestCounts = $this->userMd->where('type', 'guest')->countAllResults();
        $new_username = 'ttg-000001';
        if ($guestCounts > 0) {
            $lastGuest = $this->userMd->where('type', 'guest')->orderBy('id', 'desc')->first();
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
        return view('Dashboard/Admin/creat_user', $this->data);
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
            // if ($data['status'] && intval($data['status']) != intval($user['status'])) {
                $clientData['status'] = $data['status'];
            // } else {
            //     unset($clientData['status']);
            // }
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

        return $response;
    }
}
