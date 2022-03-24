<?php
$crndata=packageshare();
unset($crndata['Unknown']);
$response['data']['dates']=array_keys($crndata);
$response['data']['crns']=array_values($crndata);



function packageshare()
{
    if($_SESSION['type']=='admin')
{
$country=$_SESSION['country'];
}
if($_SESSION['type']=='superadmin')
{
$country=$_SESSION['data_country'];
}
connectsql();
$table= 'ttg_ship';
global $conn;
$sql="SELECT box_condition, time FROM $table WHERE userid IN (SELECT id FROM ttg_login WHERE country LIKE '%$country') ";
$result=$conn->query($sql);
$j=0;

While($retuser[$j]=$result->fetch_assoc())
{
    if($_GET['date']!='')
{
$date=$_GET['date']*3600*12;
}
else
{
    $date=10000*3600*12;
}
$period=time()-$retuser[$j]['time'];
if($period < $date)
{
    $qua=ucfirst(strtolower($retuser[$j]['box_condition']));
    if($qua=='')
    {
        $qua='Unknown';
    }
   $datacrn[$qua]=$datacrn[$qua]+1;
    
  $j=$j+1;  
}
}

ksort($datacrn); 
return  $datacrn;
}
?>