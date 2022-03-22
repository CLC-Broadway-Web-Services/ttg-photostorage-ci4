<?php
$ar= search_shipment_bydate('','');
$ar=short_shipments($ar,'');
array_to_csv_download(
 $ar, // this array is going to be the second row
  "numbers.csv"
);
