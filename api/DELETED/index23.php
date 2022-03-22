<?php
$current_page = 'home';
if (isset($_GET['p'])) {
  $current_page = $_GET['p'];
}
if (isset($_GET['pq'])) {
  $current_page = $_GET['pq'];
}
$current_page = preg_replace('/[^a-zA-Z0-9]/', '', $current_page);
?>

<script>
  <?php
    echo "function addcurrentclass() {";
    echo 'var element = document.getElementById("' . $current_page . '");';
    echo 'element.classList.add("current_page");';
    echo " };";
  ?>

  function checkdata() {
    if (document.getElementById("clemail").value == '') {
      return false;
    }
  }

  function logout() {
    window.location = "?logout=true";
  }

  function mclient() {
    window.location = "?p=mclient";

  }

  function mstaff() {
    window.location = "?p=mstaff";
  }

  function simages() {
    window.location = "?p=simages";
  }

  function home() {
    window.location = "?p=home";
  }

  function yprofile() {
    window.location = "?p=yprofile";
  }

  function sships() {
    window.location = "?p=sships";
  }

  function mship() {
    window.location = "?p=mship";
  }

  function da_simages() {
    window.location = "?p=da_simages";
  }

  function mactivity() {
    window.location = "?p=mactivity";
  }

  function madmin() {
    window.location = "?pq=madmin";
  }

  function copyFunction(c9) {
    var copyText = document.getElementById(c9 + "text");
    copyText.style.display = "block";
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    copyText.style.display = "none";

    var tooltip = document.getElementById(c9 + "myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
  }

  function outFunc(c9) {
    var tooltip = document.getElementById(c9 + "myTooltip");
    tooltip.innerHTML = "Copy to clipboard";
  }

  function str2bytes(str) {
    var bytes = new Uint8Array(str.length);
    for (var i = 0; i < str.length; i++) {
      bytes[i] = str.charCodeAt(i);
    }
    return bytes;
  }

  function ttg_imagepdf(y6) {
    var tooltip = document.getElementById(y6 + "myTooltip");
    tooltip.innerHTML = "Generating PDF";

    var xhttp = new XMLHttpRequest();
    url = "https://ttg-photostorage.com/?genrate_pdf=" + y6;


    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {

        if (this.status == 200) {
          var contentType = xhttp.getResponseHeader("Content-Type");
          if (contentType == "application/x-download") {

            var end = window.performance.now();
            console.log(end);
            window.location.href = url;
            tooltip.innerHTML = "PDF Generated";
            alert("File generated successfully");

          } else {
            tooltip.innerHTML = "PDF Generation Failed";
            alert(this.responseText);
          }
        }



      }

    };
    xhttp.open("GET", url, true);
    // xhttp.responseType = "blob";
    xhttp.send();
  }

  function pdfselected() {
    var s7 = '';

    i = 1;
    e = 0;
    while (document.getElementById("check" + i)) {
      console.log(i);

      if (document.getElementById("check" + i).checked) {
        var t7 = document.getElementById("check" + i).value;
        console.log(t7);
        var u7 = t7 + "uid";
        var v7 = document.getElementById(u7).value;
        console.log(v7);
        s7 = v7 + "," + s7;
        e = e + 1;
      }
      i = i + 1;
    }
    if (e > 0) {


      ttg_imagepdf_bulk(s7);


    } else {
      alert("Please select data . ")
    }


  }

  function ttg_imagepdf_bulk(y7) {
    var tooltip = document.getElementById("pdf_all");
    tooltip.innerHTML = "Generating PDF";

    var xhttp = new XMLHttpRequest();
    url = "https://ttg-photostorage.com/?genrate_pdf=" + y7;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {

        if (this.status == 200) {
          //  var contentType = xhttp.getResponseHeader("Content-Type");
          if (this.responseText == "Fine") {
            window.location.href = url;
            tooltip.innerHTML = "PDF Generated";
            alert("File generated successfully");
            tooltip.innerHTML = "";


          } else {
            tooltip.innerHTML = "Error: Failed to Generate PDF";
            alert(this.responseText);
            return window.performance.now();
          }
        } else {
          alert("Internal Server Error. ")

        }



      }

    };
    xhttp.open("GET", url + "&check=true", true);
    xhttp.send();
  }

  function outFuncPDF(c11) {
    var tooltip = document.getElementById(c11 + "myTooltip");

    tooltip.innerHTML = "Download PDF";
  }

  function edituser(p1) {

    g3 = p1.id;
    g3 = g3.replace(/\D/g, '');

    document.getElementById(g3 + "update").style.display = "inline-block";
    document.getElementById(g3).style.display = "none";
    if (p1.id == (g3 + "pass")) {
      document.getElementById(g3 + "pass").type = 'text';
    } else {
      document.getElementById(g3 + "pass").type = 'password';
    }
    return false;
  }

  function edituid(p9) {
    v5 = p9.id;
    v6 = v5.replace(/\D/g, '');

    document.getElementById("uid_id").value = v6
    document.getElementById("changeuid").value = p9.value
    if (confirm("Confirm to change Asset ID to " + p9.value + "?")) {
      document.getElementById("uidchangeform").submit();

    } else {
      document.getElementById(v6 + "uid").value = document.getElementById(v6 + "olduid").value;
    }

  }

  function hidepass(g6) {
    g6.type = 'password';
  }

  function updatedata(l3) {
    if (confirm("Please confirm to update user.")) {
      document.getElementById(l3 + "form").submit();

    }


  }

  function update_uid(uid1, id1) {
    var xhttp = new XMLHttpRequest();
    url = "https://ttg-photostorage.com/?edituid=true&chuid_uid=" + uid1 + "&chuid_id=" + id1;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText = 'success') {
          alert(url + "Asset ID changed to" + uid1 + id1);
        } else {
          alert("Failed to change Asset ID . Try later");
        }

      }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
  }

  function makezeroundefined(myVariable) {
    if (typeof(myVariable) == "undefined") {
      myVariable = "0";
    }
    return myVariable;
  }

  function openimages_ship(t2) {
    window.open("?shid=" + t2, "_blank", "toolbar=yes, scrollbars=1, resizable=1, top=100, left=500, width=800, height=400");
    //  document.getElementById("mymodalAssign").style.display = "block";
    // document.getElementById("section1").innerHTML = "block";
    //    var x = document.createElement("IFRAME");
    //  x.setAttribute("src", "?shid="+t2);
    //   x.setAttribute("width", "100%");
    //   x.setAttribute("height", "450px");
    //   document.getElementById("section1").innerHTML='';
    //  document.getElementById("section1").appendChild(x);
  }

  function openimages2_ship(t2) {
    //  window.open("?uid="+t2, "_blank", "toolbar=yes, scrollbars=1, resizable=1, top=100, left=500, width=800, height=400");
    document.getElementById("mymodalAssign").style.display = "block";
    // document.getElementById("section1").innerHTML = "block";
    var x = document.createElement("IFRAME");
    x.setAttribute("src", "?hashimages=" + t2);
    x.setAttribute("width", "100%");
    x.setAttribute("height", "450px");
    document.getElementById("section1").innerHTML = '';
    document.getElementById("section1").appendChild(x);
  }

  function open_adduser(t2, t3) {

    t2 = t2.replace(/\D/g, '');
    document.getElementById("mymodalAssign").style.display = "block";

    // document.getElementById("section1").innerHTML = "block";
    var x = document.createElement("IFRAME");
    x.setAttribute("src", "?adduser=" + t2 + "&type=" + t3);
    if (t3 == 'ship') {
      t3 = 'shipping staff';
    }
    document.getElementById("modeltitle").innerHTML = ("Add " + t3).toUpperCase();
    x.setAttribute("width", "100%");
    x.setAttribute("height", "450px");
    document.getElementById("section1").innerHTML = '';
    document.getElementById("section1").appendChild(x);
  }
</script>

<?php
if (($_SESSION['type'] == 'admin') or ($_SESSION['type'] == 'superadmin')) {
?>
  <div id=box2>
    <!--<button type="button" onclick='yprofile()' class="sidebar_btn"><i class="fa fa-address-card" aria-hidden="true"></i> Edit Profile</button><br><br>-->
    <button id="home" type="button" onclick='home()' class="sidebar_btn"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</button><br><br>
    <button id="sships" type="button" onclick='sships()' class="sidebar_btn"><i class="fa fa-truck" aria-hidden="true"></i> Manage Shipments</button><br><br>
    <button id="simages" type="button" onclick='simages()' class="sidebar_btn"><i class="fa fa-database" aria-hidden="true"></i> Manage Data</button><br><br>
    <button id="dasimages" type="button" onclick='da_simages()' class="sidebar_btn"><i class="fa fa-tasks" aria-hidden="true"></i> Defect Analysis</button><br><br>
    <button id="mclient" type="button" onclick='mclient()' class="sidebar_btn"><i class="fa fa-users" aria-hidden="true"></i> Manage Clients</button><br><br>
    <button id="mstaff" type="button" onclick='mstaff()' class="sidebar_btn"><i class="fa fa-user-plus" aria-hidden="true"></i> Testing Staff</button><br><br>
    <button id="mship" type="button" onclick='mship()' class="sidebar_btn"><i class="fa fa-user-plus" aria-hidden="true"></i> Shipping Staff</button><br><br>

    <?php if ($_SESSION['type'] == 'superadmin') {
      echo '<button  id="madmin"  type="button" onclick="madmin()" class="sidebar_btn"><i class="fa fa-diamond" aria-hidden="true"></i> Manage Admins</button><br><br>';
    }
    ?>
    <button id="mactivity" type="button" onclick='mactivity()' class="sidebar_btn"><i class="fa fa-tasks" aria-hidden="true"></i> Activity Logs</button><br><br>

    <!--   <button type="button" onclick='yprofile()'>Edit Profile</button><br><br>
        <button type="button" onclick='epages()'>Edit Pages</button><br><br>
 -->
  </div>
  <script>
    addcurrentclass();
  </script>
  <div id="loader">
  <?php


  //--2. loading relative action file  --//
  if (isset($_GET['p']) or isset($_GET['pq'])) {


    if ($_SESSION['type'] == 'superadmin') {
      if (isset($_GET['pq'])) {
        $actfile = $_GET['pq'];
        if (file_exists($actfile . ".pinc.php")) {
          include $actfile . ".pinc.php";
        }
      }
    }
    if (!$actfile) {
      $actfile = $_GET['p'];
      if (file_exists($actfile . ".inc.php")) {
        include $actfile . ".inc.php";
      } else {
        echo "Invalid Page";
      }
    }
  } else {
    include "home.inc.php";
  }
} else {

  include "cimages.php";
}
  ?>

  <!-- Trigger/Open The modalAssign -->
  <button id="mAssignBtn">Open modalAssign</button>

  <!-- The modalAssign -->
  <div id="mymodalAssign" class="modalAssign">

    <!-- modalAssign content -->
    <div class="modalAssign-content" id="assignmodel">
      <span class="close">&times;</span>
      <div class="ptitle">
        <h1 id="modeltitle">Assign CRN</h1>
      </div>
      <div class="section1" id="section1">
      </div>
    </div>
  </div>
  <style>
    #mAssignBtn {
      display: none;
    }

    /* The modalAssign (background) */
    .modalAssign {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 10px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.2);
      /* Black w/ opacity */
    }

    /* modalAssign Content */
    .modalAssign-content {
      background-color: #fefefe;
      margin: auto;
      padding-top: -10px;
      border: 10px solid #888;
      width: 40%;
      height: 500px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
    }

    .ptitle {
      background-image: linear-gradient(to right, #18416c, #0a4a3f);
      color: #ffffff;
      font-size: 14px;
      padding: 5px 0px 5px 0px;
      text-align: center;
      margin-top: 0px;
    }

    form.example input[type=text] {
      padding: 10px;
      font-size: 14px;
      border: 1px solid grey;
      border-radius: 10px 0px 0px 10px;
      float: left;
      width: 50%;
      background: #ffffff;
    }

    form.example button {
      float: left;
      width: 20%;
      padding: 10px;
      background: #18416c;
      color: white;
      font-size: 21px;
      border: 1px solid grey;
      border-radius: 0px 10px 10px 0px;
      border-left: none;
      cursor: pointer;
    }

    form.example button:hover {
      background: #123152;
    }

    form.example::after {
      content: "";
      clear: both;
      display: table;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      padding: 0px 5px 0px 5px;
      background-color: red;
      color: #ffffff;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    /**   .page_1box {background:#ffffff; padding:7px; width:100%; margin-top:5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);}
            
    .page_2box { padding:7px; width:104%; margin-top:5px; margin-left:-12px;}
    .page_2box>div { width: 48%; height: 170px; vertical-align: top; display: inline-block; *display: inline; zoom: 1; 
		             background:#ffffff; margin:5px; padding:7px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    **/
  </style>

  <script>
    // Get the modalAssign
    var modalAssign = document.getElementById("mymodalAssign");

    // Get the button that opens the modalAssign
    var btn = document.getElementById("mAssignBtn");

    // Get the <span> element that closes the modalAssign
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modalAssign 
    btn.onclick = function() {
      modalAssign.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modalAssign
    span.onclick = function() {
      modalAssign.style.display = "none";
    }

    // When the user clicks anywhere outside of the modalAssign, close it
    window.onclick = function(event) {
      if (event.target == modalAssign) {
        modalAssign.style.display = "none";
      }
    }
  </script>

  </div>