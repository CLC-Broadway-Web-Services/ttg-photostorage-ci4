<?php
$post = $_GET['uid'];

if (empty(htmlspecialchars(base64_decode($_GET['uid'], true)))) {
  $posts = $_GET['uid'];
} else {

  $posts = base64_decode($_GET['uid']);
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>Photo List for <?php echo $posts; ?></title>
  <link rel="stylesheet" href="https://ttg-photostorage.com/lightbox/lightbox/dist/css/lightbox.min.css">
  <script>
    function showsave() {
      document.getElementById("savebutton").style.display = "unset";
    }
  </script>
  <style>
    body {
      background: lightgrey;
    }

    #savebutton {
      display: none;
    }

    div.gallery {
      margin: 5px;
      border: 1px solid #000;
      margin-left: 15%;
      width: 70%;
      margin-bottom: 20px;
      background: #FFFFFF;
    }

    div.gallery:hover {
      border: 1px solid #777;
      box-shadow: 2px 1px 5px #888888;
    }

    div.gallery img {
      width: 100%;
      height: auto;
    }

    div.desc {
      padding: 10px;

    }

    #photos {
      // overflow: scroll;
    }

    textarea {
      -webkit-writing-mode: horizontal-tb !important;
      text-rendering: auto;
      letter-spacing: normal;
      word-spacing: normal;
      text-transform: none;
      text-indent: 0px;
      text-shadow: none;
      align: left;
      text-align: start;
      -webkit-appearance: textarea;
      -webkit-rtl-ordering: logical;
      flex-direction: column;
      cursor: text;
      white-space: pre-wrap;
      overflow-wrap: break-word;
      font: message-box;
      border-width: 0px;
      border-style: solid;
      border-color: rgb(169, 169, 169);
      padding: 5px;
      resize: none;
    }

    .save {
      text-align: right;
      float: left;
      position: fixed;
      width: 100%;
      bottom: 0px;
      margin: 10px;
      right: 10px;
      align-items: 60px;
    }

    .save>input {
      width: 80px;
      padding: 8px;
      font-size: large;
      margin: 5px;
    }

    #sucessBlock {
      display: block;
      color: green;
      text-align: left;

    }

    .AdminComment {
      vertical-align: top;
    }

    .ptitle {
      background-image: linear-gradient(to right, #18416c, #0a4a3f);
      color: #ffffff;
      font-size: 14px;
      padding: 5px 0px 5px 0px;
      text-align: center;
      margin-top: 0px;
    }
  </style>
</head>

<body>
  <div class='ptitle'>
    <h3>Photo List for <?php echo $posts; ?></h3>
  </div>

  <?php


  if (isset($_POST['save'])) {
    if (update_desc($posts, $_POST)) {
      echo "<div id='sucessBlock'>Data Saved Successfully !</div>";
    }
  }
  if ($post = getpost_byuid($posts)) {

    // $j=1;
    if ($single = json_decode($post['files'], true)) {

      echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '""><div id="photos" >';
      foreach ($single as $photo) {
        $r = 0;
        foreach ($photo as $key => $psd) {
          $j =  substr($key, 4);
          //  $qw[$r]=$psd;
          //  $r=$r+1;
        }

        //  $photo['desc'.$j]=$qw['1'];
        // $photo['file'.$j]=$qw['0'];


        echo '<div class="gallery">';


        //  echo '<img src="'.$photo['file'.$j].'" alt="file'.$j.'" width="100%" >';
        echo '<a class="example-image-link" href="' . $photo['file' . $j] . '" data-lightbox="example-set" data-title="' . htmlentities(html_entity_decode($photo['desc' . $j])) . '"><img class="example-image" src="' . $photo['file' . $j] . '" alt=""/></a>'; ?>
        <div><a href="#" onclick="return launchEditor('editableimage1','<?php echo $photo['file' . $j]; ?>');">Edit</a></div>

  <?php
        if (($_SESSION['type'] == 'admin') or ($_SESSION['type'] == 'superadmin')) {
          echo '<div class="desc"><strong class="AdminComment">Comment:</strong><textarea onchange="showsave()" rows="4" cols="50" name="' . 'desc' . $j . '" >' . htmlentities(html_entity_decode($photo['desc' . $j])) . '</textarea></div>';
        } else {
          echo '<div class="desc"><strong>Comment:</strong> ' . htmlentities(html_entity_decode($photo['desc' . $j])) . '</div>';
        }

        echo '</div>';
        //$j++;
      }
      echo '</div><br><br><div class="save" ><input id="savebutton" name="save" type="submit" value="Save All"></div>';
      echo "</form>";
    } else {
      echo "No files !";
    }
  } else {
    echo "Invalid Asset ID !";
  }
  ?>

</body>
<script type="text/javascript">
  function launchEditor(id, src) {
    debugger;
    const ImageEditor = new FilerobotImageEditor();

    ImageEditor.open(src);
    return false;
  }
</script>
<script src="https://ttg-photostorage.com/lightbox/lightbox//dist/js/lightbox-plus-jquery.min.js"></script>
<script src="https://cdn.scaleflex.it/plugins/filerobot-image-editor/3.12.17/filerobot-image-editor.min.js"></script>
</html>