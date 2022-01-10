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
            // return print_r($getUser);
            $response = ['success' => false, 'message' => ''];
        
            if ($getUser['type'] == 'superadmin') {

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
            }
            if ($getUser['type'] == 'client') {

                if ($getUser['pass'] == $userPassword) {
                    unset($getUser['pass']);
                    unset($getUser['token']);
                    // return print_r($getUser);
                    
                    $data['adminLoggedIn'] = true;
                    $data['user'] = $getUser;
                    session()->set($data);
                    
                    return redirect()->route('client_index');
                } else {
                    // return print_r('not match');
                    $response['message'] = 'Password or email not matched.';
                }
            }
        }


        return view('Auth/index');
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

    public function logout(){
        session()->destroy();
        return redirect()->route('login');
    }
    public function forget_password()
    {
        return view('Auth/forget_password');
    }
}
