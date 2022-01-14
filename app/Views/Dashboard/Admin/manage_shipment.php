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
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="form-label">Search Shipment by Date Range</label>
                        <div class="form-control-wrap">
                            <form class="input-daterange date-picker-range input-group" method="post">
                                <input type="text" class="form-control" name="start_date" autocomplete="new-start_date">
                                <div class="input-group-addon">TO</div>
                                <input type="text" class="form-control" name="end_date" autocomplete="new-end_date">
                                <button type="submit" class="btn btn-dim btn-primary ml-2" name="form_name" value="date_form">Filter Data</button>
                                <a href="<?= route_to('download_all_shipments') ?>" type="link" class="btn  btn-primary ml-2"><em class="icon ni ni-download"></em><span>Download All Data</span> </a>
                            </form>
                        </div>
                    </div>
                </div>
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

<!-- <a href="javascript:void(0)" id="dlbtn" style="display: none;">
    <button type="button" id="mine">Export</button>
</a> -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    NioApp.DataTable('#datatableX', {
        language: {
            "processing": '<span class="processingData">Processing data...</span>'
        },
        responsive: {
            details: !0
        },
        lengthMenu: [
            [10, 15, 30, 50, 100, 200],
            [10, 15, 30, 50, 100, 200]
        ],
        // dom: 'Bflrtip',
        // buttons: [{
        //         extend: 'excelHtml5',
        //         text: 'Export Excel',
        //         className: 'btn btn-sm btn-primary'
        //     },{
        //         extend: 'pdfHtml5',
        //         text: 'Export PDF',
        //         className: 'btn btn-sm btn-primary'
        //     }
        // ],
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                    // modifier: {
                    //     selected: true
                    // }
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                    // modifier: {
                    //     selected: true
                    // }
                },
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6]
                    // modifier: {
                    //     selected: true
                    // }
                },
            }
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
        // select: true
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
                className: "nk-tb-col nk-tb-col-tools"
            }
        ],
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox nk-tb-col nk-tb-col-check',
            targets: 0
        }],
        columnDefs: [{
            orderable: false,
            targets: [0, 7]
        }],
        select: {
            style: 'os',
            selector: 'td:first-child',
            // className: 'nk-tb-col nk-tb-col-check',
        },
        order: [
            [1, 'asc']
        ],

        // columnDefs: [{
        //     orderable: false,
        //     targets: [0, 1, 2, 3]
        // }],
        // bFilter: true, // to display datatable search
    });
    $.fn.DataTable.ext.pager.numbers_length = 7;

    function openPopup(url) {
        console.log(url);
        window.open(url, 'popUpWindow', 'height=500,width=1000%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }
    // $('.open_new_window').on('click', function(){
    //     var url = $(this);
    //     console.log(url);
    //     console.log(url.attr('href'));
    //     console.log(url.attr('link2'));
    // })
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