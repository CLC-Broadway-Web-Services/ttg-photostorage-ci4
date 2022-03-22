<?php

$month = date('M-Y');
$target_dir = "uploads/posts/" . $month . "/";

if (!file_exists($target_dir)) {
  mkdir($target_dir, 0777, true);
}
if (!isset($gate['description'])) {
  //  $response['error']="description empty";
}
if (!isset($gate['uid'])) {
  $response['error'] = "uid empty";
}
if ($oldpost = getpost_byuid($gate['uid'])) {
  // $response['error']="Asset ID already exists";
  $update_data = 'true';
}

if ($_FILES) {
  foreach ($_FILES as $key => $file) {
    if ($file['tmp_name'] != '') {
      if (!is_array(getimagesize($file['tmp_name']))) {
        $response['error'] = "Non image files not allowed !";
        break;
      }
    }
  }
}

// print_r(count($_FILES));
// die();

if (count($_FILES) == 0) {
  $response['error'] = "at least one image file required";
}
if (!$response['error']) {
  $response['msg'] = "Photos Uploaded Successfully.";
  $response['files_desc'] = $gate['description'];
  $response['uid'] = $gate['uid'];
  $response['crn'] = $gate['crn'];
  $response['defect'] = $gate['defect'];
  $response['device_type'] = $gate['device_type'];

  $totalFiles = count($_FILES) + 1;

  for ($r = 1; $r < $totalFiles; $r++) {
    $file = $_FILES['file' . $r];
    $desc = $gate['desc' . $r];
    $target_file['file' . $r] = $target_dir . time() . rand() . urlencode(basename($file["name"]));
    $target_file['desc' . $r] = $desc;
    // print_r(json_encode(move_uploaded_file($file["tmp_name"], '../'.$target_file['file' . $r])));
    // print_r(file_exists($file["tmp_name"]));
    // die();
    if (move_uploaded_file($file["tmp_name"], $target_file['file' . $r])) {
      $response['files_accepted'][] = $target_file;
      $file['file_desc'] = $gate['desc' . $r];
      $file['location'] = $target_file['file' . $r];
      $file['uid'] = $gate['uid'];
      add_file($file, $response['user']);
    } else {
      $response = [
        'error' => "unable to move file." . $r,
        'status' => 'failed'
      ];
      if (isset($gate['token'])) {
        if (isset($response['user'])) {
          unset($response['user']);
        }
      }
      print_r(json_encode($response));
      die();
    }
    unset($target_file);
  }
  if (isset($update_data)) {
    // update_uid_images($response['uid'],$response['files_accepted']);
    deletepost($oldpost['id']);
  }

  add_post($response);
}
