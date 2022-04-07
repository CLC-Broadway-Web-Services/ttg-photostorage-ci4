<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Performance Report</h4>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="nk-tb-list nk-tb-ulist" id="performance_report">
                <thead>
                    <tr class=" nk-tb-item nk-tb-head">
                        <!-- <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="uid">
                                <label class="custom-control-label" for="uid"></label>
                            </div>
                        </th> -->
                        <th class="nk-tb-col"><span class="sub-text">Staff Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Total</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Objected</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Verified</span></th>
                        <!-- <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th> -->
                        <th class="nk-tb-col"><span class="sub-text">Date-time</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataper as $key => $performance) : ?>
                        <tr class="nk-tb-item">
                            <!-- <td class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                    <label class="custom-control-label" for="uid1"></label>
                                </div>
                            </td> -->
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
                                        <span><?= substr($performance['name'], 0, 2) ?></span>
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

                            <!-- <td class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </td> -->
                            <td class="nk-tb-col">
                                <span><?= date('d M, Y g:s A', strtotime($performance['datetimes'])) ?></span>
                            </td>
                            <td class="nk-tb-col text-end">
                                <a href="javascript:void(0);" class="text-danger fs-5"><em class="icon ni ni-trash"></em></a>
                            </td>
                        </tr><!-- .nk-tb-item  -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script>
    NioApp.DataTable('#performance_report', {
        bFilter: true,
        responsive: {
            details: false
        },
        order: [
            [7, 'desc']
        ],
    });
</script>
<?= $this->endSection() ?>