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
            <div class="nk-block-des">
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
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
        </div>
    </div><!-- .card-preview -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row g-gs">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-bottom">Search Shipment by Date Range(Enter date from & to)</div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-daterange date-picker-range input-group">
                                        <input type="text" class="form-control">
                                        <div class="input-group-addon">TO</div>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="input-daterange date-picker-range input-group mt-2">
                                        <a href="#" class="btn btn-dim btn-primary">Filter Data</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-bottom">Sport Data</div>
                        <div class="card-body">
                            <div class="preview-block">
                                <span class="preview-title overline-title mb-3"> Sort Data Select Device Type</span>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label">Desktop</label>
                                </div>
                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label">Notebook</label>
                                </div>
                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label">Other Device</label>
                                </div>
                            </div>
                            <div class="col-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .card-preview -->
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="nk-tb-list nk-tb-ulist" id="datatableX" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Staff ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">CRN</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Asset ID</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Time</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Device Type</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text"> Defects</span></th>
                        <!-- <th class="nk-tb-col nk-tb-col-tools text-right">Action
                        </th> -->
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
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
            responsive: {
                details: true
            },
            createdRow: function(row, data, dataIndex) {
                // Set the data-status attribute, and add a class
                $(row).addClass('nk-tb-item');
            },
            lengthMenu: [
                [10, 15, 30, 50, 100, 200],
                [10, 15, 30, 50, 100, 200]
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
            columns: [{
                    data: "id",
                    className: "nk-tb-col nk-tb-col-check"
                },
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

            columnDefs: [{
                orderable: false,
                targets: [0, 1, 2, 3]
            }],
            // bFilter: true, // to display datatable search
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
    });

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