<?php
//die('under mentanance');
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//error_reporting(E_ERROR | E_PARSE);
session_start();


require_once "functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($_POST as $key => $gtyh) {
    $filtered_post[$key] = test_input($gtyh);
  }
  $_POST = $filtered_post;
}
include "header.php";
if (isset($_GET['logout'])) {
  session_destroy();
  echo "<script>window.location='?'</script>";
  exit();
}
if (isset($_GET['feedback'])) {
  include "feedback.php";
  exit();
}

if (isset($_GET['crn'])) {
  include "crndetail.php";
  exit();
}

if (isset($_GET['adduser'])) {
  include "add_user_popup.php";
  exit();
}

if (isset($_GET['print_file'])) {
  include "print_file.php";
  exit();
}
if (isset($_GET['hashimages'])) {
  include "shipimages.php";
  exit();
}
if (isset($_GET['uid'])) {
  include "photos.php";
  exit();
}

if (isset($_GET['shid'])) {
  //  echo "Underconstuction !";
  include "shipphotos.php";
  exit();
}

if (isset($_GET['filehash'])) {
  //  echo "Underconstuction !";
  include "filepdf.php";
  exit();
}

if (isset($_SESSION['user'])) {


  if (isset($_GET['ceditid'])) {
    include "editcrn.php";
    //  exit();
  }

  if (isset($_GET['ceditidq'])) {
    include "editcrn1.php";
    exit();
  }

  if (isset($_GET['edituid'])) {
    include "edituid.php";
    exit();
  }

  if (isset($_GET['download_csv'])) {
    include "dg_gn_csv.php";
    exit();
  }

  if (isset($_GET['genrate_pdf'])) {


    include "wes/imagespdf.php";


    exit();
  }
}

if ($_POST) {

  $pass = $_POST['password'];
  $login = $_POST['login'];
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->

<head>
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>TTG-Photo Storage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style1.css">
  <link rel="icon" type="image/png" href="images/TTG-Photo Storage-Favicon.png">


  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

  <style>
    * {
      margin: 0px;
      padding: 0px;
    }

    body {
      background-image: linear-gradient(to right, #fff, #72d6f5);
    }

    .header {
      overflow: hidden;
      background-color: #f1f1f1;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 100px;
      padding-right: 100px;
    }

    .LogoBox {
      float: left;
      margin-top: 0px;
    }

    .MenuBox {
      float: right;
    }

    .right1 {
      float: right;
      text-align: right;
      padding-right: 10px;
    }

    .right2 {
      float: right;
      text-align: right;
      padding-right: 10px;
      margin-top: 20px;
    }

    .right3 {
      float: left;
      text-align: left;
      padding-right: 180px;
      padding-top: 4%;
    }

    .outbtn {
      margin-top: 0px;
      float: right;
      width: 100px;
      padding: 5px;
      background: #18416c;
      color: white;
      font-size: 16px;
      border: 1px solid grey;
      border-radius: 5px;
      border-left: none;
      cursor: pointer;
    }

    .outbtn:hover {
      background: #123152;
    }

    #countryline,
    #timezoneline {
      display: inline;
    }

    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }

    .right1btn {
      color: white;
      font-size: 16px;
      border: none;
    }

    .right1 {
      position: relative;
      display: inline-block;
    }

    .right1-content {
      display: none;
      position: fixed;
      background-color: #f1f1f1;
      min-width: 120px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .right1-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .right1-content a:hover {
      background-color: #ddd;
      cursor: pointer;
    }

    .right1:hover .right1-content {
      display: block;
    }

    .right1:hover .right1btn {
      background-color: none;
    }

    .editp:hover {
      color: #0068de;
    }

    .signo:hover {
      color: #de0000;
    }
  </style>
  <script>
    const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.cookie = "timezone=" + tz;
  </script>

</head>

<body>
  <?php if (isset($_SESSION['user'])) {
    echo '<div class="header">
	<div class="LogoBox">
		<img src="TTG-Photo Storage-Logo.png" width="280px" />
	</div>
	
	<div  class="MenuBox">
		<div class="right1">
			<img src="avatar.svg" width="50px" class="right1btn"/>
			<div class="right1-content">
			    <a onclick=yprofile() class="editp"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a> 
			    <a onclick=logout() class="signo"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> 
            </div>
		</div>
		
		<div class="right2">
			<h3>' . $_SESSION['message'] . '</h3>
			
		</div>
		<div class="right3">
		    <div id="countryline"><b>Country: </b>' . $_SESSION['country'] . ' </div> | <div id="timezoneline"><b>Timezone: </b>' . date_default_timezone_get() . ' </div>
		</div>
	</div>
  </div>';
  }
  ?>


  <section class="container">

    <?php
    if (isset($_SESSION['user'])) {
      require "index23.php";
    } else {
      include "login.php";
    }

    ?>

    <div class="login-help">

    </div>
  </section>

</body>

</html>