<?php
if (isset($gate['uid'])) {
    if ($post = search_authuid($gate['uid'], $response['user']['id'])[0]) {

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

    if ($post = getuids_bycrn($gate['crn'])) {

        if (auth_crn($response['user']['id'], $gate['crn']) == $gate['crn']) {
            $response['uids'] = $post;
        } else {
            $response['error'] = 'CRN not allotted for current user !';
        }

        $response['type'] = "crn";
    } else {
        $response['error'] = "CRN not found ";
    }
}
