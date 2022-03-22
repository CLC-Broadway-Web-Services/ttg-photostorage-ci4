<?php

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$res = mysql_query("SELECT * FROM `ttg_files` WHERE id='$id'");
	$row = mysql_fetch_array($res);
}

if (isset($_POST['new_file_desc'])) {
	$new_file_desc = $_POST['new_file_desc'];
	$id  	 = $_POST['id'];
	$sql     = "UPDATE ttg_files SET file_desc='new_file_desc' WHERE id='$id'";
	$res 	 = mysql_query($sql)
		or die("Could not update" . mysql_error());
}

?>

<form action="edit.php" method="POST">
	Name: <input type="text" name="new_file_desc" value=" echo $row[uid]; ?/>"><br />
	<input type="hidden" name="id" value=" echo $row[id]; ?/>">
	<input type="submit" value=" Update " />
</form>