<?= $this->extend('Dashboard/popuplayout') ?>
<style>

#overlay {
  border: 1px solid black;
  width: 200px;
  height: 200px;
  display: inline-block;
  background-image: url('https://via.placeholder.com/400.png');
  background-repeat: no-repeat;
}
</style>
<?= $this->section('content') ?>
<!-- With Footer Header -->

<?php

$files = json_decode($manage_data_details['files']);
$filesCount = count($files);

for ($i = 0; $i < $filesCount; $i++) {
    $fileKey = 'file' . ($i + 1);
    $commentKey = 'desc' . ($i + 1);


    echo '<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <form action="" method="post">
            <div class="card">
                <div id="imgZoom" width="200px" height="200px" onmousemove="zoomIn(event)" onmouseout="zoomOut()" class="card-header border-bottom">Photo List for :' . $manage_data_details["uid"] . ' </div>
                <div class="card-body">
                   <img src="../' . $files[$i]->$fileKey . '"  >
                </div>
                    <div id="overlay" onmousemove="zoomIn(event)"></div>               
                    <div class="card-footer border-top text-muted">
                    <label class="form-label" for="full-name-1">Comment</label>
                    <div class="input-group">
                        <textarea type="text" class="form-control singleField" name="comment" placeholder="">'
        . $files[$i]->$commentKey .
        '</textarea>
                    </div>
                </div>
                <div class="card-footer border-top text-muted">
                    <a href="#" class="btn btn-sm btn-primary">Edit Image</a>
                    <a href="#" class="btn btn-sm btn-primary">Update Comment</a>
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalDefault">Objection</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </div>
        </form>
    </div>
</div>';
}
?>

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Objection</h5>
            </div>
            <form>
                <div class="card-footer border-top text-muted">
                    <label class="form-label" for="full-name-1">Reason for Objection</label>
                    <div class="input-group">
                        <textarea type="text" class="form-control" name="objection" placeholder="Type your reason/Comment that why you are reject data">
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text"> <a href="#" class="btn btn-sm btn-primary">Send</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>




<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    function showImages() {
        var detailsImages = document.getElementById('detailsImages');
        detailsImages.style.display = 'block';
        detailsImages.scrollIntoView({
            behavior: "smooth"
        });
    }

    // single fields submition
    $('.submitButton').on('click', function() {
        var field = $(this).closest('.input-group').find('.singleField');
        var fieldName = $(field).attr('name');
        var fieldValue = $(field).val();

        var formData = new FormData();
        formData.append('form_name', 'single_submition');
        formData.append(fieldName, fieldValue);

        $.ajax({
            url: '',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false
        }).done(function(response) {
            console.log(response)
        }).fail(function(error) {
            console.log(error)
        })
    })

    function zoomIn(event) {
        var element = document.getElementById("overlay");
        element.style.display = "inline-block";
        var img = document.getElementById("imgZoom");
        var posX = event.offsetX ? (event.offsetX) : event.pageX - img.offsetLeft;
        var posY = event.offsetY ? (event.offsetY) : event.pageY - img.offsetTop;
        element.style.backgroundPosition = (-posX * 4) + "px " + (-posY * 4) + "px";

    }

    function zoomOut() {
        var element = document.getElementById("overlay");
        element.style.display = "none";
    }
</script>
<?= $this->endSection() ?>