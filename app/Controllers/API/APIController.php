<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;
use App\Models\Admin\FilesModel;
use App\Models\Admin\ManageShipmentModel;
use App\Models\Admin\PostsModel;

class APIController extends BaseController
{
    public function index()
    {
        $response = [];
        $POST = $this->request->getVar();
        $filtered_post = [];
        foreach ($POST as $key => $gtyh) {
            $filtered_post[$key] = test_input($gtyh);
        }
        $gate = $filtered_post;

        if (isset($gate['token'])) {
            if (!($response['user'] = $this->getuser_bytoken($gate['token']))) {
                $response['error'] = "Invalid Token";
            }
        } else if ($gate['action'] != 'login') {
            $response['error'] = "empty token";
        }

        if (!isset($response['error'])) {
            if (isset($gate['action'])) {
                $action = $gate['action'];
                $response = $this->$action($gate, $response);
            } else {
                $response['error'] = "No action defined";
            }
        }
        //--3. Checking reequest status --//
        if (isset($response['error'])) {
            $response['status'] = 'failed';
        } else {
            $response['status'] = 'success';
        }

        if (isset($gate['token'])) {
            unset($response['user']);
        }
        //--4. Print out put in jason  --//
        print_r(json_encode($response));
    }
    // user functions
    private function login($gate = null, $response = null)
    {
        if ($gate != null) {
            if (isset($gate['username']) && isset($gate['pass'])) {
                $user =  $this->load_admin($gate['username']);
                if (password_verify($gate['pass'], $user['pass'])) {
                    unset($user['pass']);
                    // return json_encode($user['id']);
                    $user['token'] = $this->update_token($user['email'], $user['id'], $gate);
                    $response['user'] = $user;
                } else {
                    $response['error'] = 'Login credentials are not valid';
                }
            } else {
                $response['error'] = 'Username or password empty';
            }
            return $response;
        }
    }
    private function logout($gate = null, $response = null)
    {
        // $user = $response['user'];
        // $nwtoken = $this->update_token($user['email']);

        // return $nwtoken;


        $response['status'] = 'failed';
        $userDb = new AdminModel();
        $user = $userDb->where('token', $gate['token'])->first();
        $array = [
            'id' => $user['id'],
            'token'   => NULL
        ];
        $updateUser = $userDb->save($array);
        if ($updateUser) {
            $response['status'] = 'success';
        }
        return $response;
    }
    private function getuser($gate = null, $response = null)
    {
        $response['current_user'] = $response['user'];
        unset($response['current_user']['token']);
        unset($response['current_user']['pass']);
        unset($response['current_user']['crn_status']);
        unset($response['current_user']['firstname']);
        unset($response['current_user']['lastname']);
        return $response;
    }
    private function checkuid($gate = null, $response = null)
    {
        if ($post = $this->getpost_byuid($gate['uid'])) {
            $response['msg'] = "Asset ID already exists";
            $response['exists'] = "yes";
            $response['files'] = json_decode($post['files'], true);
        } else {
            $response['msg'] = "Asset ID does not exists";
            $response['exists'] = "no";
        }
        return $response;
    }

    // data functions
    private function getpost($gate = null, $response = null)
    {
        if (isset($gate['uid'])) {
            if ($post = $this->search_authuid($gate['uid'], $response['user']['id'])[0]) {

                $response['files'] = json_decode($post['files']);
                $response['type'] = "uid";

                if ($gate['ver'] == '2') {
                    $q = 1;
                    $oldfiles = json_decode(json_encode($response['files']), true);
                    unset($response['files']);
                    foreach ($oldfiles as $single) {
                        $sh['file'] = $single['file' . $q];
                        $sh['desc'] = $single['desc' . $q];
                        $response['files'][] = $sh;
                        $q++;
                    }
                }
            } else {
                $response['error'] = "Asset ID not found ";
            }
        } elseif (isset($gate['crn'])) {
            if ($post = $this->getuids_bycrn($gate['crn'])) {
                if ($this->auth_crn($response['user']['id'], $gate['crn']) == $gate['crn']) {
                    $response['uids'] = $post;
                } else {
                    $response['error'] = 'CRN not allotted for current user !';
                }
                $response['type'] = "crn";
            } else {
                $response['error'] = "CRN not found ";
            }
        }
        return $response;
    }
    private function getship($gate = null, $response = null)
    {
        $hash = $gate['hash'];

        if (!isset($gate['input_time'])) {
            $response['error'] = "Current device time error ";
        }
        if ($pct = strtotime($gate['input_time'])) {
        } else {
            $response['error'] = "input_time is not a valid time .  ";
        }
        if (!$response['error']) {
            if (isset($gate['crn'])) {


                if ($post = $this->get_shipment($gate['crn'])) {

                    $j = 1;

                    $response['shipments'] = $this->short_shipments($post, $hash);
                } else {
                    $response['error'] = "Shipment not found ";
                }
            } else {
                $data = $this->search_shipment_byuserid($response['user']['id']);

                $response['allshipments'] = $this->short_shipments($data, $hash);
            }
        }

        return $response;
    }

    // GLOBAL FUNCTION
    // all other function for work on API's
    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = str_replace('', '', $data);
        return $data;
    }
    private function getuser_bytoken($token)
    {
        $userDb = new AdminModel();
        $retuser = $userDb->where('token', $token)->first();
        if (isset($retuser['profile_pic'])) {
            $retuser['profile_pic'] = "/" . $retuser['profile_pic'] . "?ref=" . $this->random_strings();
        }
        return $retuser;
    }
    private function random_strings($length_of_string = 8)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        ) . rand(0, 9);
    }
    //-- 2. load admin --//
    private function load_admin($emailtoload)
    {
        $userDb = new AdminModel();
        $retuser = $userDb->where('email', $emailtoload)->first();
        return $retuser;
    }
    //-- 2. load users--//
    private function load_users($query, $type = '', $country = '')
    {
        $userMd = new AdminModel();

        // $sql = "SELECT * FROM $table WHERE country LIKE '%$country' AND (type LIKE '%$type' AND (name LIKE '%$query%' OR email LIKE '%$query%'OR id LIKE '%$query%'OR country LIKE '%$query%' OR mobile LIKE '%$query%'))";
        // $result = $conn->query($sql);
        $retuser = $userMd->like('country', $country)->like('type', $type)->like('like', $query)->orLike('email', $query)->orLike('id', $query)->orLike('country', $query)->orLike('mobile', $query)->findAll();
        //die($sql.$conn->error);
        // while ($retuser[] = $result->fetch_assoc()) {
        // }

        return $retuser;
    }
    //-- 3. Get post by user  --//
    private function getpost_byuid($uid)
    {
        $postDb = new PostsModel();
        $retuser = $postDb->where('uid', $uid)->first();
        return $retuser;
    }
    // search data auth asset 
    private function search_authuid($uid, $userid)
    {
        $exp = explode(",", $uid);
        $exp = array_map('test_input', $exp);
        $exp = array_filter($exp, 'remove_empty');
        $exp = array_map('add_colon', $exp);
        if (!count($exp)) {
            return false;
        }
        $imp = implode(",", $exp);
        $uid = $imp;

        $loadedUser = $this->load_admin($userid) ? $this->load_admin($userid) : null;

        // $sql = "SELECT ttg_post.* FROM ttg_post LEFT JOIN ttg_crn ON ttg_post.crn = ttg_crn.crn 
        // WHERE (ttg_post.uid IN ($uid))  
        // AND (( ttg_crn.userid = '$userid')
        //     OR ((ttg_post.userid IN (SELECT id FROM ttg_login WHERE country LIKE '%$country')) AND ('national' IN (SELECT crn_status FROM ttg_login WHERE id = '$userid')))
        //     OR ('super' IN (SELECT crn_status FROM ttg_login WHERE id = '$userid'))) 
        // LIMIT 2000";

        $postDb = new PostsModel();
        if ($loadedUser) {
            $result = $postDb->distinct()
                ->select('ttg_post.*')
                ->join('ttg_crn', 'ttg_crn.crn = ttg_post.crn')
                ->whereIn('ttg_post.uid', $uid)
                ->orWhere('ttg_post.userid', $userid)
                ->orWhereIn('ttg_post.userid', $loadedUser['id'])
                ->whereIn('ttg_post.uid', $uid)
                ->findAll();
        } else {
            $result = $postDb->distinct()
                ->select('ttg_post.*')
                ->join('ttg_crn', 'ttg_crn.crn = ttg_post.crn')
                ->whereIn('ttg_post.uid', $uid)
                ->orWhere('ttg_post.userid', $userid)
                ->whereIn('ttg_post.uid', $uid)
                ->findAll();
        }

        while ($retuser[] = $result) {
        }
        return $retuser;
    }
    private function getuids_bycrn($gate = null, $response = null)
    {
    }
    private function auth_crn($gate = null, $response = null)
    {
    }
    // function addpost($gate = null, $response = null)
    // {

    //     $target_dir = "uploads/";
    //     $month = date('M-Y');
    //     $target_dir = "uploads/posts/" . $month . "/";

    //     if (!file_exists($target_dir)) {
    //         mkdir($target_dir, 0777, true);
    //     }
    //     if (!isset($gate['description'])) {
    //         //  $response['error']="description empty";
    //     }
    //     if (!isset($gate['uid'])) {
    //         $response['error'] = "uid empty";
    //     }
    //     if ($oldpost = $this->getpost_byuid($gate['uid'])) {
    //         // $response['error']="Asset ID already exists";
    //         $update_data = 'true';
    //     }
    //     if ($_FILES) {
    //         foreach ($_FILES as $key => $file) {
    //             if ($file['tmp_name'] != '') {
    //                 if (!is_array(getimagesize($file['tmp_name']))) {
    //                     $response['error'] = "Non image files not allowed !";
    //                     break;
    //                 }
    //             }
    //         }
    //     }


    //     if (count($_FILES) == 0) {
    //         $response['error'] = "at least one image file required";
    //     }
    //     if (!$response['error']) {
    //         $response['msg'] = "Photos Uploaded Successfully.";
    //         $response['files_desc'] = $gate['description'];
    //         $response['uid'] = $gate['uid'];
    //         $response['crn'] = $gate['crn'];
    //         $response['defect'] = $gate['defect'];
    //         $response['device_type'] = $gate['device_type'];


    //         for ($r = 1; $r < 13; $r++) {
    //             $file = $_FILES['file' . $r];
    //             $desc = $gate['desc' . $r];
    //             $target_file['file' . $r] = $target_dir . time() . rand() . urlencode(basename($file["name"]));
    //             $target_file['desc' . $r] = $desc;
    //             if (move_uploaded_file($file["tmp_name"], $target_file['file' . $r])) {
    //                 $response['files_accepted'][] = $target_file;
    //                 $file['file_desc'] = $gate['desc' . $r];
    //                 $file['location'] = $target_file['file' . $r];
    //                 $file['uid'] = $gate['uid'];
    //                 add_file($file, $response['user']);
    //             }
    //             unset($target_file);
    //         }
    //         if (isset($update_data)) {
    //             deletepost($oldpost['id']);
    //         }

    //         add_post($response);
    //     }
    // }

    function get_shipment($crn)
    {
        $shipMd = new ManageShipmentModel();
        $result = $shipMd->where('crn', $crn)->findAll();
        foreach ($result as $key => $data) {
            $result[$key]['pdfurl'] = "https://ttg-photostorage.com/?filehash=" . $data['hash'];
            $result[$key]['printpdf'] = "https://ttg-photostorage.com/?print_file=true&filehash=" . $data['hash'];
            $result[$key]['files'] = json_decode($data['files']);
        }

        return $result;
    }

    function short_shipments($data, $hash)
    {

        $k = 1;
        foreach ($data as $singledata) {
            if (isset($singledata['crn'])) {
                $time = $this->gettimefromunix($singledata['ship_time'], $_POST['input_time']);
                $snewdata['ship_time_formatted'] = $time['time'];
                $snewdata['ship_date_formatted'] = $time['date'];
                $singledata['ship_time_formatted'] = $time['time'];
                $singledata['ship_date_formatted'] = $time['date'];
                $singledata['files'] = unified($singledata['files']);
                $snewdata['files'] = $singledata['files'];
                $snewdata['ship_time'] = $singledata['ship_time'];
                $snewdata['crn'] = $singledata['crn'];
                $snewdata['box_condition'] = $singledata['box_condition'];
                $snewdata['hash'] = $singledata['hash'];
                $snewdata['is_reject'] = $singledata['is_reject'];
                $snewdata['input_time'] = $singledata['input_time'];
                $newdata[] = $snewdata;
                unset($snewdata);
                if ($hash != '') {
                    if ($hash == $singledata['hash']) {
                        return $singledata;
                    }
                }
                $k = $k + 1;
            }
            //return $data;

        }
        return $newdata;
    }

    function gettimefromunix($unix, $currentdtime)
    {
        //	echo $currentdtime;
        $currentdtime = strtotime($currentdtime);
        //	echo $currentdtime;
        $deff = $currentdtime - time();
        $deff = round($deff / 900) * 900;
        $time = $unix + $deff;
        $date['date'] = date("m/d/Y", $time);
        $date['time'] = date("h:i a", $time);
        $date['diff'] = $deff;
        return $date;
    }
    function search_shipment_byuserid($id)
    {
        $shipDb = new ManageShipmentModel();
        if (session()->get('loginType') == 'superadmin') {
            // $sql = "SELECT * FROM ttg_ship WHERE  userid IN (SELECT id FROM ttg_login WHERE lower(country) LIKE lower('$id')) OR (userid='$id'  OR crn='$id') ORDER BY time DESC";
            $result = $shipDb->whereIn('uid', $id)
                ->orWhereIn('crn', $id)
                ->orderBy('time', 'desc')
                ->findAll();
        } elseif (session()->get('loginType') == 'admin') {
            $country = session()->get('user.country');
            // $sql = "SELECT * FROM ttg_ship WHERE  userid IN (SELECT id FROM ttg_login WHERE country LIKE '%$country') AND (userid='$id' OR  crn='$id') ORDER BY time DESC";
            $result = $shipDb->whereIn('uid', $id)
                ->orWhereIn('country', $id)
                ->orWhereIn('crn', $id)
                ->orderBy('time', 'desc')
                ->findAll();
        } else {
            // $sql = "SELECT * FROM ttg_ship WHERE (userid='$id' OR  crn='$id') ORDER BY time DESC";
            $result = $shipDb->whereIn('uid', $id)
                ->orderBy('time', 'desc')
                ->findAll();
        }

        foreach ($result as $key => $value) {
            $result[$key]['pdfurl'] = "https://ttg-photostorage.com/?filehash=" . $value['hash'];
            $result[$key]['printpdf'] = "https://ttg-photostorage.com/?print_file=true&filehash=" . $value['hash'];
            $result[$key]['files'] = json_decode($value['files'], true);
        }

        return $result;
    }

    function add_file($file, $user)
    {
        $userid = $user['id'];
        $time_stamp = time();
        $filename = $file['name'];
        $file_location = $file['location'];
        $file_desc = $file['file_desc'];
        $uid = $file['uid'];
        $filesData = [
            'userid' => $userid,
            'filename' => $filename,
            'time' => $time_stamp,
            'location' => $file_location,
            'uid' => $uid,
            'file_desc' => $file_desc
        ];
        $filesDb = new FilesModel();
        $result = $filesDb->save($filesData);
        return $result;
    }

    // function deletepost($id)
    // {

    //     if ($post = $this->getpost_byuid($id)) {
    //         //    $j=1;
    //         if ($single = json_decode($post['files'], true)) {
    //             foreach ($single as $photo) {
    //                 foreach ($photo as $key => $psd) {
    //                     $j =  substr($key, 4);
    //                     // break;
    //                     //  $qw[$r]=$psd;
    //                     //  $r=$r+1;
    //                 }
    //                 unlink($photo['file' . $j]);
    //                 //$j++;
    //             }
    //         }
    //     }
    //     connectsql();
    //     $table =  'ttg_post';
    //     global $conn;
    //     $sql = "DELETE FROM $table WHERE id='$id'";
    //     $result = $conn->query($sql);
    //     log_acivity('delete', $id, 'post', '');
    //     return $result;
    // }

    // function add_post($response)
    // {
    //     connectsql();
    //     $time_stamp = time();
    //     global $conn;
    //     $defect = $response['defect'];
    //     $device_type = $response['device_type'];
    //     $userid = $response['user']['id'];
    //     $uid = $response['uid'];
    //     $crn = $response['crn'];
    //     $device = $response['user']['device'];
    //     $files = json_encode($response['files_accepted']);
    //     $description = $response['files_desc'];
    //     $sql1 = "	INSERT INTO ttg_post(userid,files, time,description,uid,crn,device,defect,device_type)
    // VALUES ('$userid','$files','$time_stamp','$description','$uid','$crn','$device','$defect','$device_type')";
    //     $result = $conn->query($sql1);
    //     log_acivity('add', $uid, 'post', '');
    //     //	die($sql1.$conn->error);
    // }
    // function log_acivity($event, $datauid, $datatype, $datauserid)
    // {
    //   connectsql();
    //   $time_stamp = time();
    //   global $conn;
    //   global $response;


    //   $ipaddress = get_client_ip();
    //   if (isset($_SESSION['userid'])) {
    //     $userid = $_SESSION['userid'];
    //     $device = 'Web';
    //   } else {
    //     $userid = $response['user']['id'];
    //     $device = $response['user']['device'];
    //   }
    //   $sql1 = "	INSERT INTO ttg_actlogs(userid,event, time,datauid,device,ipaddress,datatype,datauserid )
    //     VALUES ('$userid','$event','$time_stamp','$datauid','$device','$ipaddress','$datatype','$datauserid')";
    //   $result = $conn->query($sql1);
    //   //	die($sql.$conn->error);
    // }




    // tokens
    private function update_token($email, $gate = null)
    {
        $ntoken = $this->generate_token($email);

        $userDb = new AdminModel();

        $device = $gate['device'] ?? "unknown";
        $array = [
            'token'   => $ntoken,
            'device'  => $device,
        ];
        $userDb->set($array)->where('email', $email)->update();
        return $ntoken;
    }
    private function generate_token($userid)
    {
        $werd = array($userid, time(), rand());
        $token = base64_encode(json_encode($werd));
        return $token;
    }
}
