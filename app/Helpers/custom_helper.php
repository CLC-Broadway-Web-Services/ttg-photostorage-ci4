<?php

if (!function_exists('logout')) {
    function logout()
    {
        return redirect()->route('logout');
    }
}
if (!function_exists('checkUserTypes')) {
    function checkUserTypes($type)
    {
        if (in_array(session()->get('user.type'), $type)) {
            return true;
        }
        logout();
    }
}
if (!function_exists('passwordHash')) {
    function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
