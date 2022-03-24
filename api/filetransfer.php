<?php
// specifying directory 
$mydir = '../uploads';

//scanning files in a given diretory in unsorted order 
$myfiles = scandir($mydir, SCANDIR_SORT_NONE);
$target_url = 'http://162.214.79.208/~ttgphotostorage/uploads.php';
//displaying the files in the directory 

foreach ($myfiles as $file) {

  echo "<img src='" . $mydir . '/' . $file . "' />";
}
