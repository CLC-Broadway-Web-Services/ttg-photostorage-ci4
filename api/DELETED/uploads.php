<?php

$rawData = file_get_contents("php://input");
$json_string = $rawData. json_encode(apache_request_headers()).json_encode($_REQUEST).json_encode($_FILE);
$file_handle = fopen('json/'.time().'my_filename.json', 'w');
fwrite($file_handle, $json_string);
fclose($file_handle);

$target_dir='uploads/';
foreach($_FILE as $file)
{
    $target_file = $target_dir .basename($file["name"]);
if( move_uploaded_file($file["tmp_name"], $target_file))
{
    echo "sucess";
}
else
{
    echo "failed";
}
}

?>