<?php
if ($post = getpost_byuid($gate['uid'])) {
     $response['msg'] = "Asset ID already exists";
     $response['exists'] = "yes";
     $response['files'] = json_decode($post['files'], true);
} else {
     $response['msg'] = "Asset ID does not exists";
     $response['exists'] = "no";
}
