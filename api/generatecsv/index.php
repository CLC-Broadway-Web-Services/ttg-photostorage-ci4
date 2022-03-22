<?php
	include 'config.php';
	$sql = "SELECT * FROM `developers`";
	$qry = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<table border="1">
		<tr>
			<td>Id</td>
			<td>Name</td>
			<td>Mobile</td>
			<td>Address</td>
			<td>Designation</td>
		</tr>
		<tr>
			<?php
				while($row=mysqli_fetch_assoc($qry)){
			?>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['skills']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['designation']; ?></td>
		</tr>
			<?php
				}
			?>
	</table>
	<br/>
	<button id="button" value="csv">Export</button>

	<a href="javascript:void(0)" id="dlbtn" style="display: none;">
		<button type="button" id="mine">Export</button>
	</a>

	<script type="text/javascript" src="main.js"></script>
</body>
</html>