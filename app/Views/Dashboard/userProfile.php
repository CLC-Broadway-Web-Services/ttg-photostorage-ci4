<?= $this->extend('Dashboard/' . $layout) ?>

<?= $this->section('content') ?>

<div class="nk-block">
    <div class="card">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg">
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Personal Infomation</h4>
                                    <!-- <div class="nk-block-des">
                                        <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                    </div> -->
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="nk-data data-list">
                                <!-- <div class="data-head">
                                    <h6 class="overline-title">Basics</h6>
                                </div> -->
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Full Name</span>
                                        <span class="data-value"><?= $user['name'] ?></span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                </div>
                                <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Display Name</span>
                                        <span class="data-value">Ishtiyak</span>
                                    </div>
                                </div> -->
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Email</span>
                                        <span class="data-value"><?= $user['email'] ?></span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-lock-alt"></em></span></div> -->
                                </div>
                                <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Phone Number</span>
                                        <span class="data-value text-soft"><?= $user['mobile'] ? $user['mobile'] : 'Not added yet' ?></span>
                                    </div>
                                    <!-- <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div> -->
                                </div>
                                <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Date of Birth</span>
                                        <span class="data-value">29 Feb, 1986</span>
                                    </div>
                                    
                                </div> -->
                                <!-- <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                    <div class="data-col">
                                        <span class="data-label">Address</span>
                                        <span class="data-value">2337 Kildeer Drive,<br>Kentucky, Canada</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div> -->
                            </div>
                            <!-- <div class="nk-data data-list">
                                <div class="data-head">
                                    <h6 class="overline-title">Preferences</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Language</span>
                                        <span class="data-value">English (United State)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change Language</a></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Date Format</span>
                                        <span class="data-value">M d, YYYY</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Timezone</span>
                                        <span class="data-value">Bangladesh (GMT +6)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" data-toggle="modal" data-target="#profile-language" class="link link-primary">Change</a></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div class="tab-pane" id="notification">
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Notification Settings</h4>
                                    <div class="nk-block-des">
                                        <p>You will get only notification what have enabled.</p>
                                    </div>
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-head-content">
                                <h6>Security Alerts</h6>
                                <p>You will get only those email notification what you want.</p>
                            </div>
                        </div>
                        <div class="nk-block-content">
                            <div class="gy-3">
                                <div class="g-item">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="unusual-activity">
                                        <label class="custom-control-label" for="unusual-activity">Email me whenever encounter unusual activity</label>
                                    </div>
                                </div>
                                <div class="g-item">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="new-browser">
                                        <label class="custom-control-label" for="new-browser">Email me if new browser is used to sign in</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-head-content">
                                <h6>News</h6>
                                <p>You will get only those email notification what you want.</p>
                            </div>
                        </div>
                        <div class="nk-block-content">
                            <div class="gy-3">
                                <div class="g-item">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="latest-sale">
                                        <label class="custom-control-label" for="latest-sale">Notify me by email about sales and latest news</label>
                                    </div>
                                </div>
                                <div class="g-item">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="feature-update">
                                        <label class="custom-control-label" for="feature-update">Email me about new features and updates</label>
                                    </div>
                                </div>
                                <div class="g-item">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="account-tips">
                                        <label class="custom-control-label" for="account-tips">Email me about tips on using account</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-pane" id="settings">
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Change Password</h4>
                                    <div class="nk-block-des">
                                        <p>Set a unique password to protect your account.
                                            <?= $lastpass ? '<br><em class="text-soft text-date fs-12px">Last changed: <span>' . date('M d, Y @ g:s:A', strtotime($lastpass['created_at'])) . '</span></em>' : ''; ?>
                                        </p>
                                    </div>
                                    <!-- <div class="nk-block-des">
                                        <p>These settings are helps you keep your account secure.</p>
                                    </div> -->
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block">
                            <div class="card">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <form class="row gy-2" id="changePasswordForm">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="old_password">OLD Password</label>
                                                    <input type="password" class="form-control form-control-lg" id="old_password" name="old_password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="new_password">New Password</label>
                                                    <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="confirmpassword">Confirm New Password</label>
                                                    <input type="password" class="form-control form-control-lg" id="confirmpassword" name="confirmpassword" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                    <li>
                                                        <button type="submit" class="btn btn-lg btn-primary">Update Password</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- <div class="card-inner">
                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                            <div class="nk-block-text">
                                                <h6>Save my Activity Logs</h6>
                                                <p>You can save your all activity logs including unusual activity detected.</p>
                                            </div>
                                            <div class="nk-block-actions">
                                                <ul class="align-center gx-3">
                                                    <li class="order-md-last">
                                                        <div class="custom-control custom-switch mr-n2">
                                                            <input type="checkbox" class="custom-control-input" checked="" id="activity-log">
                                                            <label class="custom-control-label" for="activity-log"></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="card-inner">
                                        <div class="between-center flex-wrap g-3">
                                            <div class="nk-block-text">
                                                <h6>Change Password</h6>
                                                <p>Set a unique password to protect your account.</p>
                                            </div>
                                            <div class="nk-block-actions flex-shrink-sm-0">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                    <li class="order-md-last">
                                                        <a href="#" class="btn btn-primary">Change Password</a>
                                                    </li>
                                                    <li>
                                                        <em class="text-soft text-date fs-12px">Last changed: <span>Oct 2, 2019</span></em>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="card-inner">
                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                            <div class="nk-block-text">
                                                <h6>2 Factor Auth &nbsp; <span class="badge badge-success ml-0">Enabled</span></h6>
                                                <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                            </div>
                                            <div class="nk-block-actions">
                                                <a href="#" class="btn btn-primary">Disable</a>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="activity">
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Activity logs</h4>
                                    <div class="nk-block-des">
                                        <p>Here is your all activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
                                    </div>
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block">
                            <table class="table table-ulogs" id="userActivityLogs">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="tb-col-os"><span class="overline-title">Event on Asset<span class="d-sm-none">/ IP</span></span></th>
                                        <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                        <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                        <th class="tb-col-action"><span class="overline-title">Device</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tb-col-os">Mozilla on Window</td>
                                        <td class="tb-col-ip"><span class="sub-text">86.188.154.225</span></td>
                                        <td class="tb-col-time"><span class="sub-text">Nov 20, 2019 <span class="d-none d-sm-inline-block">10:34 PM</span></span></td>

                                        <td class="tb-col-action"><span class="sub-text">Device</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                <div class="card-inner-group" data-simplebar>
                    <div class="card-inner">
                        <div class="user-card">
                            <div class="user-avatar bg-primary">
                                <?php if (!empty($user['profile_pic']) && $user['profile_pic']) { ?>
                                    <img src="<?= $user['profile_pic'] ?>">
                                <?php } else { ?>
                                    <span><?= strtoupper(substr(session()->get('user.name'), 0, 2)); ?></span>
                                <?php } ?>
                            </div>
                            <form class="user-info" id="userImageForm" enctype="multipart/form-data">
                                <span class="lead-text"><?= $user['name'] ?></span>
                                <span class="sub-text"><button class="btn btn-link btn-sm" onclick="$('#userImageInput').click()">Change image</button></span>
                                <input class="d-none" id="userImageInput" accept="image/*" type="file" name="user_avatar" onchange="uploadImage(this)" required>
                            </form>
                            <!-- <div class="user-action">
                                <div class="dropdown">
                                    <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="user-account-info py-0">
                            <h6 class="overline-title-alt">Last Activity <small><small><b>ON DATA</b></small></small></h6>
                            <p>
                                <?= $activity ? date("d M Y, g:s A", $activity['time']) . '</br>' . $activity['ipaddress'] : 'No Activity Performed' ?>
                            </p>

                        </div>
                    </div>
                    <div class="card-inner p-0">
                        <ul class="link-list-menu nav nav-tabs">
                            <li><a data-toggle="tab" href="#personal" class="active" href="#"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                            <!-- <li><a data-toggle="tab" href="#settings" href="#"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li> -->
                            <li><a data-toggle="tab" href="#settings" href="#"><em class="icon ni ni-lock-alt-fill"></em><span>Change Password</span></a></li>
                            <li><a data-toggle="tab" href="#activity" href="#"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Update Profile</h5>
                <!-- <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#address">Address</a>
                    </li>
                </ul> -->
                <form class="tab-content" id="profileForm">
                    <div class="tab-pane active" id="personal">
                        <div class="row gy-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full_name">Full Name</label>
                                    <input type="text" class="form-control form-control-lg" id="full_name" name="full_name" required value="<?= $user['name'] ?>" placeholder="Enter Full name">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="display-name">Display Name</label>
                                    <input type="text" class="form-control form-control-lg" id="display-name" value="Ishtiyak" placeholder="Enter display name">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="user_mobile">Phone Number</label>
                                    <input type="tel" class="form-control form-control-lg" id="user_mobile" name="user_mobile" required value="<?= $user['mobile'] ?>" placeholder="eg: +12345678900">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="birth-day">Date of Birth</label>
                                    <input type="text" class="form-control form-control-lg date-picker" id="birth-day" placeholder="Enter your name">
                                </div>
                            </div> -->
                            <!-- <div class="col-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="latest-sale">
                                    <label class="custom-control-label" for="latest-sale">Use full name to display </label>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane" id="address">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l1">Address Line 1</label>
                                    <input type="text" class="form-control form-control-lg" id="address-l1" value="2337 Kildeer Drive">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l2">Address Line 2</label>
                                    <input type="text" class="form-control form-control-lg" id="address-l2" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-st">State</label>
                                    <input type="text" class="form-control form-control-lg" id="address-st" value="Kentucky">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-county">Country</label>
                                    <select class="form-select" id="address-county" data-ui="lg">
                                        <option>Canada</option>
                                        <option>United State</option>
                                        <option>United Kindom</option>
                                        <option>Australia</option>
                                        <option>India</option>
                                        <option>Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <a href="#" class="btn btn-lg btn-primary">Update Address</a>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    var thisTable = NioApp.DataTable('#userActivityLogs', {
        // fixedHeader: true,
        bFilter: true,
        lengthMenu: [
            [10, 15, 30, 50, 100, 200, 500, 1000],
            [10, 15, 30, 50, 100, 200, 500, 1000]
        ],
        buttons: [{
                extend: 'excel',
                titleAttr: 'Download Excel',
                // exportOptions: {
                //     columns: [1, 2, 3, 4],
                //     orthogonal: 'export'
                // },
            },
            {
                extend: 'print',
                titleAttr: 'Print Data',
                // exportOptions: {
                //     columns: [1, 2, 3, 4, 5, 6, 7],
                //     orthogonal: 'export'
                // },
            }
        ],
        order: [
            [3, 'desc']
        ],
        ordering: false,
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
            className: "tb-col-os"
        }, {
            data: "ipaddress",
            className: "tb-col-ip"
        }, {
            data: "time",
            className: "tb-col-time"
        }, {
            data: "device",
            className: "tb-col-action"
        }, ]
    });
    $.fn.DataTable.ext.pager.numbers_length = 7;
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "This has to be different...");
    var changePasswordForm = $("#changePasswordForm");
    changePasswordForm.validate({
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        rules: {
            old_password: {
                required: true,
                // oldPasswordCheck: true,
                remote: {
                    url: '',
                    type: "post"
                }
            },
            new_password: {
                required: true,
                minlength: 5,
                notEqual: '#old_password'
            },
            confirmpassword: {
                required: true,
                minlength: 5,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: "Please provide a password",
                remote: "Your password is not valid."
                // oldPasswordCheck: "Your password is not valid."
            },
            new_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                notEqual: "New password not same as your old password."
            },
            confirmpassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Not matched with your new password."
            },
        }
    });
    changePasswordForm.submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        if (changePasswordForm.valid()) {
            console.log(Array.from(formData));
            $.ajax({
                type: "POST",
                url: '',
                data: formData,
                contentType: false,
                processData: false
            }).done(function(response) {
                var returnData = JSON.parse(response);
                // if (returnData.success) {
                //     Swal.fire(
                //         'Success!',
                //         returnData.message,
                //         'success'
                //     )
                // } else {
                //     Swal.fire(
                //         'Error!',
                //         returnData.message,
                //         'error'
                //     )
                // }
                Swal.fire(
                    returnData.success ? 'Success!' : 'Error!',
                    returnData.message,
                    returnData.success ? 'success' : 'error'
                )
                return false;
            }).fail(function(xhr, textStatus, errorThrown) {
                // alert('Error changing password...');
                Swal.fire(
                    'Error!',
                    'Error changing password...',
                    'error'
                )
                return false;
            })
        } else {
            console.log('invalid form');
            Swal.fire(
                'Error!',
                'invalid form ...',
                'error'
            )
        }
    });
    var profileForm = $('#profileForm');
    profileForm.validate({
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        rules: {
            full_name: {
                required: true
            },
            user_mobile: {
                required: true
            },
        },
        messages: {
            full_name: {
                required: "Please provide a full name"
            },
            user_mobile: {
                required: "Please provide a mobile number"
            },
        },
    });
    profileForm.submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        if (profileForm.valid()) {
            console.log(Array.from(formData));
            $.ajax({
                type: "POST",
                url: '',
                data: formData,
                contentType: false,
                processData: false
            }).done(function(response) {
                console.log(response);
                const returnData = JSON.parse(response);
                Swal.fire(
                    returnData.success ? 'Success!' : 'Error!',
                    returnData.message,
                    returnData.success ? 'success' : 'error'
                ).then((result) => {
                    returnData.success ? location.reload() : NULL;
                })
                return false;
            }).fail(function(xhr, textStatus, errorThrown) {
                Swal.fire(
                    'Error!',
                    'Error updating details...',
                    'error'
                )
                return false;
            })
        } else {
            Swal.fire(
                'Error!',
                'invalid form ...',
                'error'
            )
        }
    });

    var userImageForm = $('#userImageForm');

    function uploadImage(event) {
        // console.log(event.files[0]);
        if (event.files[0]) {
            userImageForm.submit();
        }
    }
    userImageForm.submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(Array.from(formData));
        // return;
        $.ajax({
            type: "POST",
            url: '',
            data: formData,
            contentType: false,
            processData: false
        }).done(function(response) {
            console.log(response);
            const returnData = JSON.parse(response);
            Swal.fire(
                returnData.success ? 'Success!' : 'Error!',
                returnData.message,
                returnData.success ? 'success' : 'error'
            ).then((result) => {
                returnData.success ? location.reload() : NULL;
            })
            return false;
        }).fail(function(xhr, textStatus, errorThrown) {
            Swal.fire(
                'Error!',
                'Error uploading profile picture ...',
                'error'
            )
            return false;
        })
    })
</script>
<?= $this->endSection() ?>