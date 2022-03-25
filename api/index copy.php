<?php
//die('under mentanance');
// ini_set('display_errors', 0);

/**
$rawData = file_get_contents("php://input");
$json_string = $rawData;
$file_handle = fopen(time().'my_filename.json', 'w');
fwrite($file_handle, $json_string);
fclose($file_handle);
 **/
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $gtyh) {
        $filtered_post[$key] = test_input($gtyh);
    }
    $_POST = $filtered_post;
}

//--1. Taking API  Input --//
global $gate;
$gate = $_POST;
//-- Checking token except for fresh login --//

if (isset($gate['token'])) {
    if (!($response['user'] = getuser_bytoken($gate['token']))) {
        $response['error'] = "Invalid Token";
    }
} else if ($gate['action'] != 'login') {
    $response['error'] = "empty token";
}

if (!$response['error']) {
    //--2. loading relative action file  --//
    if (isset($gate['action'])) {
        $action = $gate['action'];
        if (file_exists($gate['action'] . ".act.php")) {
            include $gate['action'] . ".act.php";
        } else {
            $response['error'] = "Invalid Action";
        }
    } else {
        $response['error'] = "No action defined";
    }
}
//--3. Checking reequest status --//
if (isset($response['error'])) {
    // $error = $response['error'];
    // $response = [
    //     'error' => $error,
    //     'status' => 'failed'
    // ];
    $response['status'] = 'failed';
} else {
    $response['status'] = 'success';
}

if (isset($gate['token'])) {
    if (isset($response['user'])) {
        unset($response['user']);
    }
}
//--4. Print out put in jason  --//
print_r(json_encode($response));
