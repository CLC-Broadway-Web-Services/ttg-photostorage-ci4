<?php if (session()->get('userLoggedIn')) : ?>
    <?= $this->extend('Dashboard/popuplayout') ?>
    <?= $this->section('content') ?>
    <style>
        .form-control[disabled],
        .form-select[disabled],
        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #fff !important;
        }
    </style>

    <div class="container maxwidth800">
        <div class="card">
            <div class="card-header border-bottom bg-primary text-white"><b><em class="ni ni-server-fill"></em> Shipment Details for <?= $manage_shipment_details['crn']  ?></b></div>
            <div class="card-body">
                <form method="post" id="shipmentForm">
                    <div class="row g-4">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="crn" name="crn" value="<?= $manage_shipment_details['crn']  ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="crn">CRN</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="time" name="time" value="<?= date("d M Y, g:s A", $manage_shipment_details['time']); ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="time">Date & Time</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="number" class="form-control form-control-xl form-control-outlined onchangeSave" id="no_of_vahicle" name="no_of_vahicle" value="<?= $manage_shipment_details['no_of_vahicle'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="no_of_vahicle">No of Vehicles</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select onchangeSave" data-ui="xl" name="vahicle_type" id="vahicle_type" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Open' ? 'selected' : ''  ?> value="Open">Open</option>
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Close' ? 'selected' : ''  ?> value="Close">Close</option>
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Open&Close' ? 'selected' : ''  ?> value="Open&Close">Open & Close</option>
                                    </select>
                                    <label class="form-label-outlined" for="vahicle_type">Vehicle Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="vahicle_number" name="vahicle_number" value="<?= $manage_shipment_details['vahicle_number'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="vahicle_number">Vehicle Number/s</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="logistic_company" name="logistic_company" value="<?= $manage_shipment_details['logistic_company'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="logistic_company">Logistics Company</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select onchangeSave" data-ui="xl" name="box_condition" id="box_condition" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Poor' ? 'selected' : ''  ?> value="Poor">Poor</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Good' ? 'selected' : ''  ?> value="Good">Good</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Fair' ? 'selected' : ''  ?> value="Fair">Fair</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Rejected' ? 'selected' : ''  ?> value="Rejected">Rejected</option>
                                    </select>
                                    <label class="form-label-outlined" for="box_condition">Quality</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="number" class="form-control form-control-xl form-control-outlined onchangeSave" id="no_of_staff" name="no_of_staff" value="<?= $manage_shipment_details['no_of_staff'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="no_of_staff">No. of Staff</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="number" class="form-control form-control-xl form-control-outlined onchangeSave" id="no_of_devices" name="no_of_devices" value="<?= $manage_shipment_details['no_of_devices'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="no_of_devices">No. of Device</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="number" class="form-control form-control-xl form-control-outlined onchangeSave" id="no_of_box" name="no_of_box" value="<?= $manage_shipment_details['no_of_box'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="no_of_box">No. of Boxes</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="number" class="form-control form-control-xl form-control-outlined onchangeSave" id="no_of_pallets" name="no_of_pallets" value="<?= $manage_shipment_details['no_of_pallets'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="no_of_pallets">No. of Pallets</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="logistic_waybill" name="logistic_waybill" value="<?= $manage_shipment_details['logistic_waybill'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="logistic_waybill">Logistics Waybill</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="box_seal" name="box_seal" value="<?= $manage_shipment_details['box_seal'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="box_seal">Box Seal</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="supervisor_name" name="supervisor_name" value="<?= $manage_shipment_details['supervisor_name'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="supervisor_name">Supervisor Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <input type="text" class="form-control form-control-xl form-control-outlined onchangeSave" id="supervisor_ph_no" name="supervisor_ph_no" value="<?= $manage_shipment_details['supervisor_ph_no'] ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                    <label class="form-label-outlined" for="supervisor_ph_no">Supervisor Phone No.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded p-2">
                                <label class="form-label">Declaration</label>
                                <div>
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input onchangeSave" <?= $manage_shipment_details['declr_tick'] == 'yes' || 'Yes' ? 'checked' : '' ?> id="declr_tick" name="declr_tick" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>>
                                        <label class="custom-control-label" for="declr_tick">
                                            I hereby declare that the above mentioned content of this shipment are fully correct to the best of my knowledge and belief
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="border rounded p-2">
                                <label class="form-label">Supervisor Sign</label>
                                <img src="<?= file_exists('/' . $manage_shipment_details['supervisor_sign']) ? '/' . $manage_shipment_details['supervisor_sign'] : '/public/images/image-not-found.jpg' ?>" class="w-100 rounded">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group h-100">
                                <div class="form-control-wrap h-100">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <textarea class="form-control form-control-xl form-control-outlined h-100 onchangeSave" id="note" name="note" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>><?= $manage_shipment_details['note'] ?></textarea>
                                    <label class="form-label-outlined" for="note">Comment/Note</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card d-print-none">
            <div class="card-header border-bottom bg-primary text-white"><b><em class="ni ni-server"></em> Action Buttons</b></div>
            <div class="card-body row text-center">
                <div class="col-md-4 col-12">
                    <button type="button" class="btn btn-success w-100 text-center d-block" onclick="showImages()">Show Images</button>
                </div>
                <div class="col-md-4 col-12">
                    <a type="button" class="btn btn-success w-100 text-center d-block" href="<?= route_to('file_pdf', $manage_shipment_details['hash']) ?>">Download Reciept</a>
                </div>
                <div class="col-md-4 col-12">
                    <button type="button" class="btn btn-success w-100 text-center d-block" onclick="window.print()">Print Reciept</button>
                </div>
            </div>
        </div>
        <div class="card d-print-none" id="detailsImages" style="display: none;">
            <div class="card-header border-bottom bg-primary text-white"><b><em class="ni ni-img-fill"></em> Shipment Images</b></div>
            <div class="card-body row">
                <?php
                $files = json_decode($manage_shipment_details['files']);
                $filesCount = count($files);
                for ($i = 0; $i < $filesCount; $i++) {
                    $fileKey = 'file' . ($i + 1);
                    $commentKey = 'desc' . ($i + 1); ?>
                    <div class="col-md-6 pt-4">
                        <div class="border rounded p-2">
                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <div class="form-control-wrap">
                                    <img src="<?= file_exists('/' . $files[$i]->$fileKey) ? '/' . $files[$i]->$fileKey : '/public/images/image-not-found.jpg' ?>" class="w-100 rounded">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <textarea class="form-control form-control-xl form-control-outlined" id="cf-default-textarea<?= $i ?>" <?= session()->get('loginType') == 'client' || session()->get('loginType') == 'guest' ? 'disabled' : '' ?>><?= $files[$i]->$commentKey ? $files[$i]->$commentKey : 'No Comments' ?></textarea>
                                    <label class="form-label-outlined" for="cf-default-textarea<?= $i ?>">Comments</label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
    </script>
    <?php if (session()->get('loginType') == 'superadmin' || session()->get('loginType') == 'admin') : ?>
        <script>
            // single fields submition
            // $('.submitButton').on('click', function() {
            //     var field = $(this).closest('.input-group').find('.singleField');
            //     var fieldName = $(field).attr('name');
            //     var fieldValue = $(field).val();

            //     var formData = new FormData();
            //     formData.append('form_name', 'single_submition');
            //     formData.append(fieldName, fieldValue);

            //     $.ajax({
            //         url: '',
            //         type: 'post',
            //         data: formData,
            //         contentType: false,
            //         processData: false
            //     }).done(function(response) {
            //         console.log(response)
            //     }).fail(function(error) {
            //         console.log(error)
            //     })
            // });
            $('.onchangeSave').on('change', function(event) {
                var fieldLabel = $(this).closest('.form-control-wrap').find('.form-label-outlined').html();
                var fieldName = $(this).attr('name');
                var fieldValue = $(this).val();

                console.log(fieldLabel)
                console.log(fieldName)
                console.log(fieldValue)

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
                    var returnData = JSON.parse(response);
                    if (returnData) {
                        swal({
                                title: "Success",
                                text: fieldLabel.toUpperCase()+" changed successfully.",
                                icon: "success",
                                // buttons: true,
                                // dangerMode: true,
                            })
                    }
                }).fail(function(error) {
                    console.log(error)
                })
            })
        </script>
    <?php endif; ?>
    <?= $this->endSection() ?>
<?php else : ?>
    <?= view('Auth/guest_login') ?>
<?php endif; ?>