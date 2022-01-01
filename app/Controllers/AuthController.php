<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;

class AuthController extends BaseController
{
    public function index()
    {
       
        if ($this->request->getMethod() == 'post') {
         
            $userEmail = $this->request->getVar('email');
            $userPassword = $this->request->getVar('password');
            
            $userDb = new AdminModel();
            $getUser = $userDb->where('email', $userEmail)->first();
            $response = ['success' => false, 'message' => ''];
        
            if ($getUser) {

                if ($getUser['pass'] == $userPassword) {
                    unset($getUser['pass']);
                    unset($getUser['token']);
                    // return print_r($getUser);
                    
                    $data['adminLoggedIn'] = true;
                    $data['user'] = $getUser;
                    session()->set($data);
                    return redirect()->route('admin_index');
                } else {
                    // return print_r('not match');
                    $response['message'] = 'Password or email not matched.';
                }
            }else{
                $response['message'] = 'User not found';
            }
        }


        return view('Auth/index');
    }

    public function logout(){
        session()->destroy();
        return redirect()->route('login');
    }
    public function forget_password()
    {
        return view('Auth/forget_password');
    }
}
