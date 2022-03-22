<?php

if (isset($_COOKIE['timezone'])) {
  date_default_timezone_set($_COOKIE['timezone']);
} else {
  die('<script>
      const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
document.cookie = "timezone="+tz;
location.reload();
  </script>');
}
if ($filedata = getshipment_byhash($_GET['filehash'])) {
  include "/home/ttgphoto/public_html/wes/reports.php";
} else {
  die("File Not Found !");
}
