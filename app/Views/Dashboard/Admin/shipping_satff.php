<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Manage Shipping Staff</h4>
            <div class="nk-block-des">
                <p>Shipping Staff List</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="input-daterange date-picker-range input-group justify-content-md-end">
                                <a href="#" type="button" class="btn btn-primary float-right ml-2" data-toggle="modal" data-target="#modalDefault"><em class="icon ni ni-plus"></em><span>Add New Shipping Staff</span> </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <th class="nk-tb-col"><span class="sub-text">Shipping Staff ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Staff Name</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Mobile No.</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Password</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right">Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipping_staff as $key => $shipping) : ?>
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
                                        <span class="tb-lead"><?= $shipping['id'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                    </div>
                                </div>
                            </td>
                           
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                        <span><?= substr($shipping['name'], 0,2) ?></span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead"><?= $shipping['name'] ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                        <span><?= $shipping['email'] ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                <ul class="list-status">
                                    <li><span><?= $shipping['mobile'] ?></span></li>
                                </ul>
                            </td>
                            <td class="nk-tb-col tb-col-lg">
                                <span><?= $shipping['pass'] ?></span>
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                <span><?= $shipping['country'] ?></span>
                            </td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
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
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Add Shipping Staff</h5>
            </div>
            <div class="modal-body">
                <form action="#" class="form-validate is-alter" novalidate="novalidate">
                    <div class="form-group">
                        <label class="form-label" for="default-03">Name</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-user"></em>
                            </div>
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-03">Email address</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-mail"></em>
                            </div>
                            <input type="text" class="form-control" i placeholder="Email address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-03">Phone</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-mobile"></em>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-03">Country</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-globe"></em>
                            </div>
                            <input type="text" class="form-control" placeholder="Country">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default-03">Password</label>
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-eye"></em>
                            </div>
                            <input type="text" class="form-control" value="xd7OBSGh7" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Add Staff</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">TTG Photostorage</span>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>