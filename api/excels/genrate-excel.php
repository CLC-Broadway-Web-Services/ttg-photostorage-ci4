<?php
include ('config.php');
$sql = "SELECT fullName, emailId, phoneNumber from tblemploye";  
$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "User Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t";  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";   
?>