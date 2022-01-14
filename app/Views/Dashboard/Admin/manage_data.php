<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>
<style>
    .processingData {
        color: red;
    }
</style>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Manage Data</h4>
        </div>
    </div>

    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label">Search Shipment by Date Range</label>
                        <div class="form-control-wrap">
                            <div class="input-daterange date-picker-range input-group">
                                <input type="text" class="form-control">
                                <div class="input-group-addon">TO</div>
                                <input type="text" class="form-control">
                                <a href="#" class="input-group-addon btn btn-dim btn-primary">Filter Data</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-none">
                    <div class="form-group">
                        <label class="form-label">Search Multiple Attributes</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" placeholder="Input placeholder">
                        </div>
                        <div class="form-control-wrap mt-2">
                            <a href="#" class="btn btn-dim btn-primary">Filter Data</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <div class="form-control-wrap">
                            <a href="#" class="btn btn-primary ml-2"><em class="icon ni ni-download"></em><span>Download All Data</span> </a>
                            <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modalDefault"><em class="icon ni ni-plus"></em><span>Replace Data</span> </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Files</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">Replce any CRN or Asset ID</div>
                    <div class="card-body">
                        <div class="preview-block">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label">CRN</label>
                            </div>
                            <div class="custom-control custom-radio ml-3">
                                <input type="radio" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label">Asset Id</label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" placeholder="Replace">
                            </div>
                            <div class="form-control-wrap mt-2">
                                <a href="#" type="button" class="btn btn-dim btn-primary ">Replace</a>
                            </div>
                        </div>
                        <div class="col-12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Modal Footer Text</span>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    NioApp.DataTable('#datatableX', {
        // dom: 'lrtip',
        language: {
            "processing": '<span class="processingData">Processing data...</span>'
        },
        responsive: {
            details: !0
        },
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                    // modifier: {
                    //     selected: true
                    // }
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                    // modifier: {
                    //     selected: true
                    // }
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                    // modifier: {
                    //     selected: true
                    // }
                },
            }
        ],
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
                data: "files",
                className: "nk-tb-col"
            },
            {
                data: "userCountry",
                className: "nk-tb-col"
            },
            {
                data: "verifyStatus",
                className: "nk-tb-col"
            },
            {
                data: "actions",
                className: "nk-tb-col nk-tb-col-tools"
            }
        ],
        columnDefs: [{
            orderable: false,
            targets: [0, 8]
        }],
        select: {
            style: 'os',
            selector: 'td:first-child',
            // className: 'nk-tb-col nk-tb-col-check',
        },
        order: [
            [1, 'asc']
        ],
        // bFilter: true, // to display datatable search
    });
    $.fn.DataTable.ext.pager.numbers_length = 7;

    function openPopup(url) {
        console.log(url);
        window.open(url, 'popUpWindow', 'height=500,width=1000%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }

    function myFunction(url) {
        console.log(url);
        var mainUrl = window.location.origin;
        const _url = mainUrl + url;
        navigator.clipboard.writeText(_url);
        alert("Copied the text: " + _url);
    }

    function deleteData(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: '',
            data: {
                delete: 'del',
                id: id
            },
            success: function(result) {

                location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>