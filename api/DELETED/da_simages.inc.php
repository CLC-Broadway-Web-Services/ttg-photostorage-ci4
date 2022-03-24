<?php

?>

<script>
  function opencrn(t2) {

    //   t2= t2.replace(/\D/g,'');
    document.getElementById("mymodalAssign").style.display = "block";
    // document.getElementById("section1").innerHTML = "block";
    var x = document.createElement("IFRAME");
    x.setAttribute("src", "?crn=" + t2);
    x.setAttribute("width", "100%");
    x.setAttribute("height", "450px");
    document.getElementById("section1").innerHTML = '';
    document.getElementById("section1").appendChild(x);
  }

  function seemore(h8) {
    var c = h8.childNodes;
    var txt = "";
    var i;
    for (i = 0; i < c.length; i++) {
      c[i].style.display = "unset";
    }
    c[c.length - 1].style.display = "none";
  }

  function submit_the_form() {

    document.getElementById("da_imagesform").submit();
  }

  function rearrange_defects(y5) {
    //   alert(y5);
    y7 = document.getElementById(y5);
    //   alert(y7.checked);

    // allhide();
    if ((y7.id == 'device3') && (y7.checked == true)) {

      document.getElementById("deffect24").style.display = "inline-block";
      document.getElementById("deffect25").style.display = "inline-block";
      document.getElementById("deffect26").style.display = "inline-block";
      document.getElementById("deffect27").style.display = "inline-block";
      document.getElementById("deffect28").style.display = "inline-block";
      document.getElementById("deffect29").style.display = "inline-block";


    }
    if ((y7.id == 'device2') && (y7.checked == true)) {

      document.getElementById("deffect10").style.display = "inline-block";
      document.getElementById("deffect11").style.display = "inline-block";
      document.getElementById("deffect12").style.display = "inline-block";
      document.getElementById("deffect13").style.display = "inline-block";
      document.getElementById("deffect14").style.display = "inline-block";
      document.getElementById("deffect15").style.display = "inline-block";
      document.getElementById("deffect16").style.display = "inline-block";
      document.getElementById("deffect17").style.display = "inline-block";
      document.getElementById("deffect18").style.display = "inline-block";
      document.getElementById("deffect19").style.display = "inline-block";
      document.getElementById("deffect20").style.display = "inline-block";
      document.getElementById("deffect21").style.display = "inline-block";
      document.getElementById("deffect22").style.display = "inline-block";
      document.getElementById("deffect23").style.display = "inline-block";

    }
    if ((y7.id == 'device1') && (y7.checked == true)) {
      document.getElementById("deffect1").style.display = "inline-block";
      document.getElementById("deffect2").style.display = "inline-block";
      document.getElementById("deffect3").style.display = "inline-block";
      document.getElementById("deffect4").style.display = "inline-block";
      document.getElementById("deffect5").style.display = "inline-block";
      document.getElementById("deffect6").style.display = "inline-block";
      document.getElementById("deffect7").style.display = "inline-block";
      document.getElementById("deffect8").style.display = "inline-block";
      document.getElementById("deffect9").style.display = "inline-block";

    }
  }

  function changedevice(y6) {
    allhide();
    rearrange_defects(y6.id);
    alloff();
    submit_the_form();

  }

  function checkdata() {
    if (document.getElementById("newcrn").value == '') {
      return false;
    }

  }

  function deleteselected() {
    var t7 = new Array()
    i = 1;
    e = 0;
    while (document.getElementById("check" + i)) {

      if (document.getElementById("check" + i).checked) {
        t7[i] = document.getElementById("check" + i).value;
        e = e + 1;
      }
      i = i + 1;
    }
    document.getElementById("json1").value = JSON.stringify(t7);
    if (confirm("Please confirm to delete " + e + " enteries.")) {
      // alert(document.getElementById("json1").value);
      document.getElementById("deleteform").submit();
    }

  }

  function alloff() {
    //    window.scrollTo(0, document.body.scrollHeight);
    i = 1;
    while (document.getElementById("defect" + i)) {
      document.getElementById("defect" + i).checked = '';
      i = i + 1;
    }

  }


  function allhide() {
    //    window.scrollTo(0, document.body.scrollHeight);
    i = 1;
    while (document.getElementById("deffect" + i)) {
      document.getElementById("deffect" + i).style.display = 'none';
      i = i + 1;
    }

  }

  function openimages(t2) {
    window.open("?uid=" + encodeURI(t2), "_blank", "toolbar=yes, scrollbars=1, resizable=1, top=100, left=500, width=800, height=400");
    //  document.getElementById("mymodalAssign").style.display = "block";
    // document.getElementById("section1").innerHTML = "block";
    //    var x = document.createElement("IFRAME");
    //  x.setAttribute("src", "?uid="+t2);
    //   x.setAttribute("width", "100%");
    //   x.setAttribute("height", "450px");
    //   document.getElementById("section1").innerHTML='';
    // document.getElementById("section1").appendChild(x);
  }

  function deletedata(id) {
    document.getElementById("fordelete").value = id;
    if (confirm("Please confirm to delete data.")) {
      document.getElementById("deleteform").submit();
    }
  }
  <?php
  if (isset($_POST['device'])) {
    $selected[$_POST['device']] = "checked";
  }


  for ($f = 0; $f < 100; $f++) {
    if (isset($_POST['defect' . $f])) {
      $selected['defect' . $f] = 'checked';
    }
  }



  ?>
  window.onload = function() {
    x = document.getElementsByName("device");
    var i;
    for (i = 0; i < x.length; i++) {
      rearrange_defects(x[i].id);
    }

  }

  function nodefect(y7) {
    alloff();
    y7.checked = true;
    submit_the_form();
  }

  function submit_the_formd() {
    document.getElementById("defect9").checked = false;
    submit_the_form();

  }
</script>

<style>
  #newcrn,
  #oldcrn {
    width: 30%;
    background: #ffffff;
    padding: 10px;
    font-size: 14px;
    border-radius: 10px 10px 10px 10px;
    cursor: text;
  }

  .clientradio {
    display: inline-block;
  }

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
    padding-top: 0px;
    border: 10px solid #888;
    width: 40%;
    height: 550px;
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

  .ptitle {
    background-image: linear-gradient(to right, #18416c, #0a4a3f);
    color: #ffffff;
    font-size: 14px;
    padding: 5px 0px 5px 0px;
    text-align: center;
    margin-top: 0px;
  }

  /** .section1 { width: 80%; margin: 10px auto;  padding: 20px; border: 1px solid #18416c; border-radius: 2px; } **/


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

  .page_1box {
    background: #ffffff;
    padding: 7px;
    width: 100%;
    margin-top: 5px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  }

  .page_2box {
    margin-left: -12px;
    width: 48%;
    height: 370px;
    vertical-align: top;
    display: inline-block;
    *display: inline;
    zoom: 1;
    background: #ffffff;
    margin: 5px;
    padding: 7px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  }
</style>

<?php

if (isset($_POST['fordelete'])) {
  $todelete = json_decode(html_entity_decode($_POST['json1']));
  $du = 0;

  foreach ($todelete as $dts) {
    if ($dts) {
      deletepost($dts);
      $du = $du + 1;
    }
  }
  if ($du) {
    echo "<div id='sucessBlock'>Success:" . $du . " Records(s) Deleted Successfully<br></div>";
  } else
  if (deletepost($_POST['fordelete'])) {
    echo "<div id='successBlock'><b>Data Deleted Successfully!<br></div>";
  }
}
if ($_POST['stype'] == 'crn') {
  if (update_crn($_POST['newcrn'], $_POST['oldcrn'])) {
    echo "<div id='sucessBlock'>Success:" . $du . " CRN Replaced successfully !<br></div>";
  } else {
    echo "<div id='errorBlock'>Error:" . $du . " Invalid CRN<br></div>";
  }
}

if ($_POST['stype'] == 'uid') {
  if (update_uid($_POST['newcrn'], $_POST['oldcrn'])) {
    echo "<div id='sucessBlock'>Success: Asset ID Replaced successfully !<br></div>";
  } else {
    echo "<div id='errorBlock'>Error: Invalid Asset ID<br></div>";
  }
}






if (isset($_POST['uid_to_change'])) {
  $key = array_search($_POST['uid_id'], array_column($data, 'id'));
  if (update_uid_by_id($_POST['uid_to_change'], $_POST['uid_id'])) {
    echo "<div id='sucessBlock'>Success: Asset ID edited successfully !<br></div>";
    $data = search_data_byuserid($_POST['uid_to_change']);
  } else {
    echo "<div id='errorBlock'>Error: Failed to edit  Asset ID<br></div>";
    $data = search_data_byuserid($data[$key]['uid']);
  }
}

if (isset($_POST['staffid'])) {
  for ($r = 1; $r < 35; $r++) {
    if ($_POST['defect' . $r] != '') {
      $defects[] = $_POST['defect' . $r];
    }
  }

  $data = search_data_defect_analysis($_POST['staffid'], $defects, $_POST['device']);

  if ($_POST['staffid'] == '') {

    $data = empty_search_defect($_POST['device'], $defects);
  }
} else {
  $data = defect_search_data_bydate('', '');
}

$startdate = strtotime($_POST['fromdate']);
$enddate = strtotime($_POST['todate']);
$data = sort_by_date($data, $startdate, $enddate);
//pagination 1 start

$pageitem = 20;
if (isset($_POST['epp'])) {
  $_SESSION['epp'] = $_POST['epp'];
}
if (isset($_SESSION['epp'])) {
  $pageitem = $_SESSION['epp'];
}
$totalitem = 0;

if (isset($_GET['s'])) {
  $pid = $_GET['s'];
} else {
  $pid = 1;
}
if (!isset($_GET['s']) or !$_SESSION['da_simagesdata']) {

  $_SESSION['da_simagesdata'] = $data;
} else {
  $data = $_SESSION['da_simagesdata'];
}

// $allclient= array_slice( $loadeddata, 20, 0);
$totalitem = count($data);
$data = array_slice($data, (($pid - 1) * $pageitem), $pageitem);
// pagination 1 end 

$rtv = " <table>
  <tr>
    <th>Staff ID</th>
    <th>CRN</th>
    <th>Asset ID</th>
    
    <th>Time</th>
    <th>Device Type </th>
    <th colspan='2'>Defects</th>
  </tr>";
$h = 1;
foreach ($data as $client) {
  if (isset($client['uid'])) {
    $rtv .= "
  <tr>
    <td id='" . $client['id'] . "userid'>" . $client['userid'] . "</td>
    <td  onclick='opencrn(this.id)' id='" . $client['crn'] . "'><a class='crnlink' href='#' > " . $client['crn'] . "</a></td>
    <td> <input id='" . $client['id'] . "uid' class='tablelist' name='chnageuid' value='" . $client['uid'] . "' onchange='edituid(this)' >
     <input id='" . $client['id'] . "olduid' type='hidden' name='olduid' value='" . $client['uid'] . "'  >
     </td>
    
   
    <td id='" . $client['id'] . "time'>" . $today = date("F j, Y, g:i:s a", $client['time']) . "</td>
  
  
   <td id='" . $client['uid'] . "description'> " . $client['device_type'] . "
  </td>
    <td onload='seemore(this.id)' id='" . $client['id'] . "files'>" . seemore($client['defect']) . "</td>
</tr>";
  }
  $h = $h + 1;
}

$rtv .= " </table><br />";
$pa = pagination($totalitem, $pageitem, $pid);
$rtv .= $pa;

?>

<div class="page_1box">
  <h5 class="title_h5">CRN List</h5>
  <hr />
  <?php
  $crn_stats = crn_stats();
  ?>
  <div class="slide_crn">
    <div class="marquee">
      <?php
      foreach ($crn_stats as $rft) {
        echo '<div class="subslide_crn">';
        echo '<p> <b>CRN </b>:<span  onclick="opencrn(this.innerHTML)" class="crnlink"  >' . $rft['crn'] . '</span></p>';
        echo '<p>';

        foreach ($rft['states']['parms'] as $key => $value) {
          echo '<b>' . $key . '</b>: ' . $value . '   ';
        }
        echo '</p></div>';
      }
      ?>
    </div>
  </div>
</div>

<div class="page_2box">
  <form id="da_imagesform" action="?p=da_simages" method="post">

    <h5 class="title_h5">Search Data</h5>
    <hr /><br />
    <p>Search Data by CRN, Asset ID, Staff ID, Country</p>


    <label for="stemail"></label>
    <input type="text" id="stemail" name="staffid" placeholder="Enter CRN/Asset ID/Staff ID " value="<?php echo $_POST['staffid']; ?>"><br /><br />
    <button name="search" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>
    <br /><br />
    <hr /><br />

    <p>Search Data by Date Range</p>

    <label for="fromdate">From:</label>
    <input type="date" id="fromdate" name="fromdate" placeholder="Start Date " value="<?php echo $_POST['fromdate']; ?>">

    <label for="fromdate">To:</label>
    <input type="date" id="todate" name="todate" placeholder="End Date " value="<?php echo $_POST['todate']; ?>"><br /><br />
    <button name="searchdate" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>



</div>

<div class="page_2box">
  <h5 class="title_h5">Sort Data</h5>
  <hr /><br />

  <div class="devices custom-select">
    <p id="select_device_type">Select Device Type</p>
    <div>
      <label class="defect" for="device1"><input onchange="changedevice(this)" type="radio" id="device1" name="device" value="Desktop" <?php echo $selected['Desktop']; ?>>Desktop</label>
      <label class="defect" for="device2"><input onchange="changedevice(this)" type="radio" id="device2" name="device" value="Notebook" <?php echo $selected['Notebook']; ?>>Notebook</label>
      <label class="defect" for="device3"><input onchange="changedevice(this)" type="radio" id="device3" name="device" value="Other Device" <?php echo $selected['Other Device']; ?>>Other Device</label>
    </div>
  </div>
  <hr />
  <p>Select Defect</p>
  <div class="defects">
    <p id="select_defect_type">Select Defect Type</p>
    <?php echo list_defect($selected)['radio'] ?>
  </div>

  </form>
</div>

<div class="page_1box">
  <h5 class="title_h5">Asset List</h5>
  <hr /><br />
  <?php echo $rtv ?>
</div>


<!-- Trigger/Open The modalAssign -->
<button id="mAssignBtn">Open modalAssign</button>
<!-- The modalAssign -->
<div id="mymodalAssign" class="modalAssign">

  <!-- modalAssign content -->
  <div class="modalAssign-content" id="assignmodel">
    <span class="close">&times;</span>
    <div class="ptitle">
      <h1>CRN DATA</h1>
    </div>
    <div class="section1" id="section1">
    </div>
  </div>
</div>


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

<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();
  });
</script>