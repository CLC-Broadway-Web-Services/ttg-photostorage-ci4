<?php

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


        if ($post = get_shipment($gate['crn'])) {

            $j = 1;

            $response['shipments'] = short_shipments($post, $hash);
        } else {
            $response['error'] = "Shipment not found ";
        }
    } else {
        $data = search_shipment_byuserid($response['user']['id']);

        $response['allshipments'] = short_shipments($data, $hash);
    }
}
