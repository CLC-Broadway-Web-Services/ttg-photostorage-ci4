<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Manage Data</h4>
        </div>
    </div>

    <div class="card card-preview">
        <div class="card-inner">
            <form class="row gy-4" method="GET" onSubmit="return checkform(this)">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label">Search Assets by Attributes</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" id="attributeSearch" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Enter Staff ID, CRN, Asset ID, Country" autocomplete="search">
                            </div>
                            <div class="mt-2">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="staffid" name="searchType" value="userid" class="custom-control-input" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'userid' ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="staffid">Staff Id</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="crnsearch" name="searchType" value="crn" class="custom-control-input" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'crn' ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="crnsearch">CRN</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="assetsearch" name="searchType" value="uid" class="custom-control-input" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'uid' ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="assetsearch">Asset ID</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="countrysearch" name="searchType" value="country" class="custom-control-input" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'country' ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="countrysearch">Country</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label class="form-label">Search Data by Date Range</label>
                        <div class="form-control-wrap">
                            <div class="input-daterange date-picker-range input-group">
                                <input type="text" class="form-control" name="start_date" id="startDate" autocomplete="new-start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                                <div class="input-group-addon">TO</div>
                                <input type="text" class="form-control" name="end_date" id="endDate" autocomplete="new-end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-0 text-end">
                    <div class="btn-group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary">Filter Data</button>
                        <?php if (isset($_GET['end_date']) || isset($_GET['search'])) : ?>
                            <a class="btn btn-dim btn-danger" title="Reset Filters" href="<?= route_to('manage_data') ?>">
                                <em class="ni ni-reload-alt"></em>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner table-responsive">
            <table class="nk-tb-list nk-tb-ulist nowrap dtr-inline table" id="datatableX" data-auto-responsive="false">
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
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="replaceDataModal">
    <div class="modal-dialog" role="document">
        <form class="modal-content" id="replaceDataForm">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Replce CRN or Asset ID to Selected data</h5>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <!-- <div class="card-header border-bottom">Replce any CRN or Asset ID</div> -->
                    <div class="card-body">
                        <div class="form-group mt-3">
                            <!-- <div class="form-group"> -->
                            <label class="form-label" for="replaceText">Replace to:- <b><span id="replacedDataCount">0</span></b> data</label>
                            <input type="text" class="form-control" id="replaceText" name="replaceText" placeholder="CRN / Asset ID" required>
                            <input type="text" class="d-none" id="dataIds" name="replaceDataIds">
                            <!-- </div> -->
                        </div>
                        <div class="preview-block">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="selectCrn" name="replace_data" value="crn" class="custom-control-input" required>
                                <label class="custom-control-label" for="selectCrn">CRN</label>
                            </div>
                            <div class="custom-control custom-radio ml-3">
                                <input type="radio" id="selectAsset" name="replace_data" value="uid" class="custom-control-input" required>
                                <label class="custom-control-label" for="selectAsset">Asset Id</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">
                    <button href="#" type="submit" class="btn btn-dim btn-primary ">Replace</button>
                </span>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function checkform(form) {
        var formData = new FormData($(form)[0]);
        console.log(Array.from(formData));

        var attributeSearch = $('#attributeSearch');
        var attributeType = $('input[name="searchType"]:checked');
        var startDate = $('#startDate');
        var endDate = $('#endDate');
        console.log(attributeSearch.val());
        console.log(startDate.val());
        console.log(endDate.val());
        console.log(attributeType.val());

        if (attributeSearch.val() == '' && endDate.val() == '') {
            return false;
        }
        if (attributeSearch.val() !== '' && attributeType.val() == undefined) {
            swal({
                title: "Attribute",
                text: "Select Type of search you want to proceed, EG: Staffid, CRN, Asset ID, Country",
                icon: "warning",
                // buttons: true,
                // dangerMode: true,
            })
            return false;
        }
        return true;
        // swal({
        //     title: "Are you sure?",
        //     text: "Once deleted, you will not be able to recover these data!",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // })
    }

    function formatLink(data) {
        var thisData = $(data).attr('dataLink');
        // console.log(thisData);
        return thisData;
    }
    var thisTable = NioApp.DataTable('#datatableX', {
        fixedHeader: true,
        bFilter: false,
        lengthMenu: [
            [10, 15, 30, 50, 100, 200, 500, 1000],
            [10, 15, 30, 50, 100, 200, 500, 1000]
        ],
        buttons: [
            // {
            //     extend: 'copy',
            //     titleAttr: 'Copy Data',
            //     exportOptions: {
            //         columns: [1, 2, 3, 4, 5, 6, 7, 8],
            //         orthogonal: 'export'
            //     },
            // },
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
            [1, 'asc']
        ],
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('nk-tb-item');
            $(row).attr('id', 'tableRow_' + dataIndex);
            $(row).attr('dataId', data['id']);
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
            datatableCustomButtons();
            // alert('DataTables has finished its initialisation.');
        }
    });
    $.fn.DataTable.ext.pager.numbers_length = 7;

    function openPopup(url) {
        console.log(url);
        window.open(url, 'popUpWindow', 'height=500,width=1000%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
    }

    function datatableCustomButtons() {
        var tableButtons = document.getElementsByClassName('dt-buttons')[0];

        var button = document.createElement('button');
        var emphasized = document.createElement('em');
        emphasized.classList.add('px-2');
        emphasized.classList.add('text-danger');
        emphasized.style.fontSize = '18px';
        emphasized.classList.add('ni');
        emphasized.classList.add('ni-trash-fill');
        button.setAttribute('type', 'button');
        button.setAttribute('id', 'deleteButton');
        button.setAttribute('onclick', 'onclickDeleteRows()')
        button.classList.add('btn');
        // button.classList.add('btn-sm');
        button.classList.add('btn-secondary');
        button.classList.add('buttons-delete');
        button.classList.add('buttons-html5');
        button.setAttribute('type', 'submit');
        button.setAttribute('title', 'Delete');
        button.setAttribute('tabindex', '0');
        button.setAttribute('aria-controls', 'datatableX');
        button.appendChild(emphasized);
        tableButtons.prepend(button);

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

        var button = document.createElement('button');
        var emphasized = document.createElement('em');
        emphasized.classList.add('px-2');
        emphasized.style.fontSize = '18px';
        emphasized.classList.add('ni');
        emphasized.classList.add('ni-file-pdf');
        button.setAttribute('type', 'button');
        button.setAttribute('id', 'deleteButton');
        button.setAttribute('onclick', 'replaceData()')
        button.classList.add('btn');
        button.classList.add('btn-secondary');
        button.classList.add('buttons-copy');
        button.classList.add('buttons-html5');
        button.setAttribute('type', 'submit');
        button.setAttribute('title', 'Replace Data');
        button.setAttribute('tabindex', '0');
        button.setAttribute('aria-controls', 'datatableX');
        button.prepend(emphasized);

        tableButtons.append(button);
    }

    var thisTable = $('#datatableX').DataTable();

    function onclickDeleteRows() {
        var rows_selected = thisTable.rows('.selected');
        if ($(rows_selected)[0].length) {
            var ids = [];
            $(rows_selected)[0].forEach(element => {
                var dataId = $('tr#tableRow_' + element);
                console.log(dataId.attr('dataId'));
                ids.push(dataId.attr('dataId'));
            });
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover these data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: '',
                            data: {
                                delete: 'multiDelete',
                                id: ids
                            },
                            success: function(result) {
                                console.log(result);
                                swal({
                                        title: "Success",
                                        text: "All rows deleted successfully.",
                                        icon: "success",
                                        buttons: true,
                                        // dangerMode: true,
                                    })
                                    .then((willDelete) => {
                                        location.reload();
                                    });
                                // dataId.remove();
                                // location.reload();
                            }
                        });
                    }
                });
        } else {
            swal({
                title: "No data selected",
                // text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                // buttons: true,
            })
        }
    }

    function myFunction(url) {
        // console.log(url);
        // var mainUrl = window.location.origin;
        const _url = url;
        navigator.clipboard.writeText(_url);
        alert("Copied the text: " + _url);
    }

    function deleteData(id) {
        console.log(id);
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
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
                } else {
                    swal("Your data is safe!");
                }
            });
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

        var url = '/download-data-pdf/generate_multiple_pdf/' + JSON.stringify(ids);

        window.open(url, "_blank");

        return;

        // console.log(ids)
        var formName = single ? 'generate_single_pdf' : 'generate_multiple_pdf';
        $ids = ids;
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
                var blob = new Blob([data], {
                    type: "application/octetstream"
                });
                var fileName = 'newPdf.pdf';
                var isIE = false || !!document.documentMode;
                if (isIE) {
                    window.navigator.msSaveBlob(blob, fileName);
                } else {
                    var url = window.URL || window.webkitURL;
                    link = url.createObjectURL(blob);
                    var a = $("<a />");
                    a.attr("download", fileName);
                    a.attr("href", link);
                    $("body").append(a);
                    a[0].click();
                    $("body").remove(a);
                }
            }
        });
    }

    function onClickReplaceData(ids) {
        console.log(ids);
        $('#dataIds').val(ids);
        $('#replacedDataCount').html(ids.length);
        var myModal = new bootstrap.Modal(document.getElementById('replaceDataModal'));
        myModal.show();
    }

    function replaceData() {
        var rows_selected = thisTable.rows('.selected');
        // console.log(rows_selected);
        if ($(rows_selected)[0].length) {
            var ids = [];
            $(rows_selected)[0].forEach(element => {
                var dataId = $('tr#tableRow_' + element);
                // console.log(dataId.attr('dataId'));
                ids.push(dataId.attr('dataId'));
            });
            onClickReplaceData(ids);
        } else {
            $('#dataIds').val('');
            $('#replacedDataCount').html('0');
            swal({
                title: "No data selected",
                icon: "warning",
            })
        }
    }

    $('#replaceDataForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(Array.from(formData));

        $.ajax({
            url: '',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false
        }).done(function(request) {
            console.log(request);
            var response = JSON.parse(request);
            if (response.success) {
                swal({
                    title: "Success",
                    text: "Data Updated Successfully.",
                    icon: "success",
                    // buttons: true,
                    // dangerMode: true,
                }).then((result) => {
                    location.reload();
                })
            } else {
                swal({
                    title: "Success",
                    text: "Partially Data Updated Successfully.",
                    icon: "success",
                    // buttons: true,
                    // dangerMode: true,
                }).then((result) => {
                    location.reload();
                })
            }
        }).fail(function(error) {
            console.log(error)
            swal({
                title: "Error",
                text: "Some error happening in updating data, please contact administration.",
                icon: "error",
                // buttons: true,
                // dangerMode: true,
            })
        })
    })
</script>
<?= $this->endSection() ?>