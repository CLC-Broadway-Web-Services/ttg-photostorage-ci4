<?php
//die('under mentanance');
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//error_reporting(E_ERROR | E_PARSE);
session_start();
include "functions.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  foreach ($_GET as $key => $gtyh) {
    $filtered_post[$key] = test_input($gtyh);
  }
  $_POST = $filtered_post;
}

//--1. Taking API  Input --//
global $gate;
$gate = $_GET;

//--2. loading relative action file  --//
if (isset($gate['action'])) {
  $action = $gate['action'];
  $file = "graph/" . $gate['action'] . ".act.php";
  if (file_exists($file)) {
    include $file;
  } else {
    $response['error'] = "Invalid Action" . $file;
  }
} else {
  $response['error'] = "No action defined";
}

//--3. Checking reequest status --//
if (isset($response['error'])) {
  $response['status'] = 'failed';
} else {
  $response['status'] = 'success';
}


//--4. Print out put in jason  --//
print_r(json_encode($response));
