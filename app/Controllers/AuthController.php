<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin\ActivityLogModel;
use App\Models\Admin\AdminModel;

class AuthController extends BaseController
{
    public function index()
    {
        // return print_r(create_dates());

        $userDb = new AdminModel();
        // $userDb->createDeveloperAccount();
        if ($this->request->getMethod() == 'post') {
            $userEmail = $this->request->getVar('email');
            $userPassword = $this->request->getVar('password');

            $getUser = $userDb->where('email', $userEmail)->first();
            $response = ['success' => false, 'message' => ''];

            if (password_verify($userPassword, $getUser['pass'])) {
                // return print_r($getUser);
                unset($getUser['pass']);
                unset($getUser['token']);
                // return print_r($getUser);

                $sessionData['userLoggedIn'] = true;
                $sessionData['loginType'] = $getUser['type'];
                $sessionData['user'] = $getUser;
                session()->set($sessionData);

                if ($getUser['type'] == 'client') {
                    return redirect()->route('client_index');
                }
                return redirect()->route('admin_index');
            } else {
                $sessionData = [
                    'loginError' => 'Credentials not matched'
                ];
                session()->set($sessionData);
                return redirect()->back();
                // return print_r('not match');
                $response['message'] = 'Password or email not matched.';
            }
        }
        return view('Auth/index');
    }
    public function login_guest()
    {

        return print_r($_SERVER);
        if ($this->request->getMethod() == 'post') {

            $userEmail = $this->request->getVar('email');
            $userPassword = $this->request->getVar('password');

            $userDb = new AdminModel();
            $getUser = $userDb->where('email', $userEmail)->first();
            $response = ['success' => false, 'message' => ''];

            if (password_verify($userPassword, $getUser['pass'])) {
                // return print_r($getUser);
                unset($getUser['pass']);
                unset($getUser['token']);
                // return print_r($getUser);

                $sessionData['userLoggedIn'] = true;
                $sessionData['loginType'] = $getUser['type'];
                $sessionData['user'] = $getUser;
                session()->set($sessionData);

                if ($getUser['type'] == 'client') {
                    return redirect()->route('client_index');
                }
                return redirect()->route('admin_index');
            } else {
                return print_r('not match');
                $response['message'] = 'Password or email not matched.';
            }
        }
        return view('Auth/guest_login');
    }
    public function client()
    {
        if ($this->request->getMethod() == 'post') {

            $userEmail = $this->request->getVar('email');
            $userPassword = $this->request->getVar('password');

            $userDb = new AdminModel();
            $getUser = $userDb->where('email', $userEmail)->first();
            // return print_r($getUser);
            $response = ['success' => false, 'message' => ''];
        }
        return view('Auth/index');
    }
    public function logout()
    {
        session()->destroy();
        // echo 'session destroyed';
        // return;
        return redirect()->route('login');
    }
    public function forget_password()
    {
        return view('Auth/forget_password');
    }
    public function currentUserProfile()
    {
        $data = [];
        $layout = 'layout';
        if (session()->get('loginType') == 'client') {
            $layout = 'clientlayout';
        }

        $data['layout'] = $layout;
        $userMd = new AdminModel();
        $user = $userMd->getCurrentUser();
        $data['user'] = $user;

        $activityModel = new ActivityLogModel();

        $data['activity'] = $activityModel->where('userid', $user['id'])->orderBy('id', 'desc')->first();
        $data['lastpass'] = $userMd->getLastPasswordUpdate();

        if ($this->request->getVar('draw')) {
            $activityData = array();
            $count = 0;
            $params['draw'] = $_REQUEST['draw'];
            $start = $_REQUEST['start'];
            $length = $_REQUEST['length'];
            $search_value = $_REQUEST['search']['value'] ? $_REQUEST['search']['value'] : '';
            if (!empty($search_value)) {
                $activityData = $activityModel->where('userid', $user['id'])->like('datauid', $search_value)->orderBy('id', 'desc')->offset($start)->findAll($length);
                $count = $activityModel->where('userid', $user['id'])->like('datauid', $search_value)->orderBy('id', 'desc')->countAllResults();
            } else {
                $activityData = $activityModel->where('userid', $user['id'])->orderBy('id', 'desc')->offset($start)->findAll($length);
                $count = $activityModel->where('userid', $user['id'])->orderBy('id', 'desc')->countAllResults();
            }
            foreach ($activityData as $key => $value) {
                // $activityData[$key]['time'] = date("d M Y, g:s A", $value['time']);
                $assetId = !empty($value['datauid']) ? ' on <b>' . strtoupper($value['datauid']) . '</b>' : '';
                $activityData[$key]['event'] = ucfirst($value['event']) . $assetId;
                $activityData[$key]['ipaddress'] = '<span class="sub-text">' . $value['ipaddress'] . '</span>';
                $activityData[$key]['time'] = '<span class="sub-text">' . date("M d, Y", $value['time']) . ' <span class="d-none d-sm-inline-block">' . date("g:s A", $value['time']) . '</span></span>';
                $activityData[$key]['device'] = '<span class="sub-text">' . ucfirst($value['device']) . '</span>';
            }
            $json_data = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $activityData   // total data array
            );

            return json_encode($json_data);
        }
        $response = ['success' => false];
        if ($this->request->getVar('old_password') && $this->request->getVar('new_password')) {
            // passwordHash
            $oldpasswordMatched = true;
            $newPasswordVerify = true;
            // $oldpasswordMatched = true;
            if (!password_verify($this->request->getVar('old_password'), $user['pass'])) {
                $oldpasswordMatched = false;
                $response['message'] = 'Old password not matched.';
            }
            if (password_verify($this->request->getVar('new_password'), $user['pass'])) {
                $newPasswordVerify = false;
                $response['message'] = 'Your password is same as old password, please use different password.';
            }
            $pass = passwordHash($this->request->getVar('new_password'));
            if ($oldpasswordMatched && $newPasswordVerify) {
                $savePass = $userMd->save(['id' => $user['id'], 'pass' => $pass]);
                if ($savePass) {
                    $userMd->createPasswordUpdate();
                    $response['success'] = true;
                    $response['message'] = 'Password changed successfully.';
                } else {
                    $response['message'] = $userMd->errors();
                }
            } else {
                $response['message'] = 'another issue found';
                $response['oldpasswordMatched'] = $oldpasswordMatched;
                $response['newPasswordVerify'] = $newPasswordVerify;
                if (!$oldpasswordMatched) {
                    $response['message'] = 'Old password not matched.';
                }
                if (!$newPasswordVerify) {
                    $response['message'] = 'Your password is same as old password, please use different password.';
                }
            }
            return json_encode($response);
        }
        if ($this->request->getVar('full_name') && $this->request->getVar('user_mobile')) {
            $profileData['id'] = $user['id'];
            $profileData['name'] = $this->request->getVar('full_name') ? $this->request->getVar('full_name') : $user['name'];
            if (!empty($this->request->getVar('user_mobile')) && $this->request->getVar('user_mobile') != $user['mobile']) {
                $profileData['mobile'] = $this->request->getVar('user_mobile');
            }
            if ($userMd->save($profileData)) {
                $response['success'] = true;
                $response['message'] = 'Profile updated successfully.';
                $getUser = $userMd->find($user['id']);
                unset($getUser['pass']);
                unset($getUser['token']);
                $sessionData['user'] = $getUser;
                session()->set($sessionData);
            } else {
                $response['success'] = false;
                $response['message'] = $userMd->error();
            }
            return json_encode($response);
        }
        if ($this->request->getVar('old_password')) {
            // return json_encode($this->request->getVar());
            return json_encode(password_verify($this->request->getVar('old_password'), $user['pass']));
        }
        if ($this->request->getFile('user_avatar')) {
            // return json_encode($this->request->getVar());
            $img = $this->request->getFile('user_avatar');
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move('uploads/profile_pic', $newName);
                $imgUrl = '/uploads/profile_pic/' . $newName;
                $savePass = $userMd->save(['id' => $user['id'], 'profile_pic' => $imgUrl]);
                if ($savePass) {
                    // $userMd->createPasswordUpdate();
                    $response['success'] = true;
                    $response['message'] = 'Profile pic upload successfully.';
                } else {
                    $response['message'] = $userMd->errors();
                }
            } else {
                $response['message'] = 'Try uploading image after some time.';
            }
            return json_encode($response);
        }
        return view('Dashboard/userProfile', $data);
    }
}
