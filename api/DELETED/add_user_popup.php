<?php
?>
<head>
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
<style>

    .box_editp { width: 100%; margin: 10px auto; padding: 10px; }

    .editp_box { display: -ms-flexbox; /* IE10 */ display: flex; width: 100%; margin-bottom: 10px; }

    .icon { padding: 10px; background: #18416c; color: white; min-width: 95px; text-align: left; }

    .editp-field { width: 100%; padding: 10px; outline: none; }

    .editp-field:focus { border: 2px solid #18416c; }
    
    .country {width:100%;}

/* Set a style for the submit button */
.editp_btn { background-color: #18416c; color: white; padding: 15px 20px; border: none; cursor:pointer; width: 100%; opacity: 0.9; }

.editp_btn:hover { opacity: 2; }


</style>
</head>

<?php


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
    echo "<div id='sucessBlock'>Success: User Added successfully!<br></div>";
    exit();
    }
    
}

$admin=$_POST;
$admin['type']=$_GET['type'];
if($admin['type']=='client')
{
    $text1="ADD CLIENT";
}else if($admin['type']=='ship')
{
    $text1="ADD SHIPPING STAFF";
}else if($admin['type']=='staff')
{
  $text1="ADD STAFF";  
}else if(($admin['type']=='admin') && ($_SESSION['type']=='superadmin'))
{
  $text1="ADD ADMIN";    
}else
{
   die("Invalid User Type");
}
if(!isset($admin['pass']))
{
  $admin['pass']=   random_strings() ;
}
?>

<form method="post" action="" />
    <div class="box_editp">

  <div class="editp_box">
    <i class="fa fa-user icon"> Name</i>
    <input class="editp-field" type="text" id="yname" name="firstname" placeholder="" value="<?php echo $admin['firstname']; ?>">
  </div>

  <div class="editp_box">
    <i class="fa fa-envelope icon"> Email</i>
    <input class="editp-field" type="text" id="yemail" name="email" placeholder="" value="<?php echo $admin['email']; ?>">
  </div>
  
    <div class="editp_box">
    <i class="fa fa-mobile icon"> Phone</i>
    <input class="editp-field" type="text"  id="ymobile" name="mobile" placeholder="" value="<?php echo $admin['mobile']; ?>">
  </div>
  
      <div class="editp_box">
    <i class="fa fa-globe icon"> Country</i>
    <?php 
    if($_SESSION['type']=='superadmin')
    {
    echo lstcountry($admin['country'],''); 
    }
    else 
    {
        echo "<span class='editp-field' >".$_SESSION['country']."</span>";
        echo " <input class='editp-field' type='hidden' id='country' name='country' value='".$_SESSION['country']."' />";
    }
    
    ?>
  </div>
  
  <div class="editp_box">
    <i class="fa fa-key icon"> Password</i>
    <input class="editp-field" type="text" id="ypass" name="pass" placeholder="" value="<?php echo $admin['pass']; ?>">
  </div>
<input type="hidden" name="type" value="<?php echo $admin['type']; ?>" />
  <button name="submit" type="submit" value="Save" class="editp_btn">Add</button>
</form>

    </div>
    </div>
