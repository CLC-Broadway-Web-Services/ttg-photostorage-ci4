<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Manage Shipment</h4>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-md-6 col-12">
                    <div class="form-group w-100">
                        <label class="form-label">Search Shipment by Date Range</label>
                        <div class="form-control-wrap">
                            <form class="input-daterange date-picker-range input-group" method="get">
                                <input type="text" class="form-control" name="start_date" autocomplete="new-start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                                <div class="input-group-addon">TO</div>
                                <input type="text" class="form-control" name="end_date" autocomplete="new-end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                                <button type="submit" class="btn btn-dim btn-primary input-group-addon" name="form_name" value="date_form">Filter Data</button>
                                <?php if (isset($_GET['end_date'])) : ?>
                                    <a class="btn btn-dim btn-danger input-group-addon" title="Reset Form" href="<?= route_to('manage_shipment') ?>">
                                        <em class="ni ni-reload-alt"></em>
                                    </a>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <div class="form-control-wrap">
                            <a href="<?= route_to('download_all_shipments') ?>" type="link" class="btn  btn-primary ml-2"><em class="icon ni ni-download"></em><span>Download All Data</span> </a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="card card-preview">
        <div class="card-inner table-responsive">
            <table class="nk-tb-list nk-tb-ulist" id="datatableX" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"></th>
                        <th class="nk-tb-col"><span class="sub-text">Staff Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">CRN</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Date & <br>Time</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Logistic <br> Company</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Packaging <br>Quality</span></th>
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

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
    function formatLink(data) {
        var thisData = $(data).attr('dataLink');
        // console.log(thisData);
        return thisData;
    }
    NioApp.DataTable('#datatableX', {
        lengthMenu: [
            [10, 15, 30, 50, 100, 200],
            [10, 15, 30, 50, 100, 200]
        ],
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7],
                    orthogonal: 'export'
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7],
                    orthogonal: 'export'
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7],
                    orientation: 'landscape',
                    pageSize: 'A4',
                    orthogonal: 'export',
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6],
                    orthogonal: 'export',
                    // orientation: 'landscape',
                },
            },
            // 'selected',
            // 'selectedSingle',
            // 'selectAll',
            'selectNone',
            // 'selectRows',
            // 'selectColumns',
            // 'selectCells'
        ],
        select: {
            style: 'multi'
        },
        order: [
            [1, 'asc']
        ],
        createdRow: function(row, data, dataIndex) {
            // console.log(data['condition'])
            var extraClass = '';
            if (data['condition'] == 'Rejected') {
                extraClass = 'bg-danger text-white';
            }
            // Set the data-status attribute, and add a class
            $(row).addClass('nk-tb-item ' + extraClass);
        },
        bProcessing: true,
        serverSide: true,
        ajax: {
            url: "", // json datasource
            type: "post",
            data: {
                // key1: value1 - in case if we want send data with request
            }
        },
        columns: [{
                data: "id",
                // className: "nk-tb-col nk-tb-col-check"
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
                data: "time",
                className: "nk-tb-col"
            },
            {
                data: "logistic_company",
                className: "nk-tb-col"
            },
            {
                data: "userCountry",
                className: "nk-tb-col"
            },
            {
                data: "box_condition",
                className: "nk-tb-col"
            },
            {
                data: "actions",
                className: "nk-tb-col nk-tb-col-tools",
                render: function(data, type, row) {
                    return type === 'export' ? formatLink(data) : data;
                }
            }
        ],
        columnDefs: [{
            targets: 0,
            orderable: false,
            className: 'select-checkbox nk-tb-col nk-tb-col-check',
            checkboxes: {
                selectRow: true
            }
        }],
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
    function getExcel(id) {
        alert(id);
        $.ajax({
            type: 'POST',
            url: '',
            data: {
                csv: 'csv',
                id: id
            },
            success: function(result) {
                console.log(result);
                // return;/
                setTimeout(function() {
                    var dlbtn = document.getElementById("dlbtn");
                    var file = new Blob([result], {
                        type: 'text/csv'
                    });
                    dlbtn.href = URL.createObjectURL(file);
                    dlbtn.download = 'Assets.csv';
                    $("#mine").click();
                }, 2000);
            }
        });
    }
</script>
<?= $this->endSection() ?>