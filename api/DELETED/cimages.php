<?php  ?>

<script>
function showshipment(h6)
{
  if(h6.innerHTML=="Show shipments")
  {
      
     document.getElementById("crndata").style.display='none';
     document.getElementById("crnshipment").style.display='block';
     document.getElementById("changebutton").innerHTML="Show CRN Data";
  }else
  {
     document.getElementById("crnshipment").style.display='none';
     document.getElementById("crndata").style.display='block';
     document.getElementById("changebutton").innerHTML="Show shipments"; 
  }
}
function loadbar()
{
    tcrn=false;
    tuid=false;
    if(document.getElementById("crn").checked)
    {
        tcrn=true;
    }
    if(document.getElementById("uid").checked)
    {
        tuid=true;
    }
    
    
    if(tcrn)
    {
        document.getElementById("searchbar").style.display="block";
        document.getElementById("slable").innerHTML="";
        document.getElementById("stemail").placeholder="Enter CRN";
    }
    
    if(tuid)
    {
        document.getElementById("searchbar").style.display="block";
        document.getElementById("slable").innerHTML="";
        document.getElementById("stemail").placeholder="Enter Asset ID";
    }
}

window.setInterval(function(){
  loadbar();
}, 5);
function openimages(t2) {
    window.open("?uid="+t2, "_blank", "toolbar=yes, scrollbars=1, resizable=1, top=100, left=500, width=800, height=400");
   //   document.getElementById("mymodalAssign").style.display = "block";
  // document.getElementById("section1").innerHTML = "block";
  //  var x = document.createElement("IFRAME");
//  x.setAttribute("src", "?uid="+t2);
//   x.setAttribute("width", "100%");
//   x.setAttribute("height", "450px");
//   document.getElementById("section1").innerHTML='';
//  document.getElementById("section1").appendChild(x);
}
function checkdata()
{
    if(document.getElementById("stemail").value=='')
    {
        return false;
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
</script>
<style>
   #mAssignBtn
{
    display:none;
}

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

.ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; font-size: 14px; padding: 5px 0px 5px 0px; text-align: center; margin-top: 0px; }

/** .section1 { width: 80%; margin: 10px auto;  padding: 20px; border: 1px solid #18416c; border-radius: 2px; } **/

			
form.example input[type=text] { padding: 10px; font-size: 14px; border: 1px solid grey; border-radius: 10px 0px 0px 10px; float: left; width: 50%; background: #ffffff; }

form.example button { float: left; width: 20%; padding: 10px; background: #18416c; color: white; font-size: 21px; border: 1px solid grey; border-radius: 0px 10px 10px 0px; border-left: none; cursor: pointer; }

form.example button:hover { background: #123152; }

form.example::after { content: ""; clear: both; display: table; }

/* The Close Button */
.close { color: #aaaaaa; float: right; font-size: 28px; font-weight: bold; padding: 0px 5px 0px 5px; background-color:red; color: #ffffff;}
.close:hover, .close:focus { color: #000; text-decoration: none; cursor: pointer; }

    
#searchbar
{
 display:none;
}

th {
    text-align:left;
}

.AssetList {
    background:#102c4a;
    text-align:center;
    font-size:16px bold;
}
.cbtn_view {
    background:#ffffff;
    border:1px solid #1E90FF;
    color:#1E90FF;
    cursor:pointer;
}

.cbtn_view:hover {
    background:#1E90FF;
    border:1px solid #1E90FF;
    color:#ffffff;
    cursor:pointer;
}

.ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; text-align: center; padding: 15px 0px 15px 0px; }

			.panel { margin-top: 10px; }
			
			.section2 { width: 50%; margin: 0 auto; background-color: rgba(24, 65, 108, 0.3); padding: 40px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
			
			/* The ctpanel */
			.ctpanel { display: block; position: relative; padding-left: 35px; margin-bottom: 12px; cursor: pointer; font-size: 16px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
			/* Hide the browser's default radio button */
			.ctpanel input { position: absolute; opacity: 0; cursor: pointer; }
			/* Create a custom radio button */
			.checkmark { position: absolute; top: 0; left: 0; height: 25px; width: 25px; background-color: #eee; border-radius: 50%; }
			/* On mouse-over, add a grey background color */
			.ctpanel:hover input ~ .checkmark { background-color: #ccc; }
			/* When the radio button is checked, add a blue background */
			.ctpanel input:checked ~ .checkmark { background-color: #18416c; }
			/* Create the indicator (the dot/circle - hidden when not checked) */
			.checkmark:after { content: ""; position: absolute; display: none; }
			/* Show the indicator (dot/circle) when checked */
			.ctpanel input:checked ~ .checkmark:after { display: block; }
			/* Style the indicator (dot/circle) */
			.ctpanel .checkmark:after { top: 9px; left: 9px; width: 8px; height: 8px; border-radius: 50%; background: white; }
			
			.section2 { float:left; width: 50%; margin-left: 25%; margin-top: 10px; background-color: rgba(24, 65, 108, 0.3); padding: 40px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
			
			form.example input[type=text] { padding: 15px; font-size: 14px; border: 1px solid grey; border-radius: 10px 0px 0px 10px; float: left; width: 50%; background: #ffffff; }

            form.example button { float: left; width: 20%; padding: 6px; background: #18416c; color: white; font-size: 21px; border: 1px solid grey; border-radius: 0px 10px 10px 0px; border-left: none; cursor: pointer; }

            form.example button:hover { background: #123152; }

            form.example::after { content: ""; clear: both; display: table; }
			
			.section3 { width: 80%; margin: 10px auto; background-color: rgba(24, 65, 108, 0.3); padding: 40px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
			.shipbutton {
    width: 20%;
    margin: 10px auto;
    background-color: rgba(24, 65, 108, 0.3);
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
#crnshipment
{
    display:none;
}
</style>

<?php
//print_r($_POST);
if(!isset($_SESSION['stype_uid']))
{
//$_SESSION['stype_uid']='checked';
}


if(isset($_POST['staffid']) AND ($_POST['staffid']!=''))
{
  if($_POST['stype']=='crn')
  {
      $_SESSION['stype_crn']='checked';
      $_SESSION['stype_uid']='';
$data=search_data_crn($_POST['staffid'],$_SESSION['userid']);
  }
  else
  {
      $_SESSION['stype_crn']='';
      $_SESSION['stype_uid']='checked';
    $data=$data=search_authuid($_POST['staffid'],$_SESSION['userid']);
  }

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
if(!isset($_GET['s']) OR !$_SESSION['cimagesdata'])
{

        $_SESSION['cimagesdata']= $data;	
}
else
{
	$data=$_SESSION['cimagesdata'];
}
        
       // $allclient= array_slice( $loadeddata, 20, 0);
 $totalitem=count( $data);
 $data= array_slice( $data, (($pid-1)*$pageitem), $pageitem );
 // pagination 1 end 
$rtv= " <table>
        <tr><th colspan='6' class='AssetList'>Asset ID List</tr>
        <tr> <th><input type='checkbox' id='selectall' name='all'  onclick='alloff()' value='all'></th>
        <th>CRN </th>
        <th>Asset ID</th>
        <th>Upload Time</th>
        <th>No. of Files</th>
        <th>Action</th>
    
  </tr>";
  $h=1;
  foreach($data as $client)
  {
      if(isset($client['uid']))
      {
  $rtv.="
  <tr><td><input type='checkbox' id='check".$h."' name='all' value='".$client['id']."'></td>
    <td id='".$client['id']."crn'>".$client['crn']."</td>
    <td id='".$client['id']."uidx'><input id='".$client['id']."uid' class='tablelist' type='hidden' name='chnageuid' value='".$client['uid']."'  >".$client['uid']."</td>
    <td id='".$client['id']."time'>".$today = date("F j, Y, g:i:s a",$client['time'])."</td>
    <td id='".$client['id']."files'>".count(json_decode($client['files']))."</td>
    <td id='".$client['uid']."description'>
        <input type='button' value='View' id='".base64_encode($client['uid'])."' href='#' onclick='openimages(this.id)' class='btn_edit'/>
        <input class='inputuid' type='text' value='https://ttg-photostorage.com/?uid=".base64_encode($client['uid'])."' id='".$client['uid']."text'>
        <div class='tooltip'>
        <button id='".$client['uid']."' onclick='copyFunction(this.id)' onmouseout='outFunc(this.id)' class='btn_assign'>
            <span class='tooltiptext' id='".$client['uid']."myTooltip'>Click to copy link</span>Share
        </button>
    </div>
     <div class='tooltip'>
<button id='".$client['uid']."pdfdownload' onclick='ttg_imagepdf(this.id)' onmouseout='outFuncPDF(this.id)' class='btn_assign'>
  <span class='tooltiptext' id='".$client['uid']."pdfdownloadmyTooltip'>Download PDF </span>PDF
  </button>
  </div>
   <div class='tooltip'>
<button id='".$client['id']."' class='btn_assign excel_format'>
  <i class='fa fa-file-excel-o' aria-hidden='true'></i>
  </button>
  
  </div>
    </td>

</tr>";
      }
      $h=$h+1;
  }
 $rtv.=" </table><br /><input type='button' name='deleteall' value='Delete All Selected' onclick='deleteselected()' class='btn_delete' />
 <input type='button' name='gen_bulk_pdf' value='Generate PDF' onclick='pdfselected()' class='btn_assign' /><span id='pdf_all' > </span>
 <input type='button' name='gen_bulk_excel' value='Download All Data in EXCEL'  class='btn_assign bulk_excel_format' />
 <input type='button' name='gen_bulk_excel' value='Download Selected Data in EXCEL '  class='btn_assign bulk_excel_selected' />
 
 ";
 $pa=pagination($totalitem,$pageitem,$pid);
$rtv.="".$pa;
?>


<?php
/** shipment start **/ 
if(isset($_POST['staffid']))
{
$data1=get_shipment($_POST['staffid']);

}
// print_r($data1);

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

        $_SESSION['sshipsdata']= $data1;	
}
else
{
	$data1=$_SESSION['sshipsdata'];
}
        
       // $allclient= array_slice( $loadeddata, 20, 0);
 $totalitem=count( $data1);
 $data1= array_slice( $data1, (($pid-1)*$pageitem), $pageitem );
 // pagination 1 end 

$rtv1= " <table>
<tr><th colspan='7' class='AssetList'>Shipments List<th></tr><tr>
    <th>Staff ID</th>
    <th>CRN</th>
    <th>Date & Time</th>
     <th> Logistic Company </th>
     <th> Packaging Quality </th>
    <th colspan='2'>Action</th>
  </tr>";
  $h1=1;
  foreach($data1 as $client)
  {
      if(isset($client['crn']))
      {
          if($client['is_reject']=='yes')
          {
             $class= 'class="Rejected"' ;
             $client['box_condition']='Rejected';
             $client['logistic_company']='----------';
          }
          else
          {
            $class= 'class="nor_mal"'   ;
          }
  $rtv1.="
    
    <td id='".$client['id']."userid'>".$client['userid']."</td>
    <td ".$class." id='".$client['crn']."uid'>".$client['crn']."</td>
    <td ".$class." id='".$client['id']."time'>".date("F j, Y, g:i:s a",$client['ship_time'])."</td>
      <td ".$class." id='".$client['hash']."uid'>".$client['logistic_company']."</td>
       <td id='".$client['hash']."uid'>".box_condition($client['box_condition'],$client['hash'])."</td>
   <td id='".$client['uid']."description'><input type='button' value='View' id='".base64_encode($client['hash'])."' href='#'
  onclick='openimages_ship(this.id)' class='btn_edit'/>
  
  
  <input class='inputuid' type='text' value='https://ttg-photostorage.com/?shid=".base64_encode($client['hash'])."' id='".$client['hash']."text' >
  <div class='tooltip'>
<button id='".$client['hash']."' onclick='copyFunction(this.id)' onmouseout='outFunc(this.id)' class='btn_assign'>
  <span class='tooltiptext' id='".$client['hash']."myTooltip'>Click to copy link</span>Share
  </button>
  </div>
   <div class='tooltip'>
<button id='".$client['id']."' class='btn_assign excel_format'>
  <i class='fa fa-file-excel-o' aria-hidden='true'></i>
  </button>
  
  </div>
   
  </td>
</tr>";
      }
      $h1=$h+1;
  }
 
  $pa=pagination($totalitem,$pageitem,$pid);
$rtv1.="</table>".$pa;
 /**  shipment end **/ 
?>


<div class="ptitle">
		<h1>Search Data</h1>
   </div>
	
	<div class="panel">
	<form class="example" action="?p=simages" method="post" onsubmit="return checkdata()">
		<div class="section2">
		    
			<h3>Please choose any option to get result.</h3><br />
			
				<label class="ctpanel" for="crn">Search result by CRN
				<input type="radio" id="crn" name="stype" value="crn" onchange="loadbar()"  <?php echo $_SESSION['stype_crn']; ?>>
				<span class="checkmark"></span>
				</label>
				<label class="ctpanel" for="uid">Search result by Asset ID
				<input type="radio" id="uid" name="stype" value="uid" onchange="loadbar()" <?php echo $_SESSION['stype_uid']; ?>>
				<span class="checkmark"></span>
				</label>
			
		</div>
		
			
		<div class="section2" id="searchbar" >
		    
			
				<h3 id="slable" >Type CRN/Asset ID</h3><br />
				
				<input type="text" id="stemail" class="csearchdata" name="staffid" placeholder="Search..">
				<button type="submit" id="send"><i class="fa fa-search"></i></button>
			
		</div>
		</form>
	<div class="shipbutton" id="changebutton" onclick="showshipment(this)">Show shipments</div>	
		<div class="section3" id="crndata">
            

            <?php
                if($data) 
                 { 
                    if($h!=2)
                     {
                     echo $rtv;
                     
                    }
                    else
                     {
                     echo "No data found !";
                    }

                    }elseif($_POST['staffid'])
                    {
                    echo "No data found !";
                }
                ?>
                </div>
               <div class="section3" id="crnshipment">
                <?php
                
                if($data1) 
                 { 
                    if($h1!=2)
                     {
                     
                     echo $rtv1;
                      
                    }
                    else
                     {
                     echo "No data found !";
                    
                    }

                    }elseif($_POST['staffid'])
                    {
                    echo "No data found !";
                    
                }
            ?>

		    
		    
        </div>

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

// <script>
// $(document).ready(function(){
//     $('[data-toggle="popover"]').popover();   
// });
// </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
    // $('[data-toggle="popover"]').popover();  
    
    
    $('.excel_format').on('click', function(){
        alert("Your Excel file is Generating,  Please wait");
    var id = $(this).attr("id");
    //alert(id);
	var csv = "csv";
	$.ajax({
		type: 'POST',
		url: 'exdata.php',
		data: {csv:csv, id:id},
	    success: function(result) {
	      console.log(result);
	      setTimeout(function() {
				  var dlbtn = document.getElementById("dlbtn");
				  var file = new Blob([result], {type: 'text/csv'});
				  dlbtn.href = URL.createObjectURL(file);
				  dlbtn.download = 'Assets.csv';
				  $( "#mine").click();
				}, 2000);
	    }
	});
    });


$('.bulk_excel_format').on('click', function(){
alert("Your Excel file for All Data Generating,  Please wait");
    //alert(elmId);
	var bulkcsv = "bulkcsv";
	$.ajax({
		type: 'POST',
		url: 'exdata.php',
		data: {bulkcsv:bulkcsv},
	    success: function(result) {
	      console.log(result);
	      setTimeout(function() {
				  var dlbtn = document.getElementById("dlbtn");
				  var file = new Blob([result], {type: 'text/csv'});
				  dlbtn.href = URL.createObjectURL(file);
				  dlbtn.download = 'Assets.csv';
				  $( "#mine").click();
				}, 2000);
	    }
	});
    });
    
    
    $('.bulk_excel_selected').on('click', function(){

    //alert(elmId);
    var selectid = "selectid";
	 if(confirm("Are you sure you want to export this?"))
  {
    var id = [];

        $(':checkbox:checked').each(function(i){
            id[i] = $(this).val();
        });

    if(id.length === 0) //tell you if the array is empty
        {
            alert("Please Select atleast one checkbox");
        }
    else
        {
            $.ajax({
            url:'exdata.php',
            method:'POST',
            data:{selectid:'selectid',id:id},
            
           success: function(result) {
	      console.log(result);
	      setTimeout(function() {
				  var dlbtn = document.getElementById("dlbtn");
				  var file = new Blob([result], {type: 'text/csv'});
				  dlbtn.href = URL.createObjectURL(file);
				  dlbtn.download = 'Assets.csv';
				  $( "#mine").click();
				}, 2000);
	    }
    });
   }

  }
  else
  {
   return false;
  }
 });

    
});





</script>