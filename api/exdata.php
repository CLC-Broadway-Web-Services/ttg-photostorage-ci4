<?php
include('functions.php');
if (isset($_POST['csv'])) {

	$id = $_REQUEST['id'];
	$sqls = "SELECT * FROM ttg_post where id='$id'";
	$qrys = mysqli_query($conn, $sqls);

	while ($rows = mysqli_fetch_assoc($qrys)) {
		$uid = $rows['uid'];
	}

	$enc = base64_encode($uid);
	header('Content-Type: text/csv; charset=utf-8');

	header('Content-Disposition: attachment; filename=DevelopersData.csv');

	$output = fopen("php://output", "w");

	fputcsv($output, array('Staff ID', 'CRN', 'Asset ID', 'Links'));

	$sql = "SELECT userid , crn, uid, 'https://ttg-photostorage.com/?uid=$enc' AS links FROM ttg_post where id ='" . $id . "'";
	$qry = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($qry)) {



		fputcsv($output, $row);
	}
	fclose($output);
}


if (isset($_POST['bulkcsv'])) {
	header('Content-Type: text/csv; charset=utf-8');

	header('Content-Disposition: attachment; filename=DevelopersData.csv');

	$output = fopen("php://output", "w");

	fputcsv($output, array('Staff ID', 'CRN', 'Asset ID', 'Links'));
	$sql = "SELECT userid , crn, uid, CONCAT('https://ttg-photostorage.com/?uid=',uid) AS links FROM ttg_post";
	$qry = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($qry)) {



		fputcsv($output, $row);
	}
	fclose($output);
}



// third

// bkp all data le 
// CONCAT('https://ttg-photostorage.com/?uid=',uid

if (isset($_POST["selectid"])) {
	$array = [];

	$filename = 'users.csv';

	$output = fopen("php://output", "w");
	fputcsv($output, array('Staff ID', 'CRN', 'Asset ID', 'Links'));
	foreach ($_POST["id"] as $id) {
		$sqls = "SELECT * FROM ttg_post where id='$id'";
		$qrys = mysqli_query($conn, $sqls);

		while ($rows = mysqli_fetch_assoc($qrys)) {
			$uid = $rows['uid'];
		}
		$enc = base64_encode($uid);
		$output = fopen("php://output", "w");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=" . $filename);
		header("Content-Type: application/csv; ");


		$sql = "SELECT userid , crn, uid, 'https://ttg-photostorage.com/?uid=$enc' AS links FROM ttg_post where id ='" . $id . "'";
		$qry = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($qry)) {



			fputcsv($output, $row);
		}
		fclose($output);
	}
}
