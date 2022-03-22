<?php
$newuid=$_GET['chuid_uid'];
$id=$_GET['chuid_id'];
if($data=update_uid_by_id($newuid,$id))
{
    echo $_SERVER['QUERY_STRING'];
 print_r($data);
    
}
else{
   echo 'fail' ;
}
