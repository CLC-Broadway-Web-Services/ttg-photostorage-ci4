<!DOCTYPE html>
<html>
<body>
<?php
If($_FILES)
{
foreach($_FILES as $key=> $file)
{
If(!is_array(getimagesize($file['tmp_name'])))
{
unset($_FILES[$key]);
}
}

print_r($_FILES);
}
?>

<form action="api.php" method="post" enctype="multipart/form-data">
    action <input type="text" name="action" value="getship" ><br>
      crn<input type="text" name="crn"><br>
      hash<input type="text" name="hash"><br>
      token <input type="text" name="token" value="WyJhZG1pbkB0dGctcGhvdG9zdG9yYWdlLmNvbSIsMTU5MTYzNDAyMCwxNzQ1MjU3NTMwXQ==" ><br>
     
    
    <input type="submit" value="submit" name="submit">
</form>

</body>
</html>