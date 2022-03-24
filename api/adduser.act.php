<?php
$month = date('M-Y');
$target_dir = "../uploads/profile_pic/".$month."/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$gate['id']=$response['user']['id'];
$gate['update']='true';
$oldpass=$response['user']['pass'];
if(isset($gate['pass']))
{
if($gate['oldpass']!=$oldpass)
{
	$response['errors'][]['error']=array("Incorrect Old Password !");
	$response['error']='Errors in data';
}
}
foreach($response['user'] as $key=>$value)
{
	if(!isset($gate[$key]))
	{
		$gate[$key]=$value;
	}
}

If($_FILES)
{
foreach($_FILES as $key=> $file)
{
	if($file['tmp_name']!='')
	{
If(!is_array(getimagesize($file['tmp_name'])))
{
	echo $key."->".$file;
 $response['error']="Non image files not allowed !";
 break;
}
}
}

$file=$_FILES['profile_pic'];
$target_file['profile_pic']=$target_dir .$gate['id'];

if( move_uploaded_file($file["tmp_name"], $target_file['profile_pic']))
{
$gate['profile_pic']=$target_file['profile_pic'];

}
}

$errors=errors_add_user_1($gate);

    if($errors)
    {
       
            $response['errors'][]['error']=$errors;
           
        
    }
    if($response['errors'])
    {
         $response['error'];
         $enderror= end($response['errors']);
         $response['error']= $enderror['error'][0];
         unset($response['errors']);
    }
    else
    {
    add_user($gate);
    if(isset($_POST['pass']))
    {
     $response['msg']="Password Changed Successfully";
    }else
    {
         $response['msg']="Profile Updated successfully";
        $response['updated_user']=getuser_bytoken($gate['token']);
    }
    
    }
