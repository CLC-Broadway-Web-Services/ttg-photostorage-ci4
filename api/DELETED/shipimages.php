<?php
// die("underconstruction");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://ttg-photostorage.com/lightbox/lightbox/dist/css/lightbox.min.css">
  <script>

    function showsave()
    {
      document.getElementById("savebutton").style.display="unset";
    }
  </script>
<style>
#savebutton
{
  display:none;
}
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: auto;
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
// overflow: scroll;
}
textarea {
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
.AdminComment
{
    vertical-align:top;
}
</style>
</head>
<body>
<?php 
if(isset($_POST['save']))
{
   // print_r($_POST);
  if(update_shipmentimages_desc($_GET['hashimages'],$_POST))
  {
    echo "<div id='sucessBlock'>Data Saved Successfully !</div>";
  }
}
if($post=getshipment_byhash($_GET['hashimages']))
{
   // $j=1;
if($single=json_decode($post['files'],true))
{
    
  echo '<form method="post" action="'.$_SERVER[REQUEST_URI].'""><div id="photos" >';
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
    echo "Invalid Asset ID !";
}
?>
</body>
<script src="https://ttg-photostorage.com/lightbox/lightbox//dist/js/lightbox-plus-jquery.min.js"></script>
</html>