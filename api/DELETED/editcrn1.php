<?php

if (isset($_POST['normalclient'])) {
	if (crn_normal($_POST['normalclient'])) {
		$success = "The client has been changed to normal successfully !";
	}
}

if (isset($_POST['nationalclient'])) {
	if (crn_national($_POST['nationalclient'])) {
		$success = "The client has been changed to national client successfully !";
	}
}

if (isset($_POST['superclient'])) {
	if (crn_super($_POST['superclient'])) {
		$success = "The client has been changed to super successfully !";
	}
}
if ($status = crn_status($_GET['ceditidq'])) {
} else {
	die("invalid client");
}


?>
<link rel="stylesheet" href="https://ttg-photostorage.com/style1.css">
<style>
	body {
		background: unset;
	}

	.crn {
		font-weight: bold;
		width: 80%;
	}

	.AssignTable {
		margin-top: 100px;
	}

	th:nth-child(2n) {
		text-align: center;
	}

	td:nth-child(2n) {
		text-align: center;
	}

	#remove {
		margin-top: 8px;
		padding: 5px 10px;
		font-size: 12px;
		font-weight: bold;
		color: #a32727;
		border: 2px solid #a32727;
		background: #ffffff;
		cursor: pointer;
	}

	#remove:hover {
		background: #a32727;
		color: #ffffff;
	}

	.topbar {
		margin-left: -8px;
		position: fixed;
		text-align: center;
		background-color: rgba(24, 65, 108, 0.3);
		width: 100%;
		top: 0px;
		padding-top: 20px;
		padding-bottom: 20px;
		padding-left: 20%;
	}

	.superclient {
		margin-left: -8px;
		position: fixed;
		padding-top: 20px;
		padding-bottom: 20px;
		text-align: center;
		background-color: rgba(24, 65, 108, 0.3);
		width: 100%;
		bottom: 0px;
	}

	.superclientFoot {
		margin-left: -20%;
		position: fixed;
		padding-top: 20px;
		padding-bottom: 20px;
		text-align: center;
		background-color: rgba(24, 65, 108, 0.3);
		width: 100%;
		bottom: 0px;
	}

	.msg {
		margin-top: 50%;
		margin-left: -20%;
		font-size: 15px;
	}

	.btn_superclient {
		top: 50%;
		background-color: #f1f1f1;
		color: #000000;
		font-size: 16px;
		font-weight: bold;
		padding: 16px 30px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
	}

	.btn_superclient:hover {
		background-color: #18416c;
		color: #ffffff;
	}

	.assignTextBox {
		padding: 10px;
		font-size: 14px;
		border: 1px solid #18416c;
		border-radius: 10px 0px 0px 10px;
		float: left;
		width: 60%;
		background: #ffffff;
	}

	.Assignsearchbtn {
		float: left;
		width: 15%;
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 10px;
		padding-bottom: 10px;
		background: #18416c;
		color: white;
		font-size: 14px;
		font-weight: bold;
		border: 1px solid #18416c;
		;
		border-radius: 0px 5px 5px 0px;
		border-left: none;
		cursor: pointer;
	}

	.Assignsearchbtn:hover {
		background: #123152;
	}

	.errorBlockAssign {
		margin-left: -30%;
		margin-top: -20px;
		padding: 10px;
		background-color: #f44336;
		color: white;
		font-weight: bold;
	}

	.successBlockAssign {
		margin-left: -30%;
		margin-top: -20px;
		padding: 10px;
		background-color: #24ab31;
		color: white;
		font-weight: bold;
	}

	.closebtnMsg {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}

	.closebtnMsg:hover {
		color: black;
	}
</style>
<div class="topbar">
	<?php

	//print_r($_POST);
	if (isset($_POST['crnid'])) {
		$uidlist = getuids_bycrn($_POST['crnid']);
		if (!$uidlist) {
			$error = "<span class='closebtnMsg' onclick='this.parentElement.style.display='none';'>&times;</span>Invalid CRN !";
		} else {
			$crnlist = get_crn($_GET['ceditidq']);
			if (!in_array($_POST['crnid'], $crnlist)) {
				add_crn($_POST['crnid'], $_GET['ceditidq']);
				$success = "<span class='closebtnMsg' onclick='this.parentElement.style.display='none';'>&times;</span>CRN added successfully !";
			} else {
				$error = "<span class='closebtnMsg' onclick='this.parentElement.style.display='none';'>&times;</span>CRN for the user already exists!";
			}
		}
	}



	if (isset($_POST['remove'])) {

		if (remove_crn($_POST['remove'], $_GET['ceditidq'])) {

			$success = "<span class='closebtnMsg' onclick='this.parentElement.style.display='none';'>&times;</span>CRN removed successfully !";
		} else {
			$error = "<span class='closebtnMsg' onclick='this.parentElement.style.display='none';'>&times;</span>Failed to remove CRN !";
		}
	}

	?>
	<?php
	if ($error) {
		echo "<div class='errorBlockAssign' > " . $error . " </div>";
	} else {
		echo "<div class='successBlockAssign' > " . $success . " </div>";
	}
	if ($status == 'normal') {
		echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '"">';
	?>
		<input class="assignTextBox" type="text" name="crnid" value="" placeholder="Enter CRN to Assign" /> <button class="Assignsearchbtn" type="submit" value="Assign"><i class="fa fa-plus" aria-hidden="true"></i> Assign</button>
		</form>
</div>
<?php echo ''; ?>
<table class="AssignTable">
	<tbody>
		<tr>
			<th>CRN </th>
			<th>Action</th>
		</tr>
		<?php $crnlist = get_crn($_GET['ceditidq']);
		foreach ($crnlist as $single) {
			if ($single != '') {
				echo "<tr><td class='crn'>" . $single . "</td>
	                    <td>
	                        <form method='post' action='" . $_SERVER['REQUEST_URI'] . "'>
	                               <input  name='remove' type='hidden' value='" . $single . "'' />
	                                <button name='" . $single . "' id='remove' type='submit' value='Remove'>Remove</button>
	                        </form></td></tr>";
			}
		}
		?>
	</tbody>
</table>
<?php if ($_SESSION['type'] == 'superadmin') { ?>
	<div class="superclient">
		<form method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
			<input name='superclient' type='hidden' value='<?php echo $_GET['ceditidq']; ?>'' />
        <button type="submit" value="Make Super Client" class="btn_superclient">Make Super Client!</button>
    </form>
</div>
 <?php } ?>
<div class="nationalclient" > 
    <form method=' post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
			<input name='nationalclient' type='hidden' value='<?php echo $_GET['ceditidq']; ?>'' />
        <button type="submit" value="Make Super Client" class="btn_superclient">Make National Client!</button>
    </form>
</div>
<?php } else if ($status == 'super') { echo "<div class='msg' ><strong>This Client is Super Client!</strong>This client has access to all CRN.  </div>"; ?>
<div class="superclientFoot" >
<form method=' post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
			<input name='normalclient' type='hidden' value='<?php echo $_GET['ceditidq']; ?>'' />
<button type="submit" value="Change to Normal client" class="btn_superclient">Change To Normal Client!</button></form></div>
	<?php
	} else if ($status == 'national') {
		echo "<div class='msg' ><strong>This Client is National Client!</strong>This client has access to all CRN in country !.  </div>";
	?>
<div class="superclientFoot" >
<form method=' post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
			<input name='normalclient' type='hidden' value='<?php echo $_GET['ceditidq']; ?>'' />
<button type="submit" value="Change to Normal client" class="btn_superclient">Change To Normal Client!</button></form></div>
	<?php
	}
	?>