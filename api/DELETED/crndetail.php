<?php
$post = getposts_bycrn($_GET['crn']);
//print_r($post)
foreach ($post as $single) {
  if ($single['device_type'] != '') {
    $parms[$single['device_type']] = $parms[$single['device_type']] + 1;
    $defects = array_filter(explode(',', $single['defect']));
    foreach ($defects as $fault) {
      $fault = test_input($fault);
      $dfs[$single['device_type']][$fault] = $dfs[$single['device_type']][$fault] + 1;
    }
  } else {
    //   $parms['Unknown']= $parms['Unknown']+1;
  }
}
ksort($parms);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Photo List for <?php echo $_GET['crn']; ?></title>

  <script>
    function showsave() {
      document.getElementById("savebutton").style.display = "unset";
    }

    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = document.getElementById(this.id + "panel");
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }

    function accrd(t3) {
      var panel = document.getElementById(t3.id + "panel");
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    }
  </script>
  <style>
    .ptitle {
      background-image: linear-gradient(to right, #18416c, #0a4a3f);
      color: #ffffff;
      font-size: 14px;
      padding: 5px 0px 5px 0px;
      text-align: center;
      margin-top: 0px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 12px;
      border: 1px solid black;
    }

    th {
      background: #18416c;
      color: #ffffff;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    .accordion {

      cursor: pointer;
      padding: 5px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 12px;
      font-weight: bold;
      transition: 0.4s;
    }

    .active,
    .accordion:hover {
      background-color: #c6dff5;
    }

    .panel {

      display: none;
      background-color: white;
      overflow: hidden;
    }

    .accord_th {
      background-color: #0a4a3f;
      color: #ffffff;
    }
  </style>

</head>

<body>
  <div class='ptitle'>
    <h3>CRN detail for <?php echo $_GET['crn']; ?></h3>
  </div>
  <h3>Total No. of Assets in this CRN: <?php echo count($post); ?></h3>
  <table>
    <tr>
      <th>Device Type </th>
      <th>Quantity</th>

    </tr>
    <?php
    foreach ($parms as $key => $dev) {
      echo "<tr class='accordion' onclick='accrd(this)' id='" . $key . "'>";

      echo "<td>" . $key . "</td>";

      echo "<td>" . $dev . "</td>";

      echo "</tr>";

      echo " <tr><td colspan='2'><div class='panel' id='" . $key . "panel' >
  <table border='1'>
  <tr><th class='accord_th'>Defect Type </th><th class='accord_th'>Quantity</th><th class='accord_th'>Percentage</th></tr>";
      $ttl = $dev;
      foreach ($dfs[$key] as $chhabi => $rtf) {
        echo "<tr>";

        echo "<td>" . $chhabi . "</td>";

        echo "<td>" . $rtf . "</td>";

        echo "<td>" . (round(($rtf / $ttl), 4) * 100) . " %</td>";

        echo "</tr>";
      }

      echo "</table>
</div></td></tr>";
    }
    ?>
  </table>

</body>

</html>