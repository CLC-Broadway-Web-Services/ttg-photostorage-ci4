<script>
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
    
    
    function deleteuser(p2)
    {
        if(confirm("Please confirm to delete data."))
{

       document.getElementById("fordelete").value= document.getElementById(p2+"email").value;
     document.getElementById("deleteform").submit();
}
    }
</script>

<style>
    .page_1box {background:#ffffff; padding:7px; width:100%; margin-top:5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);}
            
    .page_2box { padding:7px; width:104%; margin-top:5px; margin-left:-12px;}
    .page_2box>div { width: 48%; height: 170px; vertical-align: top; display: inline-block; *display: inline; zoom: 1; 
		             background:#ffffff; margin:5px; padding:7px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
    
</style>

<?php
if(isset($_POST['delete']))
{
    $todelete=json_decode(html_entity_decode($_POST['json1']));
    $du=0;
    foreach($todelete as $dts)
    {
        if($dts)
        {
        delete_user($dts);
        $du=$du+1;
        }
    }
    if($du)
    {
    echo "<div id='sucessBlock'>Success:".$du." User(s) Deleted Successfully<br></div>";
    }else if(delete_user($_POST['demail']))
    { 
        echo "<div id='sucessBlock'>Success:User Deleted Successfully<br></div>";
    }
}


if(isset($_POST['submit']))
{ 
    $errors=errors_add_user($_POST);
    if($errors)
    {
        foreach ($errors as $try)
        {
            echo "<div id='errorBlock'><b>Error:</b>".$try."<br></div>";
        }
    }
    else
    {
    add_user($_POST);
    echo "<div id='sucessBlock'>Success:User Added Successfully<br></div>";
    }
    
}

if(isset($_POST['update']))
{ 
    $errors=errors_add_user($_POST);
    if($errors)
    {
        foreach ($errors as $try)
        {
            echo "<div id='errorBlock'><b>Error:</b>".$try."<br></div>";
        }
    }
    else
    {
    add_user($_POST);
    echo "<div id='sucessBlock'>Success:User Updated Successfully<br></div>";
    }
    
}

if(true)
{ 
    // $errors=errors_search_user($_POST);
    if($errors)
    {
        foreach ($errors as $try)
        {
            echo "<div id='errorBlock'><b>Error:</b>".$try."<br></div>";
        }
    }
    else
    {
        if($_SESSION['type']=='admin')
      {
      $country=$_SESSION['country'];
      $cd="disabled";
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
if(!isset($_GET['s']) OR !$_SESSION['mstaffdata'])
{
$loadeddata=load_users($_POST['email'],'staff', $country);
        $_SESSION['mstaffdata']= $loadeddata;	
}
else
{
	$loadeddata=$_SESSION['mstaffdata'];
}
        
       // $allclient= array_slice( $loadeddata, 20, 0);
 $totalitem=count( $loadeddata);
 $allclient= array_slice( $loadeddata, (($pid-1)*$pageitem), $pageitem );
 // pagination 1 end 
        
  $rtv= " <table>
  <tr><th><input type='checkbox' id='selectall' name='all'  onclick='alloff()' value='all'></th>
    <th>Staff ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Mobile No.</th>
    <th>Password</th>
    <th>Country</th>
    <th>Action</th>
  </tr>";
  $h=1;
  foreach($allclient as $client)
  {
      if($client['type']=='staff')
      {
   $rtv.=" 
  <tr><form id= '".$client['id']."updateform' action ='' method='post'/><td><input type='checkbox' id='check".$h."' name='all' value='".$client['id']."' ></td>
    <td><input type='text' class='tablelist' name='id'  id='".$client['id']."id' value='".$client['id']." ' disabled></td>
      <td><input type='text' class='tablelist'  name='firstname'  id='".$client['id']."firstname' value='".$client['name']."' onfocus='edituser(this)'></td>
     <td><input type='text' class='tablelist' name='email' id='".$client['id']."email' value='".$client['email']."' onfocus='edituser(this)'></td>
      <td><input type='text' class='tablelist' name='mobile' id='".$client['id']."mobile' value='".$client['mobile']."' onfocus='edituser(this)' ></td>
    
     <td><input type='password' class='tablelist' name='pass' id='".$client['id']."pass' value='".$client['pass']."' onfocus='edituser(this)' onblur='hidepass(this)' autocomplete='new-password'></td>
        <td onclick='edituser(this)' >".lstcountry($client['country'],$client['id'].'country')."</td>
    
    <td>
    <input type='hidden' name='type' value='".$client['type']."'>
    
      <input type='hidden' name='id' value='".$client['id']."'>
      <input type='hidden' name='update' value='Update'>

        <input id='".$client['id']."' type='button' name='edit' value='Edit' onclick='edituser(this)' class='btn_edit' />
         <input id='".$client['id']."update' type='button'  value='Update' onclick='updatedata(this.id)' class='btn_edit btn_update' />
        <input type='button' name='delete' value='Delete' onclick='deleteuser(".$client['id'].")' class='btn_delete' /> 
    </td>
    
    
  
  </form></tr>";
  $h=$h+1;
      }
  }
  
 
 $rtv.=" </table><br /><input type='button' name='deleteall' value='Delete All Selected' onclick='deleteselected()' class='btn_delete' />";
 $pa=pagination($totalitem,$pageitem,$pid);
$rtv.=$pa;
    }
    
}


?>
<form id="deleteform" action="?p=mstaff" method="post" style="display:none">
    <input type="hidden" id="delete" name="delete" value="delete" >
    <input type=hidden" id="json1" name="json1" value="false" >
    <input type="hidden" id="fordelete" name="demail"  >

  </form>


    
    <div class="page_2box">
        <div>
        <h5 class="title_h5">Search Testing Staff</h5><hr /><br />
        <p>Search testing staff by Staff ID, Name, Email, Phone Number & Country</p>
        <form  method="POST" action="?p=mstaff" onsubmit="return checkdata();">
            <label for="clemail"></label>
            <input type="text" id="clemail" name="email" placeholder="Enter Name,Email or Mobile" class="searchfield"><br /><br />
            <button name="search" value="Search" class="searchbtndate"><i class="fa fa-search"> Search</i></button>
    
  </form>
</div>
    
        <div>
        <h5 class="title_h5">Add Testing Staff</h5><hr /><br />
        <p>Add new testing staff here</p>
  
  <button onclick="open_adduser('','staff')" class="searchbtndate"><i class="fa fa-plus" aria-hidden="true"> Add</i></button>
        </div>
        
    </div>

    <div class="page_1box">
        <h5 class="title_h5">Testing Staff List</h5><hr /><br />
        <?php echo $rtv ?>
    </div>
