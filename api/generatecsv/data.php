<?php
include 'config.php';
if (isset($_POST['csv'])) {
	header('Content-Type: text/csv; charset=utf-8');

	header('Content-Disposition: attachment; filename=DevelopersData.csv');
	
	$output = fopen("php://output", "w");

	fputcsv($output, array('Id','Name', 'Skills','Address', 'Designation'));
	$sql = "SELECT id , name FROM `developers`";
	$qry = mysqli_query($con, $sql);
	while($row= mysqli_fetch_assoc($qry))
	{
	 
	    
	    
		fputcsv($output, $row);
	}
	fclose($output);
}
?>