<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Activity Logs</h4>
            <div class="nk-block-des">
                <p>Activity Logs List</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="table" id="datatableX" data-auto-responsive="true">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Event</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Event By</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Event On</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Time</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Device</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">IP address</span></th>
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
<script>
    var thisTable = NioApp.DataTable('#datatableX', {
        // fixedHeader: true,
        bFilter: true,
        lengthMenu: [
            [10, 15, 30, 50, 100, 200, 500, 1000],
            [10, 15, 30, 50, 100, 200, 500, 1000]
        ],
        buttons: [{
                extend: 'excel',
                titleAttr: 'Download Excel',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8],
                    orthogonal: 'export'
                },
            },
            {
                extend: 'print',
                titleAttr: 'Print Data',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7],
                    orthogonal: 'export'
                },
            }
        ],
        // select: {
        //     style: 'multi'
        // },
        order: [
            [4, 'desc']
        ],
        ordering: false,
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('nk-tb-item');
            // $(row).attr('id', 'tableRow_' + dataIndex);
            // $(row).attr('dataId', data['id']);
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
                data: "event",
                className: "nk-tb-col"
            },
            {
                data: "userid",
                className: "nk-tb-col"
            },
            {
                data: "datauid",
                className: "nk-tb-col"
            },
            {
                data: "time",
                className: "nk-tb-col"
            },
            {
                data: "device",
                className: "nk-tb-col"
            },
            {
                data: "ipaddress",
                className: "nk-tb-col"
            }
        ],
        // columnDefs: [{
        //     targets: 0,
        //     orderable: false,
        //     className: 'select-checkbox nk-tb-col nk-tb-col-check',
        //     checkboxes: {
        //         selectRow: true
        //     }
        // }],
        // fnInitComplete: function(oSettings, json) {
        //     datatableCustomButtons();
        //     // alert('DataTables has finished its initialisation.');
        // }
    });
    $.fn.DataTable.ext.pager.numbers_length = 7;
</script>

<?= $this->endSection() ?>