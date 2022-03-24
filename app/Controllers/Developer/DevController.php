<?php

namespace App\Controllers\Developer;

use App\Controllers\BaseController;
use App\Models\Admin\PostsModel;
use App\Models\Common\Defectanalysis;

class DevController extends BaseController
{
    public function index()
    {
        if (session()->get('user.crn_status') != 'developer') {
            return redirect()->round('admin_index');
        }
        $data = array();

        $data['page'] = 'devindex';

        if ($this->request->getVar('typeOfRequest')) {
            $requestType = $this->request->getVar('typeOfRequest');
            if ($requestType == 'migrateDefectAnalysis') {
                return json_encode($this->migrateDefectAnalysis());
            }
            if ($requestType == 'cleanPostTableValues') {
                return json_encode($this->cleanPostTableValues());
            }
        }

        return view('Developer/devindex', $data);
    }
    private function migrateDefectAnalysis()
    {
        $postMd = new PostsModel();
        $defectMd = new Defectanalysis();
        $defectAnalysisData = $postMd->select('userid, crn, uid, time, device_type, defect')->orderBy('id', 'asc')->findAll();

        foreach ($defectAnalysisData as $key => $data) {
            $defects = explode(',', $data['defect']);
            foreach ($defects as $defectKey => $thisDefect) {
                $defectValue = trim($thisDefect);
                $defectData = [
                    'staff_id' => $data['userid'],
                    'crn' => $data['crn'],
                    'asset_id' => $data['uid'],
                    'time' => $data['time'],
                    'device_type' => $data['device_type'],
                    'defect' => $defectValue,
                    // 'created_at' => date('Y-m-d H:i:s', $data['time'])
                ];
                if (!$defectMd->where($defectData)->first() && !empty($defectValue) && $defectValue != 0 && $defectValue != '0') {
                    $defectData['created_at'] = date('Y-m-d H:i:s', $data['time']);
                    $defectMd->save($defectData);
                }
            }
        }
        return true;
    }
    private function cleanPostTableValues()
    {
        $postMd = new PostsModel();
        $allPostData = $postMd->where('defect', '0')->findAll();
        foreach ($allPostData as $data) {
            $postData = $data;
            $postdata['defect'] = NULL;
            $postMd->save($postData);
        }
        $allPostData = $postMd->where('defect', '')->findAll();
        foreach ($allPostData as $data) {
            $postData = $data;
            $postdata['defect'] = NULL;
            $postMd->save($postData);
        }
        $allPostData = $postMd->where('device_type', '')->findAll();
        foreach ($allPostData as $data) {
            $postData = $data;
            $postdata['device_type'] = NULL;
            $postMd->save($postData);
        }
        // $devices = ['Desktop', 'Notebook', 'Other Device'];
        // $allPostData = $postMd->whereIn('device_type', $devices)->findAll();
        // foreach ($allPostData as $data) {
        //     $postData = $data;
        //     $postdata['defect'] = NULL;
        //     $postMd->save($postData);
        // }
        // $results = array();
        // foreach ($allPostData as $key => $data) {
        //     $postData = $data;
        //     // $postdata['device_type'] = empty($data['device_type']) || $data['device_type'] == '' ? NULL : $data['device_type'];
        //     if (empty($data['device_type']) || $data['device_type'] == '' || $data['device_type'] != 'Desktop' || $data['device_type'] != 'Notebook' || $data['device_type'] != 'Other Device') {
        //         $postdata['device_type'] = NULL;
        //         $postMd->save($postData);
        //         array_push($results, 'true device');
        //     } else {
        //         array_push($results, 'false device');
        //     }
        //     if (empty($data['defect']) || $data['defect'] == '' || $data['defect'] == '0') {
        //         $postdata['defect'] = NULL;
        //         $postMd->save($postData);
        //         array_push($results, 'true defect');
        //     } else {
        //         array_push($results, 'false defect');
        //     }
        //     // $postdata['defect'] = empty($data['defect']) || $data['defect'] == '' ? NULL : $data['defect'];
        //     // $postMd->save($postData);
        // }
        return true;
    }
}
