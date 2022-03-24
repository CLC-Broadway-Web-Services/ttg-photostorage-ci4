<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>
<style>
    #marquee .project .project-head {
        display: inline-block !important;
    }
</style>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Defect Analysis</h4>
        </div>
    </div>
    <!-- <div class="card card-preview"> -->
    <!-- <div class="card-inner"> -->
    <div class="row g-gs">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">CRN List</div>
                <div class="card-body">
                    <marquee width="100%" direction="left" height="60px" onmouseover="this.stop();" onmouseout="this.start();">
                        <div class="card-inne " id="marquee">
                            <div class="project">
                                <?php foreach ($crn_data as $crnData) :
                                    $crn = $crnData['crn'];
                                ?>
                                    <div class="project-head mr-3">

                                        <div href="#" class="project-title">
                                            <div class="user-avatar sq bg-purple"><span>RW</span></div>
                                            <div class="project-info">
                                                <h6 class="title" data-toggle="modal" data-target="#crnData">
                                                    <a href="javascript:void(0);" onclick="openPopup('<?php echo $crn; ?>')"> <?= $crn; ?></a>
                                                </h6>
                                                <span class="sub-text">Runnergy</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <!-- </div> -->


    <!-- <div class="card card-preview"> -->
    <!-- <div class="card-inner"> -->
    <div class="row g-gs">
        <div class="col-md-5 col-12 h-100">
            <div class="card h-100">
                <div class="card-header border-bottom">Search Shipment by Date Range(Enter date from & to)</div>
                <div class="card-body">
                    <div class="preview-block">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="input-daterange date-picker-range input-group">
                                    <input type="text" class="form-control">
                                    <div class="input-group-addon">TO</div>
                                    <input type="text" class="form-control">
                                    <a href="#" class="btn btn-dim btn-primary input-group-addon">Filter</a>
                                </div>
                                <!-- <div class="input-daterange date-picker-range input-group mt-2">
                                <a href="#" class="btn btn-dim btn-primary">Filter Data</a>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-12 h-100">
            <div class="card h-100">
                <div class="card-header border-bottom">Select device type</div>
                <div class="card-body">
                    <div class="preview-block">
                        <div class="custom-control custom-radio me-1">
                            <input type="radio" name="deviceType" class="custom-control-input deviceType" <?= isset($_GET['deviceType']) && $_GET['deviceType'] == 'Desktop' ? 'checked' : '' ?> id="deviceDesktop" value="Desktop">
                            <label class="custom-control-label" for="deviceDesktop">Desktop <b>(<?= $totals['desktops'] ?>)</b></label>
                        </div>
                        <div class="custom-control custom-radio me-1">
                            <input type="radio" name="deviceType" class="custom-control-input deviceType" <?= isset($_GET['deviceType']) && $_GET['deviceType'] == 'Notebook' ? 'checked' : '' ?> id="deviceNotebook" value="Notebook">
                            <label class="custom-control-label" for="deviceNotebook">Notebook <b>(<?= $totals['notebooks'] ?>)</b></label>
                        </div>
                        <div class="custom-control custom-radio me-1">
                            <input type="radio" name="deviceType" class="custom-control-input deviceType" <?= isset($_GET['deviceType']) && $_GET['deviceType'] == 'Other Device' ? 'checked' : '' ?> id="deviceOther" value="Other Device">
                            <label class="custom-control-label" for="deviceOther">Other Device <b>(<?= $totals['other_devices'] ?>)</b></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_GET['deviceType']) && ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook' || $_GET['deviceType'] == 'Other Device')) : ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">Select defect type</div>
                    <div class="card-body">
                        <div class="preview-block">
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook' || $_GET['deviceType'] == 'Other Device') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Motherboard Faulty' ? 'checked' : '' ?> id="motherboard_faulty" value="Motherboard Faulty">
                                    <label class="custom-control-label" for="motherboard_faulty">Motherboard Faulty <b>(<?= $defectTotals['motherboard_faulty'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'CPU Missing/Faulty' ? 'checked' : '' ?> id="cpu_missing_faulty" value="CPU Missing/Faulty">
                                    <label class="custom-control-label" for="cpu_missing_faulty">CPU Missing/Faulty <b>(<?= $defectTotals['cpu_missing_faulty'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Chassis Broken/Cracked' ? 'checked' : '' ?> id="chasis_broken_cracked" value="Chassis Broken/Cracked">
                                    <label class="custom-control-label" for="chasis_broken_cracked">Chassis Broken/Cracked <b>(<?= $defectTotals['chasis_broken_cracked'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Chassis Broken' ? 'checked' : '' ?> id="chasis_broken" value="Chassis Broken">
                                    <label class="custom-control-label" for="chasis_broken">Chassis Broken <b>(<?= $defectTotals['chasis_broken'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Chassis Cracked' ? 'checked' : '' ?> id="chasis_cracked" value="Chassis Cracked">
                                    <label class="custom-control-label" for="chasis_cracked">Chassis Cracked <b>(<?= $defectTotals['chasis_cracked'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Permanent Marking/Stained/Discolor' ? 'checked' : '' ?> id="permanent_marking_stained_discolor" value="Permanent Marking/Stained/Discolor">
                                    <label class="custom-control-label" for="permanent_marking_stained_discolor">Permanent Marking/Stained/Discolor <b>(<?= $defectTotals['permanent_marking_stained_discolor'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'BIOS Locked/Security Feature Type' ? 'checked' : '' ?> id="bios_locked_security_feature_type" value="BIOS Locked/Security Feature Type">
                                    <label class="custom-control-label" for="bios_locked_security_feature_type">BIOS Locked/Security Feature Type <b>(<?= $defectTotals['bios_locked_security_feature_type'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook' || $_GET['deviceType'] == 'Other Device') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Does Not Power-up' ? 'checked' : '' ?> id="does_not_power_up" value="Does Not Power-up">
                                    <label class="custom-control-label" for="does_not_power_up">Does Not Power-up <b>(<?= $defectTotals['does_not_power_up'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Desktop' || $_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Engraving/Scratch' ? 'checked' : '' ?> id="engraving_scratch" value="Engraving/Scratch">
                                    <label class="custom-control-label" for="engraving_scratch">Engraving/Scratch <b>(<?= $defectTotals['engraving_scratch'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Screen Spot/Blemish' ? 'checked' : '' ?> id="screen_spot_blemish" value="Screen Spot/Blemish">
                                    <label class="custom-control-label" for="screen_spot_blemish">Screen Spot/Blemish <b>(<?= $defectTotals['screen_spot_blemish'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Screen Broken/Line/Missing' ? 'checked' : '' ?> id="screen_broken_line_missing" value="Screen Broken/Line/Missing">
                                    <label class="custom-control-label" for="screen_broken_line_missing">Screen Broken/Line/Missing <b>(<?= $defectTotals['screen_broken_line_missing'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Keyboard Faulty/Key Missing' ? 'checked' : '' ?> id="keyword_faulty_key_missing" value="Keyboard Faulty/Key Missing">
                                    <label class="custom-control-label" for="keyword_faulty_key_missing">Keyboard Faulty/Key Missing <b>(<?= $defectTotals['keyword_faulty_key_missing'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Notebook') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Keyboard Panel Missing' ? 'checked' : '' ?> id="keyboard_panel_missing" value="Keyboard Panel Missing">
                                    <label class="custom-control-label" for="keyboard_panel_missing">Keyboard Panel Missing <b>(<?= $defectTotals['keyboard_panel_missing'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Other Device') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Parts Missing/Faulty' ? 'checked' : '' ?> id="parts_missing_faulty" value="Parts Missing/Faulty">
                                    <label class="custom-control-label" for="parts_missing_faulty">Parts Missing/Faulty <b>(<?= $defectTotals['parts_missing_faulty'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['deviceType'] == 'Other Device') : ?>
                                <div class="custom-control custom-radio me-3 mt-2">
                                    <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Broken/Cracked' ? 'checked' : '' ?> id="broken_cracked" value="Broken/Cracked">
                                    <label class="custom-control-label" for="broken_cracked">Broken/Cracked <b>(<?= $defectTotals['broken_cracked'] ?>)</b></label>
                                </div>
                            <?php endif; ?>
                            <div class="custom-control custom-radio me-3 mt-2">
                                <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'Other Defect' ? 'checked' : '' ?> id="other_defect" value="Other Defect">
                                <label class="custom-control-label" for="other_defect">Other Defect <b>(<?= $defectTotals['other_defect'] ?>)</b></label>
                            </div>
                            <div class="custom-control custom-radio me-3 mt-2">
                                <input type="radio" name="defectType" class="custom-control-input defectType" <?= isset($_GET['defectType']) && $_GET['defectType'] == 'No Defect Found' ? 'checked' : '' ?> id="no_defect" value="No Defect Found">
                                <label class="custom-control-label" for="no_defect">No Defects <b>(<?= $defectTotals['no_defect'] ?>)</b></label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- </div> -->
    <!-- </div> -->

    <div class="row g-gs">
        <div class="col-12">
            <div class="card card-preview">
                <div class="card-inner">
                    <table class="nk-tb-list nk-tb-ulist" id="datatableX" data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <!-- <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th> -->
                                <th class="nk-tb-col"><span class="sub-text">Staff ID</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">CRN</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Asset ID</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Time</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Device<br>Type</span></th>
                                <th class="nk-tb-col tb-col-lg"><span class="sub-text"> Defects</span></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="crnData">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">CRN Data</h5>
            </div>
            <div class="modal-body">
                <div href="html/apps-kanban.html" class="project-title">
                    <div class="user-avatar sq bg-purple"><span>CRN</span></div>
                    <div class="project-info">
                        <h6 class="title">CRN detail for <span id="crnName"></span></h6>
                        <p class="sub-text">Total No. of Assets in this CRN : <span id="assetCount"><?php json_decode('result'); ?></span></p>
                    </div>
                </div>
                <div class="card card-preview mt-4 bg-light">
                    <div class="card-inner">
                        <table class="nk-tb-list nk-tb-ulist" id="userTable" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text"> Device Type</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Quantity</span></th>
                                </tr>
                            </thead>
                            <tr>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="type">Notebook</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="note"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="type1">Other Device</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="device"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="type2">Desktop</span>
                                </td>
                                <td class="nk-tb-col tb-col-md">
                                    <span id="desk"></span>
                                </td>
                            </tr>
                            <tbody>

                            </tbody>
                        </table>

                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->

            </div>
            <div class="modal-footer bg-light">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function() {
        NioApp.DataTable('#datatableX', {
            fixedHeader: true,
            createdRow: function(row, data, dataIndex) {
                // Set the data-status attribute, and add a class
                $(row).addClass('nk-tb-item');
            },
            lengthMenu: [
                [10, 15, 30, 50, 100, 200, 500, 1000],
                [10, 15, 30, 50, 100, 200, 500, 1000]
            ], // page length options
            bProcessing: true,
            serverSide: true,
            // scrollY: "400px",
            // scrollCollapse: true,
            ajax: {
                url: "", // json datasource
                type: "post",
                data: {
                    // key1: value1 - in case if we want send data with request
                }
            },
            order: [
                [4, 'asc']
            ],
            columns: [
                // {
                //     data: "id",
                //     className: "nk-tb-col nk-tb-col-check"
                // },
                // {
                //     data: "staff_id",
                //     className: "nk-tb-col"
                // },
                {
                    data: "userid",
                    className: "nk-tb-col"
                },
                {
                    data: "crn",
                    className: "nk-tb-col"
                },
                {
                    data: "uid",
                    className: "nk-tb-col"
                },
                // {
                //     data: "asset_id",
                //     className: "nk-tb-col"
                // },
                {
                    data: "time",
                    className: "nk-tb-col"
                },
                {
                    data: "device_type",
                    className: "nk-tb-col"
                },
                {
                    data: "defect",
                    className: "nk-tb-col"
                },
                // {
                //     data: "actions",
                //     className: "nk-tb-col nk-tb-col-tools"
                // }
            ],

            // columnDefs: [{
            //     orderable: false,
            //     targets: [0, 1, 2, 3]
            // }],
            // bFilter: true, // to display datatable search
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
        $('.deviceType').on('click', function() {
            var value = $(this).val();
            console.log();
            var href = new URL(document.location);
            href.searchParams.set('deviceType', value);
            location.href = href.toString();
            // console.log(href.toString());
        })
        $('.defectType').on('click', function() {
            var value = $(this).val();
            console.log();
            var href = new URL(document.location);
            href.searchParams.set('defectType', value);
            location.href = href.toString();
        })
        // console.log(getAllValuesIds())
    });

    // function getAllValuesIds() {
    //     var ids = [];
    //     var values = [];

    //     document.getElementsByClassName('defectType').forEach((element, index) => {
    //         ids.push($(element).attr('id'));
    //         values.push($(element).val())
    //         console.log($(element).attr('id'))
    //         console.log($(element).val())
    //     });

    //     const returnData = [ids, values];
    //     console.log(returnData)

    //     return returnData;
    // }

    function openPopup(crn) {
        console.log(crn);
        $.ajax({
            type: 'POST',
            url: '',
            dataType: 'JSON',
            data: {
                asset: 'asset',
                crn: crn
            },
            success: function(result) {
                console.log(result);
                var crnLen = result.total_crn.length;
                var nootbookLen = result.nootbook.length;
                var OtherDeviceLen = result.otherDevice.length;
                var desktopLen = result.desktop.length;

                document.getElementById('crnName').innerHTML = crn;
                document.getElementById('assetCount').innerHTML = crnLen;
                document.getElementById('note').innerHTML = nootbookLen;
                document.getElementById('device').innerHTML = OtherDeviceLen;
                document.getElementById('desk').innerHTML = desktopLen;
                //    location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>