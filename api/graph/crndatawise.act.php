<?php
$crndata=crndatawise();
$response['data']['dates']=array_keys($crndata);
$response['data']['crns']=array_values($crndata);

?>