<?php if (session()->get('userLoggedIn')) : ?>
    <?= $this->extend('Dashboard/popuplayout') ?>
    <?= $this->section('content') ?>

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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="crn" name="crn" value="<?= $manage_shipment_details['crn']  ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="time" name="time" value="<?= date("d M Y, g:s A", $manage_shipment_details['time']); ?>">
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
                                    <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_vahicle" name="no_of_vahicle" value="<?= $manage_shipment_details['no_of_vahicle'] ?>">
                                    <label class="form-label-outlined" for="no_of_vahicle">No of Vehicles</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" data-ui="xl" name="vahicle_type" id="vahicle_type">
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Open' ? 'selected' : ''  ?> value="Open">Open</option>
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Close' ? 'selected' : ''  ?> value="Close">Close</option>
                                        <option <?= $manage_shipment_details['vahicle_type'] == 'Open&Close' ? 'selected' : ''  ?> value="Open&Close">Open & Close</option>
                                    </select>
                                    <!-- <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_vahicle" name="no_of_vahicle" value="<?= $manage_shipment_details['no_of_vahicle'] ?>"> -->
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="vahicle_number" name="vahicle_number" value="<?= $manage_shipment_details['vahicle_number'] ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="logistic_company" name="logistic_company" value="<?= $manage_shipment_details['logistic_company'] ?>">
                                    <label class="form-label-outlined" for="logistic_company">Logistics Company</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" data-ui="xl" name="box_condition" id="box_condition">
                                        <option <?= $manage_shipment_details['box_condition'] == 'Poor' ? 'selected' : ''  ?> value="Poor">Poor</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Good' ? 'selected' : ''  ?> value="Good">Good</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Fair' ? 'selected' : ''  ?> value="Fair">Fair</option>
                                        <option <?= $manage_shipment_details['box_condition'] == 'Rejected' ? 'selected' : ''  ?> value="Rejected">Rejected</option>
                                    </select>
                                    <!-- <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_vahicle" name="no_of_vahicle" value="<?= $manage_shipment_details['no_of_vahicle'] ?>"> -->
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
                                    <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_staff" name="no_of_staff" value="<?= $manage_shipment_details['no_of_staff'] ?>">
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
                                    <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_devices" name="no_of_devices" value="<?= $manage_shipment_details['no_of_devices'] ?>">
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
                                    <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_box" name="no_of_box" value="<?= $manage_shipment_details['no_of_box'] ?>">
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
                                    <input type="number" class="form-control form-control-xl form-control-outlined" id="no_of_pallets" name="no_of_pallets" value="<?= $manage_shipment_details['no_of_pallets'] ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="logistic_waybill" name="logistic_waybill" value="<?= $manage_shipment_details['logistic_waybill'] ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="box_seal" name="box_seal" value="<?= $manage_shipment_details['box_seal'] ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="supervisor_name" name="supervisor_name" value="<?= $manage_shipment_details['supervisor_name'] ?>">
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
                                    <input type="text" class="form-control form-control-xl form-control-outlined" id="supervisor_ph_no" name="supervisor_ph_no" value="<?= $manage_shipment_details['supervisor_ph_no'] ?>">
                                    <label class="form-label-outlined" for="supervisor_ph_no">Supervisor Phone No.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded p-2">
                                <label class="form-label">Declaration</label>
                                <div>
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" <?= $manage_shipment_details['declr_tick'] == 'yes' || 'Yes' ? 'checked' : '' ?> id="declr_tick" name="declr_tick">
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
                                <div>
                                    <img src="../<?= $manage_shipment_details['supervisor_sign']  ?>" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right submitButton d-print-none">
                                        <em class="icon ni ni-check-circle-cut text-success"></em>
                                    </div>
                                    <textarea class="form-control form-control-xl form-control-outlined" id="note" name="note" value="<?= $manage_shipment_details['note'] ?>"></textarea>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <div class="form-control-wrap">
                                <img src="../<?= $files[$i]->$fileKey ?>" width="100%" height="250px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="cf-default-textarea<?= $i ?>">Comment</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control form-control-sm" id="cf-default-textarea<?= $i ?>" placeholder="Write your message"><?= $files[$i]->$commentKey ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>




    <div class=" card">
        <div class="card-header border-bottom bg-primary text-white">Shipment Details For Test Ship 1we</div>
        <div class="card-body">
            <form method="post">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="full-name-1">CRN</label>
                            <div class="input-group">
                                <input type="text" class="form-control singleField" placeholder="Input placeholder" value="<?= $manage_shipment_details['crn']  ?>">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                    <button type="button" class="btn btn-success submitButton d-print-none">
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
                                <textarea class="form-control form-control-sm singleField" placeholder="Write your message"><?= $manage_shipment_details['note']  ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 d-print-none">
                        <div class="form-group">
                            <button type="button" class="btn btn-lg btn-success" onclick="showImages()">Show Image</button>
                        </div>
                    </div>
                    <div class="col-lg-3 d-print-none">
                        <div class="form-group">
                            <a type="button" href="<?= route_to('file_pdf', $manage_shipment_details['hash']) ?>" class="btn btn-lg btn-success">Download Reciept</a>
                        </div>
                    </div>
                    <div class="col-lg-3 d-print-none">
                        <div class="form-group">
                            <button type="button" class="btn btn-lg btn-success" onclick="window.print()">Print Reciept</button>
                        </div>
                    </div>
                    <div class="col-12 d-print-none" id="detailsImages" style="display: none;">
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
    </script>
    <?php if (session()->get('loginType') == 'client' || session()->get('loginType') == 'superadmin' || session()->get('loginType') == 'admin') : ?>
        <script>
            // single fields submition
            $('.submitButton d-print-none').on('click', function() {
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
    <?php endif; ?>
    <?= $this->endSection() ?>
<?php else : ?>
    <?= view('Auth/guest_login') ?>
<?php endif; ?>