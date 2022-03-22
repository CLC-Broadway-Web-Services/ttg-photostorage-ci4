<?php
// Database Connection file
include('config.php');
?>


    <table border="1">
    <thead>
    
         <tr>
		<th>Id</th>
                            <th>Staff ID</th>
                            <th>CRN</th>
                            <th>Asset ID</th>
                            <th>Links</th>
                           
                        </tr>
    </thead>
<?php
// File name
$filename="Data";



$query=mysqli_query($con,"SELECT userid , crn, uid, CONCAT('https://ttg-photostorage.com/?uid=',uid) AS links FROM ttg_post where uid ='IT0244830'");

$cnt=1;

while ($row=mysqli_fetch_array($query)) {



?>



            <tr>

                <td><?php echo $cnt;  ?></td>

                <td><?php echo $row['userid']?></td>

                <td><?php echo $row['crn']?></td>

                <td><?php echo $row['uid']?></td>

                <td><?php echo $row['links']?></td>


            </tr>
<?php 
$cnt++;
// Genrating Execel  filess
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-Report.xls");
header("Pragma: no-cache");
header("Expires: 0");

} ?>
         
    </table>

