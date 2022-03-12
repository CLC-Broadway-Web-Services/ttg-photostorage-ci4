<?= $this->extend('Dashboard/clientlayout') ?>

<?= $this->section('content') ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Search Data by Asset ID</h4>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-header bg-primary text-white"><b>Perform Operations</b>
            <?php if (isset($_GET['end_date']) || isset($_GET['assets'])) : ?>
                <a class="float-end text-white" style="font-size: 20px; line-height: 0;" href="<?= route_to('client_asset_search') ?>">
                    <em class="ni ni-reload"></em>
                </a>
            <?php endif; ?>
        </div>
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-md-5 col-12 mt-0">
                    <div class="form-group w-100">
                        <label class="form-label">Seperate Asset ID's with comma, for multiple search.</label>
                        <div class="form-control-wrap">
                            <form class="input-group" method="get" action="">
                                <input type="text" name="assets" class="form-control" required placeholder="Enter Asset ID's" value="<?= isset($_GET['assets']) ? $_GET['assets'] : '' ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><em class="ni ni-search"></em></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['end_date']) || isset($_GET['assets'])) : ?>
                    <div class="col-md-6 col-12 mt-0">
                        <div class="form-group w-100">
                            <label class="form-label">Search Data by Date Range</label>
                            <form class="form-control-wrap">
                                <input type="text" name="assets" class="d-none" value="<?= isset($_GET['assets']) ? $_GET['assets'] : '' ?>">
                                <div class="input-daterange date-picker-range input-group" method="get" action="">
                                    <input type="text" class="form-control" name="start_date" required autocomplete="new-start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                                    <div class="input-group-addon">TO</div>
                                    <input type="text" class="form-control" name="end_date" required autocomplete="new-end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                                    <button type="submit" class="btn btn-dim btn-primary input-group-addon">Filter Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1 col-12 mt-0">
                        <div class="form-group w-100">
                            <label class="form-label" style="display: block;">&nbsp;</label>
                            <!-- <div class="form-control-wrap"> -->
                            <a class="btn btn-danger" href="<?= route_to('client_asset_search') ?>">
                                Reset
                            </a>
                            <!-- </div> -->
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['end_date']) || isset($_GET['assets'])) : ?>
        <div class="card card-preview">
            <div class="card-inner">
                <!-- <ul class="nav nav-tabs">
                    <li class="nav-item me-2"> <a class="nav-link active" data-toggle="tab" href="#crn_data_tab">CRN Data</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#shipment_data_tab">Shipment Data</a> </li>
                </ul> -->
                <!-- <div class="tab-content"> -->
                    <!-- <div class="tab-pane active" id="crn_data_tab"> -->
                        <table class="nk-tb-list nk-tb-ulist nowrap dtr-inline table" id="datatableX" data-auto-responsive="true">
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
                                    <th class="nk-tb-col nk-tb-col-tools text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($manageData as $key => $value) : ?>
                                    <tr class="nk-tb-item" id="tableRow_<?= $key ?>" dataId="<?= $value['id'] ?>">
                                        <td><?= $value['id'] ?></td>
                                        <td><?= $value['userid'] ?></td>
                                        <td><?= $value['crn'] ?></td>
                                        <td><?= $value['uid'] ?></td>
                                        <td><?= $value['time'] ?></td>
                                        <td><?= $value['files'] ?></td>
                                        <td><?= $value['userCountry'] ?></td>
                                        <td><?= $value['verifyStatus'] ?></td>
                                        <td><?= $value['actions'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <!-- </div> -->
                    <!-- <div class="tab-pane" id="shipment_data_tab">
                        <table class="nk-tb-list nk-tb-ulist nowrap dtr-inline table" id="datatableShipment" data-auto-responsive="true">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"></th>
                                    <th class="nk-tb-col"><span class="sub-text">Staff Id</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">CRN</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Date-Time</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Logistic<br>Company</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Packaging<br>Quality</span></th>
                                    <th class="nk-tb-col text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
    <?php endif; ?>
</div> <!-- nk-block -->

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<?php if (isset($_GET['end_date']) || isset($_GET['assets'])) : ?>
    <script>
        function formatLink(data) {
            var thisData = $(data).attr('dataLink');
            // console.log(thisData);
            return thisData;
        }
        NioApp.DataTable('#datatableX', {
            fixedHeader: true,
            lengthMenu: [
                [10, 15, 30, 50, 100, 200, 500, 1000],
                [10, 15, 30, 50, 100, 200, 500, 1000]
            ],
            bFilter: false,
            buttons: [{
                    extend: 'copy',
                    titleAttr: 'Copy Data',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8],
                        orthogonal: 'export'
                    },
                },
                {
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
                        orthogonal: 'export',
                        // orientation: 'landscape',
                    },
                }
            ],
            select: {
                style: 'multi'
            },
            order: [
                [5, 'desc']
            ],
            // createdRow: function(row, data, dataIndex) {
            //     $(row).addClass('nk-tb-item');
            //     $(row).attr('id', 'tableRow_' + dataIndex);
            //     $(row).attr('dataId', data['id']);
            // },
            // bProcessing: true,
            // serverSide: true,
            // ajax: {
            //     url: "", // json datasource
            //     type: "post",
            //     data: {
            //         // key1: value1 - in case if we want send data with request
            //     }
            // },
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
                    className: "nk-tb-col py-0 text-right",
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
            fnInitComplete: function(oSettings, json) {
                datatableCustomButtons(0);
                // alert('DataTables has finished its initialisation.');
            }
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
        // NioApp.DataTable('#datatableShipment', {
        //     fixedHeader: true,
        //     lengthMenu: [
        //         [10, 15, 30, 50, 100, 200, 500, 1000],
        //         [10, 15, 30, 50, 100, 200, 500, 1000]
        //     ],
        //     bFilter: false,
        //     buttons: [{
        //             extend: 'copy',
        //             titleAttr: 'Copy Data',
        //             exportOptions: {
        //                 columns: [1, 2, 3, 4, 5, 6, 7, 8],
        //                 orthogonal: 'export'
        //             },
        //         },
        //         {
        //             extend: 'excel',
        //             titleAttr: 'Download Excel',
        //             exportOptions: {
        //                 columns: [1, 2, 3, 4, 5, 6, 7, 8],
        //                 orthogonal: 'export'
        //             },
        //         },
        //         {
        //             extend: 'print',
        //             titleAttr: 'Print Data',
        //             exportOptions: {
        //                 columns: [1, 2, 3, 4, 5, 6, 7],
        //                 orthogonal: 'export',
        //                 // orientation: 'landscape',
        //             },
        //         }
        //     ],
        //     select: {
        //         style: 'multi'
        //     },
        //     order: [
        //         [4, 'desc']
        //     ],
        //     columns: [{
        //             data: "id",
        //             // className: "nk-tb-col nk-tb-col-check"
        //         },
        //         {
        //             data: "userid",
        //             className: "nk-tb-col"
        //         },
        //         {
        //             data: "crn",
        //             className: "nk-tb-col tb-col-md"
        //         },
        //         {
        //             data: "time",
        //             className: "nk-tb-col tb-col-md"
        //         },
        //         {
        //             data: "logistic_company",
        //             className: "nk-tb-col tb-col-md"
        //         },
        //         {
        //             data: "userCountry",
        //             className: "nk-tb-col tb-col-md"
        //         },
        //         {
        //             data: "box_condition",
        //             className: "nk-tb-col tb-col-md"
        //         },
        //         {
        //             data: "actions",
        //             className: "nk-tb-col py-0 text-right",
        //             render: function(data, type, row) {
        //                 return type === 'export' ? formatLink(data) : data;
        //             }
        //         }
        //     ],
        //     columnDefs: [{
        //         targets: 0,
        //         orderable: false,
        //         className: 'select-checkbox nk-tb-col nk-tb-col-check',
        //         checkboxes: {
        //             selectRow: true
        //         }
        //     }],
        //     fnInitComplete: function(oSettings, json) {
        //         datatableCustomButtons(1);
        //         // alert('DataTables has finished its initialisation.');
        //     }
        // });
        $.fn.DataTable.ext.pager.numbers_length = 7;

        function openPopup(url) {
            console.log(url);
            window.open(url, 'popUpWindow', 'height=500,width=1000%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        }

        function datatableCustomButtons(index) {
            var tableButtons = document.getElementsByClassName('dt-buttons')[index];
            var button = document.createElement('button');
            var emphasized = document.createElement('em');
            emphasized.classList.add('px-2');
            // emphasized.classList.add('text-danger');
            emphasized.style.fontSize = '18px';
            emphasized.classList.add('ni');
            emphasized.classList.add('ni-file-pdf');
            button.setAttribute('type', 'button');
            button.setAttribute('id', 'deleteButton');
            button.setAttribute('onclick', 'onclickMultiplePdf()')
            button.classList.add('btn');
            // button.classList.add('btn-sm');
            button.classList.add('btn-secondary');
            button.classList.add('buttons-delete');
            button.classList.add('buttons-html5');
            button.setAttribute('type', 'submit');
            button.setAttribute('title', 'Download PDF');
            button.setAttribute('tabindex', '0');
            button.setAttribute('aria-controls', 'datatableX');
            button.appendChild(emphasized);
            // document.querySelectorAll('.dt-buttons').forEach(function(button) {
            //     button.append(button);
            // })
            // tableButtons.forEach((button) {
            //     button.append(button);
            // })
            tableButtons.append(button);
        }

        var thisTable = $('#datatableX').DataTable();

        function myFunction(url) {
            console.log(url);
            var mainUrl = window.location.origin;
            const _url = mainUrl + url;
            navigator.clipboard.writeText(_url);
            alert("Copied the text: " + _url);
        }

        function ttg_imagepdf(uid) {

            var formData = new FormData();
            formData.append('form_name', 'generate_single_pdf');
            formData.append('uid', uid);

            console.log(Array.from(formData));

            $.ajax({
                url: '',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false
            }).done(function(response) {
                console.log(response)
            }).fail(function(error) {
                console.log(error)
            })

            // var xhttp = new XMLHttpRequest();
            // url = "https://ttg-photostorage.com/?genrate_pdf=" + y6;

            // xhttp.onreadystatechange = function() {
            //     if (this.readyState == 4) {
            //         if (this.status == 200) {
            //             var contentType = xhttp.getResponseHeader("Content-Type");
            //             if (contentType == "application/x-download") {
            //                 var end = window.performance.now();
            //                 console.log(end);
            //                 window.location.href = url;
            //                 tooltip.innerHTML = "PDF Generated";
            //                 alert("File generated successfully");
            //             } else {
            //                 tooltip.innerHTML = "PDF Generation Failed";
            //                 alert(this.responseText);
            //             }
            //         }
            //     }
            // };
            // xhttp.open("GET", url, true);
            // // xhttp.responseType = "blob";
            // xhttp.send();
        }

        function onclickMultiplePdf() {
            var rows_selected = thisTable.rows('.selected');
            // console.log(rows_selected);
            if ($(rows_selected)[0].length) {
                var ids = [];
                $(rows_selected)[0].forEach(element => {
                    var dataId = $('tr#tableRow_' + element);
                    // console.log(dataId.attr('dataId'));
                    ids.push(dataId.attr('dataId'));
                });
                onclickPdf(ids, false);
            } else {
                swal({
                    title: "No data selected",
                    icon: "warning",
                })
            }
        }

        function onclickSinglePdf(id) {
            onclickPdf(id);
        }

        function onclickPdf(ids, single = true) {
            // console.log(ids)
            var formName = single ? 'generate_single_pdf' : 'generate_multiple_pdf';
            $.ajax({
                type: 'POST',
                url: '',
                data: {
                    form_name: formName,
                    id: ids
                },
                // dataType: 'native',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(result) {
                    var data = result;
                    console.log(data);

                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    link.download = "TTG_PHOTOSTORAGE_" + new Date() + ".pdf";
                    link.click();

                    // var blob = new Blob([data], {
                    //     type: "application/octetstream"
                    // });
                    // var fileName = 'newPdf';
                    // var isIE = false || !!document.documentMode;
                    // if (isIE) {
                    //     window.navigator.msSaveBlob(blob, fileName);
                    // } else {
                    //     var url = window.URL || window.webkitURL;
                    //     link = url.createObjectURL(blob);
                    //     var a = $("<a />");
                    //     a.attr("download", fileName);
                    //     a.attr("href", link);
                    //     $("body").append(a);
                    //     a[0].click();
                    //     $("body").remove(a);
                    // }
                }
            });
        }
    </script>
<?php endif; ?>
<?= $this->endSection() ?>