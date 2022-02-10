<?= $this->extend('Dashboard/popuplayout') ?>
<?= $this->section('css') ?>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/css/lightgallery.css" />
<!-- lightgallery plugins -->
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/css/lg-zoom.css" />
<!-- <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/css/lg-thumbnail.css" /> -->
<!-- OR -->
<!-- <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/css/lightgallery-bundle.css" /> -->

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
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- With Footer Header -->

<div class="row justify-content-center mb-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-bottom d-inline">
                Photo List for :<?= $manage_data_details["uid"] ?>
                <!-- <button class="btn btn-sm btn-success float-end"> -->
                <a class="ni ni-check-circle text-success float-end fw-bold" title="Verify" href="javascript:void(0);" style="font-size:x-large"></a>
                <!-- </button> -->
            </div>
        </div>
        <?php
        $files = json_decode($manage_data_details['files']);
        $filesCount = count($files);

        for ($i = 0; $i < $filesCount; $i++) {
            $fileKey = 'file' . ($i + 1);
            $commentKey = 'desc' . ($i + 1); ?>

            <form action="" method="post">
                <div class="card">
                    <div class="card-body lightgallery">
                        <a href="<?= '/' . $files[$i]->$fileKey ?>" data-lg-size="2400-2400">
                            <img src="<?= '/' . $files[$i]->$fileKey ?>">
                        </a>
                    </div>

                    <div class="card-footer border-top text-muted">
                        <label class="form-label" for="full-name-1">Comment</label>
                        <div class="input-group">
                            <textarea type="text" class="form-control singleField" name="comment" datakey="<?= $i + 1 ?>" id="<?= $commentKey ?>" placeholder=""><?= $files[$i]->$commentKey ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer border-top text-muted">
                        <?php if (session()->get('user.type') !== 'client') : ?>
                            <button type="button" class="btn btn-sm btn-primary" onclick="return launchEditor('editableimage1','<?= '/' . $files[$i]->$fileKey ?>');">Edit Image</button>
                        <?php endif ?>
                        <button type="button" class="btn btn-sm btn-primary" onclick="updateComment('<?= $commentKey ?>')">Update Comment</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="openObjectionBox(<?= $i ?>, '<?= $fileKey ?>')">Objection</button>
                        <?php if (session()->get('user.type') !== 'client') : ?>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteImage('<?= $i + 1 ?>')">Delete</button>
                        <?php endif ?>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </button>
            <div class="modal-header">
                <h5 class="modal-title">Add Objection</h5>
            </div>
            <form id="objection_form">
                <input type="number" value="none" class="d-none" id="objection_index" name="objection_index">
                <input type="type" value="none" class="d-none" id="objection_filekey" name="objection_filekey">
                <div class=" card-footer border-top text-muted">
                    <label class="form-label" for="full-name-1">Reason for Objection</label>
                    <div class="input-group">
                        <textarea type="text" class="form-control" name="objection" placeholder="Type your reason/Comment that why you are reject data" required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">
                        <button type="submit" class="btn btn-sm btn-primary">Object</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/lightgallery.umd.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/plugins/thumbnail/lg-thumbnail.umd.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.3.0/plugins/zoom/lg-zoom.umd.js"></script>

<script src="https://cdn.scaleflex.it/plugins/filerobot-image-editor/3.12.17/filerobot-image-editor.min.js"></script>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('modalDefault'));
    document.getElementById('modalDefault').addEventListener('hidden.bs.modal', function(event) {
        $('#objection_index').val('none');
        $('#objection_filekey').val('none');
    })

    function openObjectionBox(index, fileKey) {
        console.log(index)
        console.log(fileKey)
        $('#objection_index').val(index);
        $('#objection_filekey').val(fileKey);
        myModal.show();
    }

    function launchEditor(id, src) {
        // debugger;
        const config = {
            cloudimage: {
                token: 'amgsbibkeq'
            }
        };
        const onComplete = function(newUrl) {
            console.log('your url for the edited image: ', newUrl);
        };
        const ImageEditor = new FilerobotImageEditor(config, onComplete);

        // ImageEditor.config.tools = ['adjust', 'effects', 'filters', 'rotate'];

        ImageEditor.open(src);
        return false;
    }

    const lightboxDiv = document.getElementsByClassName('lightgallery');

    lightboxDiv.forEach(element => {
        lightGallery(element, {
            plugins: [lgZoom],
            licenseKey: '0000-0000-000-0000',
            speed: 500,
            download: false,
            mousewheel: true,
            scale: 0.5,
            showZoomInOutIcons: true
        });
    });

    function showImages() {
        var detailsImages = document.getElementById('detailsImages');
        detailsImages.style.display = 'block';
        detailsImages.scrollIntoView({
            behavior: "smooth"
        });
    }

    function updateComment(id) {
        // console.log($('#' + id).val());
        var formData = new FormData();
        formData.append('form_name', 'comment_update');
        formData.append('datakey', $('#' + id).attr('datakey'));
        formData.append('comment', $('#' + id).val());
        console.log(Array.from(formData));
        $.ajax({
            type: 'POST',
            url: '',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log('comment form working');
                // console.log(response);
                // console.log(JSON.parse(response));
                location.reload();
            }
        });
    }

    $('#objection_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        // console.log(Array.from(formData));
        $.ajax({
            type: 'POST',
            url: '',
            data: formData,
            contentType: false,
            processData: false,
            success: function(result) {
                console.log(result)
                // location.reload();
            }
        });
    });

    function deleteImage(imageId) {
        var currentUrl = window.location.href;
        console.log(currentUrl)
    }
</script>
<?= $this->endSection() ?>