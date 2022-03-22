<?php  ?>

<script>
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
    window.scrollTo(0, document.body.scrollHeight);
    i = 1;
    while (document.getElementById("check" + i)) {
      t8 = document.getElementById("selectall")
      if (t8.checked) {
        document.getElementById("check" + i).checked = true;
      } else {
        document.getElementById("check" + i).checked = '';
      }
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
    width: 60%;
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
    padding: 7px;
    width: 104%;
    margin-left: -12px;
    margin-top: 5px;
    box-shadow: none;
  }

  .page_2box>div {
    width: 48%;
    height: 170px;
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





if (true) {
  $startdate = strtotime($_POST['fromdate']);
  $enddate = strtotime($_POST['todate']);
  $data = search_data_bydate($startdate, $enddate);
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
  $data = search_data_main($_POST['staffid']);
}


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
if (!isset($_GET['s']) or !$_SESSION['simagesdata']) {

  $_SESSION['simagesdata'] = $data;
} else {
  $data = $_SESSION['simagesdata'];
}

// $allclient= array_slice( $loadeddata, 20, 0);
$totalitem = count($data);
$data = array_slice($data, (($pid - 1) * $pageitem), $pageitem);
// pagination 1 end 

$rtv = " <table>
  <tr><th><input type='checkbox' id='selectall' name='all'  onclick='alloff()' value='all'></th> 
    <th>Staff ID</th>
    <th>CRN</th>
    <th>Asset ID</th>
    
    <th>Time</th>
    <th>Files</th>
    <th>Country</th>
    <th colspan='2'>Action</th>
  </tr>";
$h = 1;
foreach ($data as $client) {
  if (isset($client['uid'])) {
    $rtv .= "
  <tr><td><input type='checkbox' id='check" . $h . "' name='all[]' value='" . $client['id'] . "'></td>
    <td id='" . $client['id'] . "userid'>" . $client['userid'] . "</td>
    <td id='" . $client['crn'] . "uid'>" . $client['crn'] . "</td>
    <td> <input id='" . $client['id'] . "uid' class='tablelist' name='chnageuid' value='" . $client['uid'] . "' onchange='edituid(this)' >
     <input id='" . $client['id'] . "olduid' type='hidden' name='olduid' value='" . $client['uid'] . "'  >
     </td>
    
   
    <td id='" . $client['id'] . "time'>" . $today = date("F j, Y, g:i:s a", $client['time']) . "</td>
    <td id='" . $client['id'] . "files'>" . count(json_decode($client['files'])) . "</td>
    
   <td id='" . $client['crn'] . "country'>" . $client['country'] . "</td>
   <td id='" . $client['uid'] . "description'><input type='button' value='View' id='" . base64_encode($client['uid']) . "' href='#'
  onclick='openimages(this.id)' class='btn_edit'/><input type='button' name='delete' value='Delete' onclick='deletedata(" . $client['id'] . ")' class='btn_delete'/>
  
  
  <input class='inputuid' type='text' value='https://ttg-photostorage.com/?uid=" . base64_encode($client['uid']) . "' id='" . $client['uid'] . "text' >
  <div class='tooltip'>
<button id='" . $client['uid'] . "' onclick='copyFunction(this.id)' onmouseout='outFunc(this.id)' class='btn_assign'>
  <span class='tooltiptext' id='" . $client['uid'] . "myTooltip'>Click to copy link</span>Share
  </button>
  </div>
  <div class='tooltip'>
<button id='" . $client['uid'] . "pdfdownload' onclick='ttg_imagepdf(this.id)' onmouseout='outFuncPDF(this.id)' class='btn_assign'>
  <span class='tooltiptext' id='" . $client['uid'] . "pdfdownloadmyTooltip'>Download PDF </span>PDF
  </button>
  
  </div>
  
  
   <div class='tooltip'>
<button id='" . $client['id'] . "' class='btn_assign excel_format'>
  <i class='fa fa-file-excel-o' aria-hidden='true'></i>
  </button>
  
  </div>
  </td>
</tr>";
  }
  $h = $h + 1;
}

$rtv .= " </table><br /><input type='button' name='deleteall' value='Delete All Selected' onclick='deleteselected()' class='btn_delete' />
 <input type='button' name='gen_bulk_pdf' value='Generate PDF' onclick='pdfselected()' class='btn_assign' /><span id='pdf_all' > </span>
 <input type='button' name='gen_bulk_excel' value='Download All Data in EXCEL'  class='btn_assign bulk_excel_format' />
 <input type='button' name='gen_bulk_excel' value='Download Selected Data in EXCEL '  class='btn_assign bulk_excel_selected' />
 
 ";
$pa = pagination($totalitem, $pageitem, $pid);
$rtv .= $pa;

?>

<div class="page_1box">

  <h5 class="title_h5">Search & Replace</h5>
  <hr /><br />
  <p>Replce any CRN or Asset ID</p>
  <form action="?p=simages" method="post" onsubmit="return checkdata()">
    <label for="oldcrn">From:</label>
    <input type="text" id="oldcrn" name="oldcrn" placeholder="Old Value">

    <label for="fromdate">To:</label>
    <input type="newcrn" id="newcrn" name="newcrn" placeholder="New Value">
    <div class="clientradio">
      <input type="radio" id="crn" name="stype" value="crn" checked="checked">
      <label for="crn">CRN</label><br>
      <input type="radio" id="uid" name="stype" value="uid">
      <label for="uid">Asset ID</label>
    </div>
    <input type="submit" name="searchdate" class="searchbtn" value="Replace" style="float:right;">
  </form>
</div>

<div class="page_2box">
  <div>
    <h5 class="title_h5">Search Assets by Attributes</h5>
    <hr /><br />
    <p>Enter Staff ID, CRN, Asset ID, Country</p>
    <form action="?p=simages" method="post">
      <label for="stemail"></label>
      <input type="text" id="stemail" name="staffid" placeholder="Enter CRN/Asset ID/Staff ID "><br /><br />
      <button name="search" value="Search" class="searchbtndate"><i class="fa fa-search"></i> Search</button>
    </form>
    <form id="deleteform" action="?p=simages" method="post">
      <input type="hidden" id="fordelete" name="fordelete">
      <input type="hidden" id="json1" name="json1" value="json">
    </form>
    <form id="uidchangeform" action="?p=simages" method="post">
      <input type="hidden" id="changeuid" name="uid_to_change" value='uid_to_change'>
      <input type="hidden" id="uid_id" name="uid_id" value='uid_id'>

    </form>
  </div>

  <div>
    <h5 class="title_h5">Search Assets by Date Range</h5>
    <hr /><br />
    <p>
    <p>Enter date from & to</p>
    </p>
    <form action="?p=simages" method="post">
      <label for="fromdate">From</label>
      <input type="date" id="fromdate" name="fromdate" placeholder="Start Date ">

      <label for="fromdate">To</label>
      <input type="date" id="todate" name="todate" placeholder="End Date "><br /><br />
      <button name="searchdate" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>
    </form>
  </div>
</div>

<div class="page_1box">
  <h5 class="title_h5">Asset List</h5>
  <hr /><br />
  <?php echo $rtv ?>
</div>

<a href="javascript:void(0)" id="dlbtn" style="display: none;">
  <button type="button" id="mine">Export</button>
</a>
<!-- Trigger/Open The modalAssign -->
<button id="mAssignBtn">Open modalAssign</button>
<!-- The modalAssign -->
<div id="mymodalAssign" class="modalAssign">

  <!-- modalAssign content -->
  <div class="modalAssign-content" id="assignmodel">
    <span class="close">&times;</span>
    <div class="ptitle">
      <h1>View Images</h1>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // $('[data-toggle="popover"]').popover();  


    $('.excel_format').on('click', function() {
      alert("Your Excel file is Generating,  Please wait");
      var id = $(this).attr("id");
      //alert(id);
      var csv = "csv";
      $.ajax({
        type: 'POST',
        url: 'exdata.php',
        data: {
          csv: csv,
          id: id
        },
        success: function(result) {
          console.log(result);
          setTimeout(function() {
            var dlbtn = document.getElementById("dlbtn");
            var file = new Blob([result], {
              type: 'text/csv'
            });
            dlbtn.href = URL.createObjectURL(file);
            dlbtn.download = 'Assets.csv';
            $("#mine").click();
          }, 2000);
        }
      });
    });


    $('.bulk_excel_format').on('click', function() {
      alert("Your Excel file for All Data Generating,  Please wait");
      //alert(elmId);
      var bulkcsv = "bulkcsv";
      $.ajax({
        type: 'POST',
        url: 'exdata.php',
        data: {
          bulkcsv: bulkcsv
        },
        success: function(result) {
          console.log(result);
          setTimeout(function() {
            var dlbtn = document.getElementById("dlbtn");
            var file = new Blob([result], {
              type: 'text/csv'
            });
            dlbtn.href = URL.createObjectURL(file);
            dlbtn.download = 'Assets.csv';
            $("#mine").click();
          }, 2000);
        }
      });
    });


    $('.bulk_excel_selected').on('click', function() {

      //alert(elmId);
      var selectid = "selectid";
      if (confirm("Are you sure you want to export this?")) {
        var id = [];

        $(':checkbox:checked').each(function(i) {
          id[i] = $(this).val();
        });

        if (id.length === 0) //tell you if the array is empty
        {
          alert("Please Select atleast one checkbox");
        } else {
          $.ajax({
            url: 'exdata.php',
            method: 'POST',
            data: {
              selectid: 'selectid',
              id: id
            },

            success: function(result) {
              console.log(result);
              setTimeout(function() {
                var dlbtn = document.getElementById("dlbtn");
                var file = new Blob([result], {
                  type: 'text/csv'
                });
                dlbtn.href = URL.createObjectURL(file);
                dlbtn.download = 'Assets.csv';
                $("#mine").click();
              }, 2000);
            }
          });
        }

      } else {
        return false;
      }
    });


  });
</script>