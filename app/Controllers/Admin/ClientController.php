<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\CrnModel;

class ClientController extends BaseController
{
    protected $clientDb;
    protected $session;
    protected $crnAssign;
    public function __construct()
    {
        $this->clientDb = new AdminModel();
        $this->crnAssign = new CrnModel();
        $this->session = session();
    }
    public function index()
    {
        if ($this->request->getMethod() == 'post') {


            if ($this->request->getVar('delete')) {

                $getId = $this->request->getVar('id');
                return $this->clientDb->delete($getId);
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
                return json_encode($this->clientDb->find($getId));
            }

            $clientId = $this->request->getVar('client_id');
            $clientName = $this->request->getVar('name');
            $clientEmail = $this->request->getVar('email');
            $clientMobile = $this->request->getVar('mobile');
            $clientCountry = $this->request->getVar('country');
            $clientPassword = passwordHash($this->request->getVar('pass'));
            $clientCrnStatus = $this->request->getVar('crn_status');
            // return print_r($clientPassword);

            // $this->clientDb = new AdminModel();
            $clientData = [
                'name' => $clientName,
                'email' => $clientEmail,
                'time' => time(),
                'mobile' => $clientMobile,
                'country' => $clientCountry,
                'crn_status' => $clientCrnStatus,
                'type' => 'client',
            ];

            if ($clientPassword) {
                $clientData['pass'] = $clientPassword;
            }

            if ($clientId > 0) {
                $clientData['id'] = $clientId;
            } else {
                if (isset($clientData['id'])) {
                    unset($clientData['id']);
                }
            }
            // return print_r($clientData);
            // $saveQuery = $this->clientDb->save($clientData);

            if ($this->clientDb->save($clientData)) {
                $this->session->setFlashdata("success", "This is success message");
            } else {
                $this->session->setFlashdata("error", json_encode($this->clientDb->errors()));
                // $response['message'] = 'User not found';
            }
            return redirect()->route('manage_client');
        }
    }
    public function getCrn()
    {
    }
}
