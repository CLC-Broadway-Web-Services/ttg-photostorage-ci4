<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;

class ClientController extends BaseController
{
    protected $clientDb;
    public function __construct()
    {
        $this->clientDb = new AdminModel();
    }
    public function index()
    {

        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->clientDb->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                return json_encode($this->clientDb->find($getId));
            }

            $clientId = $this->request->getVar('client_id');
            $clientName = $this->request->getVar('name');
            $clientEmail = $this->request->getVar('email');
            $clientMobile = $this->request->getVar('mobile');
            $clientCountry = $this->request->getVar('country');
            $clientPassword = $this->request->getVar('pass');
            // return print_r($clientPassword);

            // $this->clientDb = new AdminModel();
            $clientData = [
                'name' => $clientName,
                'email' => $clientEmail,
                'time' => time(),
                'mobile' => $clientMobile,
                'country' => $clientCountry,
                'type' => 'client',
            ];

            if($clientPassword) {
                $clientData['pass'] = $clientPassword;
            }

            if($clientId > 0) {
                $clientData['id'] = $clientId;
            } else{
                // new client here
                // $check = $this->clientDb->where('email', $clientEmail)->first();
                // if ($check) {
                //     return redirect()->route('manage_client')->with('error', 'email exist');
                // }
                if(isset($clientData['id'])) {
                    unset($clientData['id']);
                }
            }
            // return print_r($clientData);
            $saveQuery = $this->clientDb->save($clientData);
  
            if ($saveQuery) {
                
                return redirect()->route('manage_client');
            } else {
                $response['message'] = 'User not found';
            }

            // if ($clientId == 0) {
            //     $submitClient = $this->clientDb->insert($clientData);
            //     $response = ['success' => false, 'message' => ''];

            //     if ($submitClient) {
            //         // return print_r($submitClient);
            //         return redirect()->route('manage_client');
            //     } else {
            //         $response['message'] = 'User not found';
            //     }
            // } else {
            //     $updateClient = $this->clientDb->where('id', $clientId)->update($clientData);
            //     $response = ['success' => false, 'message' => ''];

            //     if ($updateClient) {
            //         // return print_r($submitClient);
            //         return redirect()->route('manage_client');
            //     } else {
            //         $response['message'] = 'User not found';
            //     }
            // }
        }
    }
}
