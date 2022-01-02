<?= $this->extend('Dashboard/popuplayout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header border-bottom bg-primary text-white">Shipment Details For Test Ship 1we</div>
    <div class="card-body">
        <div class="card-head">

        </div>



        <form method="post">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">CRN</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField"  placeholder="Input placeholder" value="<?= $manage_shipment_details['crn']  ?>">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Date And Time</label>
                        <div class="input-group">
                            <form action="" method="post">
                                <input type="text" class="form-control singleField" disabled placeholder="Input placeholder" value="<?= date("d M Y, g:s A", $manage_shipment_details['time']); ?>">

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Number of Vehicle</label>
                        <div class="input-group">

                            <input type="text" class="form-control singleField" name="no_of_vahicle" placeholder="Input placeholder" value="<?= $manage_shipment_details['no_of_vahicle']  ?>">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Vehicle Type</label>
                        <div class="input-group">
                            <select class="form-control singleField" name="vahicle_number" value="<?= $manage_shipment_details['vahicle_type']  ?>">
                                <option value="Open">Open</option>
                                <option value="Close">Close</option>
                                <option value="Open&Close">Open & Close</option>
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Vehicle Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="logistic_company" placeholder="Input placeholder" value="<?= $manage_shipment_details['vahicle_number']  ?>">

                            <div class="input-group-append">
                                <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Logistics Company</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="logistic_company" placeholder="Input placeholder" value="<?= $manage_shipment_details['logistic_company']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Quality</label>
                        <div class="input-group">
                            <select class="form-control singleField" name="box_condition" value="<?= $manage_shipment_details['box_condition']  ?>">
                                <option value="Poor">Poor</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">No of staff</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="no_of_staff" placeholder="Input placeholder" value="<?= $manage_shipment_details['no_of_staff']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">No of Device</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="no_of_devices" placeholder="Input placeholder" value="<?= $manage_shipment_details['no_of_devices']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">No of boxes</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="no_of_box" placeholder="Input placeholder" value="<?= $manage_shipment_details['no_of_box']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">No of Pallets</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="no_of_pallets" placeholder="Input placeholder" value="<?= $manage_shipment_details['no_of_pallets']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Logistics Waybill</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="logistic_waybill" placeholder="Input placeholder" value="<?= $manage_shipment_details['logistic_waybill']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Box Seal</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="box_seal" placeholder="Input placeholder" value="<?= $manage_shipment_details['box_seal']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Supervisor Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="supervisor_name" placeholder="Input placeholder" value="<?= $manage_shipment_details['supervisor_name']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="full-name-1">Supervisor Phone Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control singleField" name="supervisor_ph_no" placeholder="Input placeholder" value="<?= $manage_shipment_details['supervisor_ph_no']  ?>">
                            <div class="input-group-append">
                            <button type="button" class="btn btn-success submitButton">
                                    <em class="icon ni ni-check-circle-cut"></em>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label">Confirmation</label>
                        <ul class="custom-control-group g-3 align-center">
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="com-email">
                                    <label class="custom-control-label" for="com-email">I hereby declare that the above mentioned content of this shipment are fully correct to the best of my knowledge and belief</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="cf-default-textarea">Supervisor Sign</label>
                        <img src="../<?= $manage_shipment_details['supervisor_sign']  ?>" width="100%" height="250px">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label" for="cf-default-textarea">Comment</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control form-control-sm singleField"  placeholder="Write your message"><?= $manage_shipment_details['note']  ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-lg btn-success" onclick="showImages()">Show Image</button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <a type="button" href="<?= route_to('file_pdf', $manage_shipment_details['hash']) ?>" class="btn btn-lg btn-success">Download Reciept</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-lg btn-success" onclick="window.print()">Print Reciept</button>
                    </div>
                </div>
                <div class="col-12" id="detailsImages" style="display: none;">
                    <div class="row">
                        <?php

                        $files = json_decode($manage_shipment_details['files']);
                        $filesCount = count($files);


                        for ($i = 0; $i < $filesCount; $i++) {
                            $fileKey = 'file' . ($i + 1);
                            $commentKey = 'desc' . ($i + 1);
                            echo '<div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Image</label>
                        <div class="form-control-wrap">
                        <img src="../' . $files[$i]->$fileKey . '" width="100%" height="250px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="cf-default-textarea">Comment</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control form-control-sm" id="cf-default-textarea" placeholder="Write your message">' . $files[$i]->$commentKey . '</textarea>
                        </div>
                    </div>
                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>



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
</script>
<?= $this->endSection() ?>