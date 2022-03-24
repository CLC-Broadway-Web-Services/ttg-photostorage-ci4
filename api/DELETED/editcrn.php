<?php

if (isset($_POST['normalclient'])) {
	if (crn_normal($_POST['normalclient'])) {
		$success = "The client has been changed to normal successfully !";
	}
}
if (isset($_POST['superclient'])) {
	if (crn_super($_POST['superclient'])) {
		$success = "The client has been changed to super successfully !";
	}
}
if ($status = crn_status($_GET['ceditid'])) {
} else {
	die("invalid client");
}


?>
<link rel="stylesheet" href="https://ttg-photostorage.com/style1.css">
<style>
	body {
		margin-top: 60px;

		background: unset;
	}

	.crn {
		font-size: 1.5em;
		width: 80%;
	}

	td,
	th {
		text-align: left;
	}

	th:nth-child(2n) {
		text-align: center;
	}

	td:nth-child(2n) {
		text-align: center;
	}

	#remove {
		padding: 5px 10px;
		font-size: 12px;
		font-weight: bold;
		color: #FFFFFF;
		background: #ff0000;
		border: none;
	}

	.topbar {
		position: fixed;
		text-align: center;
		background: bisque;
		width: 100%;
		height: 60px;
		top: 0px;
	}

	.superclient {
		position: fixed;
		text-align: center;
		background: bisque;
		width: 100%;
		height: 30px;
		bottom: 0px;
	}

	.msg {
		margin-top: 10%;
		font-size: 15px;
	}

	.btn_superclient {
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		background-color: #f1f1f1;
		color: black;
		font-size: 16px;
		padding: 16px 30px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
	}

	.btn_superclient:hover {
		background-color: black;
		color: white;
	}
</style>

<?php

//print_r($_POST);
if (isset($_POST['crnid'])) {
	$uidlist = getuids_bycrn($_POST['crnid']);
	if (!$uidlist) {
		$error = "Invalid CRN !";
	} else {
		$crnlist = get_crn($_GET['ceditid']);
		if (!in_array($_POST['crnid'], $crnlist)) {
			add_crn($_POST['crnid'], $_GET['ceditid']);
			$success = "CRN added successfully !";
		} else {
			$error = "CRN for the user already exists!";
		}
	}
}



if (isset($_POST['remove'])) {

	if (remove_crn($_POST['remove'], $_GET['ceditid'])) {

		$success = "CRN removed successfully !";
	} else {
		$error = "Failed to remove CRN !";
	}
}
