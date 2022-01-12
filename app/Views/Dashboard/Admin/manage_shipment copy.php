<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <!-- <div class="nk-block-head-content">
            <h4 class="nk-block-title">Manage Shipment</h4>
            <div class="nk-block-des">
                <p>Perform Operations</p>
            </div>
        </div> -->
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="form-label">Search Shipment by Date Range</label>
                        <div class="form-control-wrap">
                            <div class="input-daterange date-picker-range input-group">
                                <form action="" method="post">
                                <input type="text" class="form-control">
                                <div class="input-group-addon">TO</div>
                                <input type="text" class="form-control">
                                <a href="#" class="btn btn-dim btn-primary ml-2">Filter Data</a>
                                <a href="#" class="btn  btn-primary ml-2"><em class="icon ni ni-download"></em><span>Download All Data</span> </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Staff Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">CRN</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Date & Time</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Logistic Company</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Packaging Quality</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipments as $key => $shipment) : ?>
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                    <label class="custom-control-label" for="uid1"></label>
                                </div>
                            </td>

                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <!-- <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                    <span>AB</span> 
                                </div> -->
                                    <div class="user-info">
                                        <span class="tb-lead">
                                            <?= $shipment['userid'] ?><br>
                                        </span>
                                        <!-- <span>info@softnio.com</span> -->
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-mb">
                                <span class="tb-amount"><?= $shipment['crn'] ?> <span class="currency">USD</span></span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span><?= date("d M Y, g:s A", $shipment['time']); ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span><?= $shipment['logistic_company']; ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span><?= $shipment['userCountry']; ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <?php if ($shipment['box_condition'] == 'Poor') { ?>
                                    <span class="badge badge-dot badge-dot-xs badge-danger"><?= $shipment['box_condition'] ?></span>
                                <?php } elseif ($shipment['box_condition'] == 'Fair') { ?>
                                    <span class="badge badge-dot badge-dot-xs badge-warning"><?= $shipment['box_condition'] ?></span>
                                <?php } elseif ($shipment['box_condition'] == 'Good') { ?>
                                    <span class="badge badge-dot badge-dot-xs badge-success"><?= $shipment['box_condition'] ?></span>
                                <?php } elseif ($shipment['box_condition'] == 'Rejected') { ?>
                                    <span class="badge badge-dot badge-dot-xs" style="color:crimson;"><?= $shipment['box_condition'] ?></span>
                                <?php } ?>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">

                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<?= $this->endSection() ?>