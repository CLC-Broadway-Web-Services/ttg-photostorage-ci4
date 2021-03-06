<?php

if (isset($gate['username']) && isset($gate['pass'])) {
  $user =  load_admin($gate['username']);
  if (password_verify($gate['pass'], $user['pass'])) {
    unset($user['pass']);
    $user['token'] = update_token($user['email']);
    $response['user'] = $user;
  } else {
    $response['error'] = 'Login credentials are not valid';
  }
} else {
  $response['error'] = 'Username or password empty';
}
