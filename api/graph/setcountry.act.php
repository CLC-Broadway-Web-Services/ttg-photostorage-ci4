<?
if($_SESSION['type']=='superadmin')
{
$country=mapcountry($_GET['country']);
$_SESSION['data_country']=$country;
if($country=='')
{
    unset($_SESSION['data_country']);
}
}
else
{
 $response['error']='Only Super Admin allowed to select country . '; 
}

