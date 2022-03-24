<?php
$data=search_data_bydate($startdate,$enddate);
foreach($data as $files)
{
    $arrafile=json_decode($files['files']);
    foreach($arrafile as $rtv)
    {
        $gdf[]=basename(reset($rtv) );
        $size=$size+filesize(reset($rtv));
    }
}


$files1 = scandir("../uploads");
//print_r($files1);
$result=$result = array_diff($files1,$gdf);
echo count($result);
echo $size;