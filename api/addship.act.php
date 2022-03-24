<?php
// echo random_strings();
$month = date('M-Y');
$target_dir = "uploads/ship/" . $month . "/";


if (isset($_POST['hash']) && isset($_POST['update'])) {
    if ($post = getshipment_byhash($_POST['hash'])) {
        $updateship = 'true';
    } else {
        $response['error'] = "Shipment hash doesnt exists.  ";
    }
    if ($updateship) {
        if (isset($_FILES['supervisor_sign'])) {
            $file = $_FILES['supervisor_sign'];
            $target_file['supervisor_sign'] = $target_dir . random_strings() . rand() . urlencode(basename($file["name"]));

            if (move_uploaded_file($file["tmp_name"], '../' . $target_file['supervisor_sign'])) {
                $gate['supervisor_sign'] = $target_file['supervisor_sign'];
            }
        }


        for ($r = 1; $r < 16; $r++) {
            if (isset($_FILES['file' . $r])) {
                $file = $_FILES['file' . $r];
                $desc = $gate['desc' . $r];
                $target_file['file' . $r] = $target_dir . time() . rand() . urlencode(basename($file["name"]));
                $target_file['desc' . $r] = $desc;
                if (move_uploaded_file($file["tmp_name"], '../' . $target_file['file' . $r])) {
                    $response['files_accepted'][] = $target_file;
                    $file['file_desc'] = $gate['desc' . $r];
                    $file['location'] = $target_file['file' . $r];
                    $file['uid'] = $gate['uid'];
                }
            }

            $signature = $_FILES['supervisor_sign'][''];
            unset($target_file);
        }
        if (isset($response['files_accepted'])) {
            $gate['files'] = json_encode($response['files_accepted']);
        }
        update_shipment($_POST['hash'], $gate);
        $response['msg'] = "Shipment updated successfully  ";
    }
} else {
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    if (!isset($gate['description'])) {
        //  $response['error']="description empty";
    }
    if (!isset($gate['crn'])) {
        $response['error'] = "crn empty";
    }

    if ($gate['crn'] == '') {
        $response['error'] = "crn empty";
    }

    if (!isset($gate['input_time'])) {
        $response['error'] = "Current device required as input_time ";
    }
    if ($pct = strtotime($gate['input_time'])) {
    } else {
        $response['error'] = "input_time is not a valid time .  ";
    }

    if ($_FILES) {
        foreach ($_FILES as $key => $file) {
            if ($file['tmp_name'] != '') {
                if (!is_array(getimagesize($file['tmp_name']))) {
                    echo $key . "->" . $file;
                    $response['error'] = "Non image files not allowed !";
                    break;
                }
            }
        }
    }
    if (count($_FILES) == 0) {
        //   $response['error']="At least one image file required";
    }
    if (!$response['error']) {
        $response['msg'] = "Shipment added Successfully.";
        //$response['files_desc']=$gate['description'];
        $response['crn'] = $gate['crn'];
        for ($r = 1; $r < 16; $r++) {
            $file = $_FILES['file' . $r];
            $desc = $gate['desc' . $r];
            $target_file['file' . $r] = $target_dir . time() . rand() . urlencode(basename($file["name"]));
            $target_file['desc' . $r] = $desc;
            if (move_uploaded_file($file["tmp_name"], '../' . $target_file['file' . $r])) {
                $response['files_accepted'][] = $target_file;
                $file['file_desc'] = $gate['desc' . $r];
                $file['location'] = $target_file['file' . $r];
                $file['uid'] = $gate['uid'];
            }

            $signature = $_FILES['supervisor_sign'][''];
            unset($target_file);
        }
        $file = $_FILES['supervisor_sign'];
        $target_file['supervisor_sign'] = $target_dir . random_strings() . rand() . urlencode(basename($file["name"]));

        if (move_uploaded_file($file["tmp_name"], '../' . $target_file['supervisor_sign'])) {
            $response['supervisor_sign'] = $target_file['supervisor_sign'];
        }

        add_shipment($response);
    }
}
