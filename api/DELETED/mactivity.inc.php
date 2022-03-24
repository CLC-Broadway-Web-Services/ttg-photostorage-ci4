<?php
  
  ?>
</script>

<style>
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
    .modalAssign-content { background-color: #fefefe; margin: auto; padding-top: -10px; border: 10px solid #888; width: 40%; height:500px; box-shadow:0 2px 6px rgba(0, 0, 0, 0.5); }

    .ptitle { background-image: linear-gradient(to right, #18416c , #0a4a3f); color: #ffffff; font-size: 14px; padding: 5px 0px 5px 0px; text-align: center; margin-top: 0px; }
			
    form.example input[type=text] { padding: 10px; font-size: 14px; border: 1px solid grey; border-radius: 10px 0px 0px 10px; float: left; width: 50%; background: #ffffff; }

    form.example button { float: left; width: 20%; padding: 10px; background: #18416c; color: white; font-size: 21px; border: 1px solid grey; border-radius: 0px 10px 10px 0px; border-left: none; cursor: pointer; }
    form.example button:hover { background: #123152; }

    form.example::after { content: ""; clear: both; display: table; }

    /* The Close Button */
    .close { color: #aaaaaa; float: right; font-size: 28px; font-weight: bold; padding: 0px 5px 0px 5px; background-color:red; color: #ffffff;}
    .close:hover, .close:focus { color: #000; text-decoration: none; cursor: pointer; }
    
</style>

<h2>ACTIVITY LOGS</h2>
<?php




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
if(!isset($_GET['s']) OR !$_SESSION['mactivity'])
{
$loadeddata=load_activity($_POST['email'], $country);
        $_SESSION['mactivity']= $loadeddata;	
       
}
else
{
	$loadeddata=$_SESSION['mactivity'];
}
        
       // $allclient= array_slice( $loadeddata, 20, 0);
 $totalitem=count( $loadeddata);
 $allclient= array_slice( $loadeddata, (($pid-1)*$pageitem), $pageitem );
 // pagination 1 end 
        
  $rtv= " <table>
  <tr>
  
    <th>Event</th>
    <th>Event By</th>
    <th>Event On</th>
    <th>Time</th>
    <th>Device</th>
    <th>IP Address</th>
  </tr>";
  $h=1;
  foreach($allclient as $client)
  {
      if($client['userid'])
      {
          if($client['userid']==$_SESSION['userid'])
          {
              $client['userid']="<b>You</b>";
          }
 
  $rtv.=" 
  <tr>
 <td id='".$client['id']."name'>".$client['event']."</td>
   <td id='".$client['id']."id' >".$client['userid']."</td>
    <td id='".$client['id']."mobile'>".$client['datauid']."</td>
    <td id='".$client['id']."email'>".date("F j, Y, g:i:s a",$client['time'])."</td>
    <td id='".$client['id']."country'>".$client['device']."</td>
    <td id='".$client['id']."ipaddress'>".$client['ipaddress']."</td>
    
   
    
    
  </tr>";
  
  
   /**
  
   $rtv.=" 
  <tr><form id= '".$client['id']."updateform' action ='' method='post'/><td><input type='checkbox' id='check".$h."' name='all' value='".$client['id']."' ></td>
    <td><input type='text' class='tablelist' name='id'  id='".$client['id']."id' value='".$client['id']." ' disabled></td>
      <td><input type='text' class='tablelist'  name='firstname'  id='".$client['id']."firstname' value='".$client['name']."' onfocus='edituser(this)'></td>
     <td><input type='text' class='tablelist' name='email' id='".$client['id']."email' value='".$client['email']."' onfocus='edituser(this)'></td>
      <td><input type='text' class='tablelist' name='mobile' id='".$client['id']."mobile' value='".$client['mobile']."' onfocus='edituser(this)' ></td>
       <td onclick='edituser(this)' >".lstcountry($client['country'],$client['id'].'country')."</td>
   
    
    <td>
    <input type='hidden' name='type' value='".$client['type']."'>
     <input type='hidden' name='pass' value='".$client['pass']."'>
      <input type='hidden' name='id' value='".$client['id']."'>
      <input type='hidden' name='update' value='Update'>

        <input id='".$client['id']."' type='button' name='edit' value='Edit' onclick='edituser(this)' class='btn_edit' />
         <input id='".$client['id']."update' type='button'  value='Update' onclick='updatedata(this.id)' class='btn_edit btn_update' />
        <input type='button' name='delete' value='Delete' onclick='deleteuser(".$client['id'].")' class='btn_delete' /> 
    </td>
    
     <input type='hidden' id='".$client['id']."pass' value='".$client['pass']."' />
  
  </form></tr>";
  **/
  
  $h++;
      }
  }
  
 $rtv.=" </table><br />";
  $pa=pagination($totalitem,$pageitem,$pid);
$rtv.=$pa;
    }
    
}


?>



    



<div class="searchbox">
    <h3>Search Activities</h3>
    <span> Search by Staff ID/ Admin ID/ IP Address /Asset ID </span>
 <form  method="POST" action="?p=mactivity" onsubmit="return checkdata();">
    <label for="clemail"></label>
    <input type="text" id="clemail" name="email" placeholder="Enter Name,Email or Mobile" class="searchfield" />
    <button name="search" value="Search" class="searchbtn"><i class="fa fa-search"></i></button>
    
  </form>
</div>

<div class="searchbox">
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
			<h1>Assign CRN</h1>
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
