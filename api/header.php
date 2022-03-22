<?php

$message = "";

if (isset($_GET['logout'])) {
	session_destroy();
}

if (isset($_POST['commit'])) {
	if ((@$_POST['password']) and (@$_POST['login'])) {

		$pass = $_POST['password'];
		$login = $_POST['login'];
		$users = load_admin($login);

		if (isset($users['email'])) {
			if (($users['type'] == 'admin') or ($users['type'] == 'client') or ($users['type'] == 'superadmin')) {
				$realpass = $users['pass'];
			}

			if ($pass == $realpass) {
				$_SESSION['user'] = $users['name'];
				$_SESSION['type'] = $users['type'];
				$_SESSION['userid'] = $users['id'];
				$_SESSION['country'] = $users['country'];
				$_SESSION['message'] = " Welcome " . $_SESSION['user'] . " !<br /><br />";
				if (($_SESSION['type'] == 'admin') or ($_SESSION['type'] == 'superadmin')) {
					$_SESSION['message'] .= "";
				}
				$_SESSION['api'] = $users[$login][2];
				include "mailer.php";
			} else {
				$message = " Invalid username or password  ";
			}
		} else {
			$message = "User not found" . json_encode($users);
		}
	} else {
		$message = " Empty password or user name";
	}
}
