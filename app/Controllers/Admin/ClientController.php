<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;

class ClientController extends BaseController
{
    protected $clientDb;
    public function index()
    {

        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                $this->clientDb = new AdminModel();
                return $this->clientDb->delete($getId);
            }

            if ($this->request->getVar('edit')) {

                $getId = $this->request->getVar('id');
                $this->clientDb = new AdminModel();
                return $this->clientDb->first($getId);
            }

            $clientName = $this->request->getVar('name');
            $clientEmail = $this->request->getVar('email');
            $clientMobile = $this->request->getVar('mobile');
            $clientCountry = $this->request->getVar('country');
            $clientPassword = $this->request->getVar('pass');
            // return print_r($clientPassword);

            $this->clientDb = new AdminModel();
            $check = $this->clientDb->where('email', $clientEmail)->first();
            // if ($check) {
            //     return redirect()->route('manage_client')->with('error', 'email exist');
            // }
            $clientData = [
                'name' => $clientName,
                'email' => $clientEmail,
                'time' => time(),
                'mobile' => $clientMobile,
                'country' => $clientCountry,
                'pass' => $clientPassword,
                'type' => 'client',
            ];

            $submitClient = $this->clientDb->insert($clientData);
            $response = ['success' => false, 'message' => ''];

            if ($submitClient) {
                // return print_r($submitClient);
                return redirect()->route('manage_client');
            } else {
                $response['message'] = 'User not found';
            }
        }
    }
    public function edit($id)
    {
        // die($id);
        $this->clientDb = new AdminModel();
        $this->data['edit_client'] = $this->clientDb->first($id);
// return print_r($this->data['edit_client'] = $this->clientDb->first($id));
        return view('Dashboard/Admin/manage_client', $this->data);
    }
}
