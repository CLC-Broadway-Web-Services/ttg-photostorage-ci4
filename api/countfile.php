<?php 
// specifying directory 
$mydir = '../uploads'; 
  
//scanning files in a given diretory in unsorted order 
$myfiles = scandir($mydir, SCANDIR_SORT_NONE); 
  
//displaying the files in the directory 
 
echo count($myfiles);
