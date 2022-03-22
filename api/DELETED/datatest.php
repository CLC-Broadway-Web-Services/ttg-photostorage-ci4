<?php

include('config.php');

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>How fetch Data in excel in PHP</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .custab {

            border: 1px solid #ccc;

            padding: 5px;

            margin: 5% 0;

            box-shadow: 3px 3px 2px #ccc;

            transition: 0.5s;

        }

        .custab:hover {

            box-shadow: 3px 3px 0px transparent;

            transition: 0.5s;

        }
    </style>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">

        <div class="row col-md-12 custyle">

            <table class="table table-striped custab">

                <thead>

                    <a href="exceltest.php" class="btn btn-primary btn-xs pull-right"><b>+</b>Genrate Excel</a>

                    <tr>
                        <th>Id</th>
                        <th>Staff ID</th>
                        <th>CRN</th>
                        <th>Asset ID</th>
                        <th>Links</th>

                    </tr>

                </thead>

                <?php

                $query = mysqli_query($con, "SELECT userid , crn, uid, CONCAT('https://ttg-photostorage.com/?uid=',uid) AS links FROM ttg_post where uid ='IT0244830'");

                $cnt = 1;

                while ($row = mysqli_fetch_array($query)) {



                ?>



                    <tr>

                        <td><?php echo $cnt;  ?></td>

                        <td><?php echo $row['userid'] ?></td>

                        <td><?php echo $row['crn'] ?></td>

                        <td><?php echo $row['uid'] ?></td>

                        <td><?php echo $row['links'] ?></td>


                    </tr>

                <?php

                    $cnt++;
                } ?>



            </table>
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- fordemos -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8906663933481361" data-ad-slot="9236995934" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>

    </div>

</body>

</html>