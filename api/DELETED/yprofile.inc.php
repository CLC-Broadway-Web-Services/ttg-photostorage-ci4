<head>

<style>

.box_editp { width: 100%; margin: 10px auto; background-color: rgba(24, 65, 108, 0.3); padding: 40px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); float:left; padding-left: 25%; }

.editp_box { display: -ms-flexbox; /* IE10 */ display: flex; width: 80%; margin-bottom: 10px; }

.icon { padding: 10px; background: #18416c; color: white; min-width: 95px; text-align: left; }

.editp-field { width: 100%; padding: 10px; outline: none; }

.editp-field:focus { border: 2px solid #18416c; }

/* Set a style for the submit button */
.editp_btn { background-color: #18416c; color: white; padding: 15px 20px; border: none; cursor:pointer; width: 80%; opacity: 0.9; }

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
    echo "<div id='sucessBlock'>Success:Information updated successfully!<br></div>";
    }
    
}

$admin=load_admin($_SESSION['userid']);
?>

<h2>EDIT PROFILE</h2>

    <div class="box_editp">

  <div class="editp_box">
    <i class="fa fa-user icon"> Name</i>
    <input class="editp-field" type="text" id="yname" name="firstname" placeholder="" value="<?php echo $admin['name']; ?>">
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
    <input class="editp-field" type="text" id="country" name="country" value="<?php echo $admin['country']; ?>" disabled>
  </div>
  
  <div class="editp_box">
    <i class="fa fa-key icon"> Password</i>
    <input class="editp-field" type="text" id="ypass" name="pass" placeholder="" value="<?php echo $admin['pass']; ?>">
  </div>

  <button name="submit" type="submit" value="Save" class="editp_btn">Update</button>
</form>

        </form>
    </div>
    </div>
