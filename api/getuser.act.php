<?php
$response['current_user'] = $response['user'];
unset($response['current_user']['token']);
unset($response['current_user']['pass']);
unset($response['current_user']['crn_status']);
unset($response['current_user']['firstname']);
unset($response['current_user']['lastname']);
