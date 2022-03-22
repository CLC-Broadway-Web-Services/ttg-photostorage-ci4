<?php
$crndata=shipmentdatawise();
$response['data']['dates']=array_keys($crndata);
$response['data']['crns']=array_values($crndata);


function shipmentdatawise()
{
    connectsql();
global $conn;
$enddate=$enddate+86400;
if($_SESSION['type']=='admin')
{
$country=$_SESSION['country'];
}
if($_SESSION['type']=='superadmin')
{
$country=$_SESSION['data_country'];
}
$sql="SELECT * FROM ttg_ship WHERE userid IN (SELECT id FROM ttg_login WHERE country LIKE '%$country')  ORDER BY time DESC";
$result=$conn->query($sql);
//die($sql1.$conn->error);
$s=0;
While($retuser[$s]=$result->fetch_assoc())
{
    $datacrn[date("Y-m-d",$retuser[$s]['time'])]=$datacrn[date("Y-m-d",$retuser[$s]['time'])]+1;
    $s=$s+1;
}
//die($sql1.$conn->error);
return equalize($datacrn);
}
?>