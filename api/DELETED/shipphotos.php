<?php
// die("underconstruction");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shipment Details</title>
    <link rel="stylesheet" href="https://ttg-photostorage.com/lightbox/lightbox/dist/css/lightbox.min.css">
  <script>
function openimages2_ship(t2) {
     document.getElementById("photos").style.display="unset";
     var elmnt = document.getElementById("photos");
  elmnt.scrollIntoView();
     
  //  window.open("?hashimages="+t2, "_blank", "toolbar=yes, scrollbars=1, resizable=1, top=100, left=500, width=800, height=400");
   //   document.getElementById("mymodalAssign").style.display = "block";
  // document.getElementById("section1").innerHTML = "block";
  //  var x = document.createElement("IFRAME");
 // x.setAttribute("src", "?hashimages="+t2);
//   x.setAttribute("width", "100%");
 //  x.setAttribute("height", "450px");
 //  document.getElementById("section1").innerHTML='';
 // document.getElementById("section1").appendChild(x);
 return false;
}
function change_condition()
{
showsave();    
}
    function showsave()
    {
      document.getElementById("savebutton").style.display="unset";
    }
    function printing(te4)
    {
        te4.innerHTML ="Printing .. ";
        te4.disbaled=true;
    }
  </script>
<style>
body { background:lightgrey; }

.ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; font-size: 14px; padding: 5px 0px 5px 0px; text-align: center; margin-top: 0px; }

#savebutton
{
  display:none;
}
div.gallery {
    margin: 5px;
    border: 1px solid #000;
    margin-left: 15%;
    width: 70%;
     margin-bottom: 20px;
     background:#FFFFFF;
}

div.gallery:hover { border: 1px solid #777; box-shadow: 2px 1px 5px #888888;}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 10px;
  
}
#photos
{
    display:none;
// overflow: scroll;
}
textarea ,input {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    align: left;
    text-align: start;
    -webkit-appearance: textarea;
    -webkit-rtl-ordering: logical;
    flex-direction: column;
    cursor: text;
    white-space: pre-wrap;
    overflow-wrap: break-word;
    font: message-box;
    border-width: 0px;
    border-style: solid;
    border-color: rgb(169, 169, 169);
    padding: 5px;
    resize: none;
    width: 90%;
}
.save {
    text-align: right;
    float: left;
    position: fixed;
    width: 100%;
    bottom: 0px;
    margin:10px;
    right:10px;
    align-items: 60px;
}
.save>input {
    width: 80px;
    padding: 8px;
    font-size: large;
    margin: 5px;
}
#sucessBlock
{
    display: block;
    color: green;
    text-align: left;
  
}
#declr_tick
{
    
     width: 20px; 
    height: 20px;
    border: none;
 background: #ffffff; 

}
.AdminComment
{
    vertical-align:top;
}

body { background-color:#ccc;}

.ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; font-size: 14px; padding: 5px 0px 5px 0px; text-align: center; margin-top: 0px; }
input {width:100%; height:20px; border:none; background:#ffffff;}
td {text-align:left; background:#808080; padding:10px; height:50px;}
.hlab4 {margin:1px;}
.ship_detail {background:#ffffff;}
table {left:25%;}
</style>
</head>
<body>
 
    
    
<?php 
if(isset($_POST['save']))
{
  if(update_shipment(base64_decode($_GET['shid']),$_POST))
  {
    echo "<div id='sucessBlock'>Data Saved Successfully !</div>";
  }
}
if($post=getshipment_byhash(base64_decode($_GET['shid'])))
{
   echo '<form method="post" action="'.$_SERVER[REQUEST_URI].'""><div id="photosw" >';
 $datetime= date("Y-m-d\TH:i", $post['ship_time']);
 $checked='';
if(strtolower($post['declr_tick'])=='yes')
{
    $checked='checked';
}

echo '<div class="ptitle" ><h3>Shipment Details</h3></div>
<div class="ship_detail">
<table>
<tbody>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">CRN</h4><input type="text" name="crn" value="'.$post['crn'].'" onchange="showsave()"  /></td>
<td colspan="2" width="301"><h4 class="hlab4">Date &amp; Time</h4><input type="datetime-local" style ="height:unset;" name="ship_time" value="'.$datetime.'" onchange="showsave()"/></td>
</td>
</tr>
<tr>
<td colspan="4" width="601"><h4 class="hlab4">Vehicle Number</h4><input type="text" name="vahicle_number" value="'.$post['vahicle_number'].'" onchange="showsave()"  /></td>
</tr>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">No. of Vehicles</h4><input type="text" name="no_of_vahicle" value="'.$post['no_of_vahicle'].'" onchange="showsave()"  /></td>
<td colspan="2" width="301"><h4 class="hlab4">Vehicle Type</h4><input type="text" name="vahicle_type" value="'.$post['vahicle_type'].'" onchange="showsave()"  /></td>
</tr>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">Logistics Company</h4><input type="text" name="logistic_company" value="'.$post['logistic_company'].'"  onchange="showsave()" /></td>
<td colspan="2" width="301"><h4 class="hlab4">Packaging Quality</h4>'.box_condition($post['box_condition']).'</td>
</tr>
<tr>
<td width="150"><h4 class="hlab4">No. of Staff</h4><input type="text"  name="no_of_staff" value="'.$post['no_of_staff'].'" onchange="showsave()" /></td>
<td width="150"><h4 class="hlab4">No. of Boxes</h4><input type="text"  name="no_of_box" value="'.$post['no_of_box'].'"  onchange="showsave()"/></td>
<td width="150"><h4 class="hlab4">No. of Pallets</h4><input type="text"  name="no_of_pallets" value="'.$post['no_of_pallets'].'"  onchange="showsave()"/></td>
<td width="150"><h4 class="hlab4">No. of Devices</h4><input type="text"   name="no_of_devices" value="'.$post['no_of_devices'].'" onchange="showsave()" /></td>
</tr>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">Logistic Waybill</h4><input type="text" name="logistic_waybill" value="'.$post['logistic_waybill'].'"   onchange="showsave()" /></td>
<td colspan="2" width="301"><h4 class="hlab4">Box Seal</h4><input type="text" name="box_seal" value="'.$post['box_seal'].' "  onchange="showsave()" /></td>
</tr>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">Supervisor Name</h4><input type="text" name="supervisor_name" value="'.$post['supervisor_name'].'"   onchange="showsave()" /></td>
<td colspan="2" width="301"><h4 class="hlab4">Supervisor Phone Number</h4><input type="text" name="supervisor_ph_no" value="'.$post['supervisor_ph_no'].' "  onchange="showsave()" /></td>
</tr>
<tr>
<td colspan="4" width="601"><h4 class="hlab4">Declaration:</h4><p><input type="checkbox" id="declr_tick"  onchange="showsave()" name="declr_tick" value="yes" '.$checked.'>I hereby declare that the above mentioned content of this shipment are fully correct to the best of my knowledge and belief</p></td>
</tr>
<tr>
<td colspan="2" width="301"><h4 class="hlab4">Signature</h4><img width="100px" src="'.$post['supervisor_sign'].'"  alt="SIGNATURE NOT AVAILABLE"/></td>
</tr>
<tr>
<td colspan="4" width="601"><h4 class="hlab4">Comment</h4><textarea onchange="showsave()" rows="4" cols="50" name="note" >'.$post['note'].'</textarea></td>
</tr>

<tr>
<td colspan="2" width="301"><h4 class="hlab4">Images</h4><button class="searchbtn"><a href="#" id="'.$post['hash'].'" onclick= "return openimages2_ship(this.id)">Show Images</a></button></td>
<td colspan="2" width="301"><h4 class="hlab4">Download receipt </h4><button class="searchbtn"><a href="?filehash='.$post['hash'].'"> Download PDF</a></button><button class="searchbtn">
<a href="#" target= "iframe_a" onclick="print();"  > Print PDF</a>
</button></td>
</tr>
</tbody>
</table>
<iframe name="iframe_a" height="0px" width="0px" > </iframe>

</div>';

}
else
{
    echo "Invalid shipment  !";
}

if($post=getshipment_byhash(base64_decode($_GET['shid'])))
{
   // $j=1;
if($single=json_decode($post['files'],true))
{
    
 echo '<div id="photos" > <div class="ptitle" ><h3>Shipment Images</h3></div>';
foreach($single as $photo )
{
    $r=0;
   foreach($photo as $key=>$psd)
   {
     $j=  substr($key, 4);
     //  $qw[$r]=$psd;
     //  $r=$r+1;
   }
   
 //  $photo['desc'.$j]=$qw['1'];
  // $photo['file'.$j]=$qw['0'];

echo '<div class="gallery">';


  //  echo '<img src="'.$photo['file'.$j].'" alt="file'.$j.'" width="100%" >';
 echo '<a class="example-image-link" href="'.$photo['file'.$j].'" data-lightbox="example-set" data-title="'.htmlentities(html_entity_decode($photo['desc'.$j])).'"><img class="example-image" src="'.$photo['file'.$j].'" alt=""/></a>';
  if(($_SESSION['type']=='admin') OR ($_SESSION['type']=='superadmin' ))
  {
  echo'<div class="desc"><strong class="AdminComment">Comment:</strong><textarea onchange="showsave()" rows="4" cols="50" name="'.'desc'.$j.'" >'.htmlentities(html_entity_decode($photo['desc'.$j])).'</textarea></div>';
}
else
{
   echo '<div class="desc"><strong>Comment:</strong> '.htmlentities(html_entity_decode($photo['desc'.$j])).'</div>';
}
 
echo '</div>';
//$j++;
}
 echo '</div><br><br><div class="save" ><input id="savebutton" name="save" type="submit" value="Save All"></div>';
echo "</form>";
}
else
{
    echo"No files !";
}
}
else
{
    echo "Invalid shipment !";
}
?>
</body>
<script src="https://ttg-photostorage.com/lightbox/lightbox//dist/js/lightbox-plus-jquery.min.js"></script>
</html>

