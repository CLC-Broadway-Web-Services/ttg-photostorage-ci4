<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Performance Report</h4>
            <div class="nk-block-des">
                <p>Performance Report</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col"><span class="sub-text">Staff Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Staff Name</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Total Data</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Objected Data</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Varified Data</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataper as $key => $performance) : ?>
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                    <label class="custom-control-label" for="uid1"></label>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead"><?php if ($performance['type'] == 'staff') {
                                                                    echo $performance['id'];
                                                                }  ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span><?= substr($performance['name'], 0,2) ?></span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead"><?= $performance['name'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span><?= $performance['email'] ?></span>
                                    </div>
                                </div>
                            </td>

                            <td class="nk-tb-col tb-col-md">
                                <span><?= $performance['userCountry'] ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                <span><?= count((array) json_decode($performance['objectionContent'])); ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span><?= count((array) json_decode($performance['objectionContent'])); ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span><?= count((array) json_decode($performance['objectionContent'])); ?></span>
                            </td>

                            <td class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<?= $this->endSection() ?>