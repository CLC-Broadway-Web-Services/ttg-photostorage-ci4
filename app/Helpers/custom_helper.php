<?php

if(!function_exists('logout')){
    function logout(){
        return redirect()->route('logout');
    }
}
if(!function_exists('checkUserTypes')){
    function checkUserTypes($type){
        if(in_array(session()->get('user.type'), $type)) {
            return true;
        }
        logout();
    }
}