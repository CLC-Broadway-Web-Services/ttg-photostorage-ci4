<?php

define('DB_SERVER','localhost');

define('DB_USER','ttgphoto_ttg');

define('DB_PASS' ,'ee^4]=)bI].-');

define('DB_NAME', 'ttgphoto_storage');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection

if (mysqli_connect_errno())

{

 echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

?>