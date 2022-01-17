<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;

class AuthController extends BaseController
{
    public function index()
    {
        // return print_r(create_dates());

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
}
