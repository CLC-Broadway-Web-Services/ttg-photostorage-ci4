<?php  ?>

<script>
function checkdata()
{
    if(document.getElementById("newcrn").value=='')
    {
        return false;
    }
    
}
function deleteselected()
    {
         var t7 = new Array()
          i=1;
          e=0;
while(document.getElementById("check"+i))
{

if(document.getElementById("check"+i).checked)
{
t7[i]=document.getElementById("check"+i).value;
e=e+1;
}
i=i+1;
}
 document.getElementById("json1").value=JSON.stringify(t7);
  if(confirm("Please confirm to delete "+e+" enteries."))
  {
     // alert(document.getElementById("json1").value);
  document.getElementById("deleteform").submit();
  }
  
  }
  
  function alloff() {
      window.scrollTo(0, document.body.scrollHeight);
     i=1;
while(document.getElementById("check"+i))
{
    t8=document.getElementById("selectall")
if(t8.checked)
{
document.getElementById("check"+i).checked=true;
}
else
{
  document.getElementById("check"+i).checked='';  
}
i=i+1;
}
   
}


function deletedata(id)
{
document.getElementById("fordelete").value=id;
if(confirm("Please confirm to delete data."))
{
document.getElementById("deleteform").submit();
}
}


function change_condition(gid)
{
document.getElementById("change_box").value=gid.value;
document.getElementById("box_hash").value=gid.id;

if(confirm("Please confirm to change packaging quality."))
{
document.getElementById("boxchangeform").submit();
}
}
</script>

<style>
    #newcrn, #oldcrn { width: 30%; background: #ffffff; padding: 10px; font-size: 14px; border-radius: 10px 10px 10px 10px; cursor: text; }
    
    .clientradio { display:inline-block; }

    #mAssignBtn { display:none; }

    /* The modalAssign (background) */
    .modalAssign {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 10px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.2); /* Black w/ opacity */
    }

    /* modalAssign Content */
    .modalAssign-content { background-color: #fefefe; margin: auto; padding-top: 0px; border: 10px solid #888; width: 60%; height:550px; box-shadow:0 2px 6px rgba(0, 0, 0, 0.5); }

    .ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; font-size: 14px; padding: 5px 0px 5px 0px; text-align: center; margin-top: 0px; }

/** .section1 { width: 80%; margin: 10px auto;  padding: 20px; border: 1px solid #18416c; border-radius: 2px; } **/

			
form.example input[type=text] { padding: 10px; font-size: 14px; border: 1px solid grey; border-radius: 10px 0px 0px 10px; float: left; width: 50%; background: #ffffff; }

form.example button { float: left; width: 20%; padding: 10px; background: #18416c; color: white; font-size: 21px; border: 1px solid grey; border-radius: 0px 10px 10px 0px; border-left: none; cursor: pointer; }

form.example button:hover { background: #123152; }

form.example::after { content: ""; clear: both; display: table; }

/* The Close Button */
.close { color: #aaaaaa; float: right; font-size: 28px; font-weight: bold; padding: 0px 5px 0px 5px; background-color:red; color: #ffffff;}
.close:hover, .close:focus { color: #000; text-decoration: none; cursor: pointer; }


td:nth-child(6n) { text-align:right; padding-right:45px; }  

    .page_1box {background:#ffffff; padding:7px; width:100%; margin-top:5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);}
    
    .page_2box { padding:7px; width:104%; margin-left:-12px; margin-top:5px; box-shadow:none; }
    .page_2box>div { width: 48%; height: 170px; vertical-align: top; display: inline-block; *display: inline; zoom: 1; 
		            background:#ffffff; margin:5px; padding:7px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }

</style>

<?php

if(isset($_POST['fordelete']))
  {
      $todelete=json_decode(html_entity_decode($_POST['json1']));
    $du=0;
 
    foreach($todelete as $dts)
    {
        if($dts)
        {
        deletepost($dts);
        $du=$du+1;
        }
    }
    if($du)
    {
    echo "<div id='sucessBlock'>Success:".$du." Records(s) Deleted Successfully<br></div>";
    }else
  if(delete_shipment($_POST['fordelete']))
  {
  echo "<div id='successBlock'><b>Data Deleted Successfully!<br></div>";

  
  }
  
  
  }

if(isset($_POST['changebox']))
{
    $condition=$_POST['changebox'];
    $hash=$_POST['box_hash'];
if(change_box_condition($condition,$hash))

 echo "<div id='sucessBlock'>Packaging Quality changed successfully !<br></div>";
}




if(true)
{
$startdate=strtotime($_POST['fromdate']);
$enddate=strtotime($_POST['todate']);
$data=search_shipment_bydate($startdate,$enddate);
// print_r($data);
}


if(isset($_POST['staffid']))
{
$data=search_shipment_byuserid($_POST['staffid']);


}


 //pagination 1 start

$pageitem=20;
if(isset($_POST['epp']))
{
  $_SESSION['epp']=$_POST['epp'];
}
if(isset($_SESSION['epp']))
  {
    $pageitem=$_SESSION['epp'];
  }
$totalitem=0;
        
        if(isset($_GET['s']))
        	{
        		$pid=$_GET['s'];
        	}
        	else
        	{
        		$pid=1;
        	}
if(!isset($_GET['s']) OR !$_SESSION['sshipsdata'])
{

        $_SESSION['sshipsdata']= $data;	
}
else
{
	$data=$_SESSION['sshipsdata'];
}
        
       // $allclient= array_slice( $loadeddata, 20, 0);
 $totalitem=count( $data);
 $data= array_slice( $data, (($pid-1)*$pageitem), $pageitem );
 // pagination 1 end 

$rtv= " <table>
  <tr><th><input type='checkbox' id='selectall' name='all'  onclick='alloff()' value='all'></th>
    <th>Staff ID</th>
    <th>CRN</th>
    <th>Date & Time</th>
     <th> Logistic Company </th>
     <th> Packaging Quality </th>
    <th colspan='2'>Action</th>
  </tr>";
  $h=1;
  foreach($data as $client)
  {
      if(isset($client['crn']))
      {
          if(strtoupper($client['is_reject'])=='YES')
          {
             $class= 'class="Rejected"' ;
             $client['box_condition']='Rejected';
             $client['logistic_company']='----------';
          }
          else
          {
            $class= 'class="nor_mal"'   ;
          }
  $rtv.="
  <tr><td colspan=‘2’ width=‘301’><input type='checkbox' id='check".$h."' name='all' value='".$client['id']."'></td>
    <td id='".$client['id']."userid'>".$client['userid']."</td>
    <td ".$class." id='".$client['crn']."uid'>".$client['crn']."</td>
    <td ".$class." id='".$client['id']."time'>".date("F j, Y, g:i a",$client['ship_time'])."</td>
      <td ".$class." id='".$client['hash']."uid'>".$client['logistic_company']."</td>
       <td id='".$client['hash']."uid'>".box_condition($client['box_condition'],$client['hash'])."</td>
   <td id='".$client['uid']."description'><input type='button' value='View' id='".base64_encode($client['hash'])."' href='#'
  onclick='openimages_ship(this.id)' class='btn_edit'/><input type='button' name='delete' value='Delete' onclick='deletedata(".$client['id'].")' class='btn_delete'/>
  
  
  <input class='inputuid' type='text' value='https://ttg-photostorage.com/?shid=".base64_encode($client['hash'])."' id='".$client['hash']."text' >
  <div class='tooltip'>
<button id='".$client['hash']."' onclick='copyFunction(this.id)' onmouseout='outFunc(this.id)' class='btn_assign'>
  <span class='tooltiptext' id='".$client['hash']."myTooltip'>Click to copy link</span>Share
  </button>
  </div>
  </td>
</tr>";
      }
      $h=$h+1;
  }
 
 $rtv.=" </table><br /><input type='button' name='deleteall' value='Delete All Selected' onclick='deleteselected()' class='btn_delete' />";
  $pa=pagination($totalitem,$pageitem,$pid);
$rtv.=$pa;
 
?>

<div class="page_2box">
    <div>
        <h5 class="title_h5">Search Shipment by Attributes</h5><hr /><br />
        <p>Search shipment by Staff ID, CRN, Country</p>
        <form action="?p=sships" method="post">
            <label for="stemail"></label>
            <input type="text" id="stemail" name="staffid" placeholder="Enter CRN/Staff ID " ><br /><br />
            <button name="search" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>
        </form>
        
        <form id="deleteform" action="?p=sships" method="post">
            <input type="hidden" id="fordelete" name="fordelete" >
            <input type="hidden" id="json1" name="json1" value="json">
        </form>
         <form id="boxchangeform" action="?p=sships" method="post">
            <input type="hidden" id="change_box" name="changebox" value='uid_to_change' >
            <input type="hidden" id="box_hash" name="box_hash" value='uid_id' >
            
        </form>
    </div>

    <div>
        <h5 class="title_h5">Search Shipment by Date Range</h5><hr /><br />
        <p>Enter date from & to</p>
        <form action="?p=sships" method="post">
            <label for="fromdate">From</label>
            <input type="date" id="fromdate" name="fromdate" placeholder="Start Date ">
    
            <label for="fromdate">To</label>
            <input type="date" id="todate" name="todate" placeholder="End Date "><br /><br />
            <button name="searchdate" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>
        </form>
  
    </div>
</div>

<div class="page_1box">
    <h5 class="title_h5">Shipment List</h5><hr /><br />
    <?php echo $rtv ?>
</div>


<!-- Trigger/Open The modalAssign -->
<button id="mAssignBtn">Open modalAssign</button>
<!-- The modalAssign -->
<div id="mymodalAssign" class="modalAssign">

  <!-- modalAssign content -->
  <div class="modalAssign-content" id="assignmodel">
    <span class="close">&times;</span>
		<div class="ptitle" >
			<h1>View Images</h1>
		</div>
    		<div class="section1" id="section1" >
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
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
