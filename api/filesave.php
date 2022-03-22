<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);
// Read JSON file

set_time_limit(10000);

$json = file_get_contents('1595060136images.json');

$directory = '../uploads/';
//Decode JSON
$json_data = json_decode($json, true);
//Print data
$i = 0;
foreach ($json_data as $file) {

    if (!filesize($directory . $file)) {
        $filename = $directory . $file;
        $handle = fopen($filename, "x+");
        fwrite($handle, file_get_contents('https://ttg-photostorage.com/' . $directory . $file));
        fclose($handle);
        echo 'https://ttg-photostorage.com/' . $directory . $file;
    } else {
    }
}
//echo $i;

function url_get_contents($Url)
{
    if (!function_exists('curl_init')) {
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
    $output = curl_exec($ch);
    curl_close($ch);
    die('Curl error: ' . curl_error($ch));
    return $output;
}
