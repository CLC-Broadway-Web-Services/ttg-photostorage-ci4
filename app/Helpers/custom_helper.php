<?php

use App\Models\Admin\ActivityLogModel;
use App\Models\Admin\AdminModel;
use App\Models\Admin\CrnModel;
use App\Models\Admin\EmployeModel;
use App\Models\Admin\FilesModel;
use App\Models\Admin\ManageUserModel;
use App\Models\Admin\ObjectionsModel;

if (!function_exists('logout')) {
    function logout()
    {
        return redirect()->route('logout');
    }
}
if (!function_exists('checkUserTypes')) {
    function checkUserTypes($type)
    {
        if (in_array(session()->get('user.type'), $type)) {
            return true;
        }
        logout();
    }
}
if (!function_exists('passwordHash')) {
    function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
if (!function_exists('create_dates')) {
    function create_dates()
    {
        // $db = new ObjectionsModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['datetimes'];
        //     // $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done objection <br>';
        // $db = new AdminModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done admin model <br>';
        // $db = new FilesModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done <br>';
        // $db = new CrnModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done crn <br>';
        // $db = new ActivityLogModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = date('Y-m-d H:s:i', $shipment['time']);
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done activity <br>';
        // $db = new EmployeModel();
        // $postdata = $db->findAll();

        // foreach ($postdata as $key => $shipment) {
        //     $createdAt = $shipment['joiningDate'] . ' 00:00:00';
        //     $data = [
        //         'id' => $shipment['id'],
        //         'created_at' => $createdAt
        //     ];
        //     $db->save($data);
        // }

        // echo 'done employe <br>';
        $db = new ManageUserModel();
        $postdata = $db->findAll();

        foreach ($postdata as $key => $shipment) {
            $createdAt = date('Y-m-d H:s:i', $shipment['created_date']);
            $data = [
                'adduserID' => $shipment['adduserID'],
                'created_at' => $createdAt
            ];
            $db->save($data);
        }

        echo 'done user <br>';
        return;
    }
}
