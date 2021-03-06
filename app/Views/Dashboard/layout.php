<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <?= view('globals/headermeta') ?>
    <?= $this->renderSection('css') ?>
    <style>
        .dataTables_processing {
            /* background-color: #ff0000; */
            background-color: red !important;
        }

        .processingData {
            /* background-color: red; */
            color: #fff;
            font-weight: 700;
        }
    </style>

</head>
<?php
$uri = service('uri');
$uri = current_url(true);
?>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">

        <div class="nk-main ">

            <div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="/public/images/jsTree/TTG-Photo-Storage-Logos.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Logos.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="/public/images/jsTree/TTG-Photo-Storage-Logos.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Logos.png 2x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="/public/images/jsTree/TTG-Photo-Storage-Favicon.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Favicon.png 2x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div>
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item <?= !$uri->getSegment(1) ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('admin_index') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-shipment' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_shipment') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-truck"></em></span>
                                        <span class="nk-menu-text">Manage Shipments</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-data' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_data') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-db-fill"></em></span>
                                        <span class="nk-menu-text">Manage Data</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'defect-analysis' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('defect_analysis') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file-check-fill"></em></span>
                                        <span class="nk-menu-text">Defect Analysis</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-client' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_client') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">Manage Clients</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'testing-staff' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('testing_staff') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Testing Staff</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'shipping-staff' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('shipping_staff') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Shipping Staff</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-admin' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_admin') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-account-setting-fill"></em></span>
                                        <span class="nk-menu-text"> Manage Admins</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'creat-user' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('creat_user') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Create User</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'activity-log' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('activity_logs') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                                        <span class="nk-menu-text">Activity Logs</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'performance-report' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('performance_report') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                        <span class="nk-menu-text">Performance Report</span>
                                    </a>
                                </li>
                                <?php if (session()->get('user.crn_status') == 'developer') : ?>
                                    <li class="nk-menu-item <?= $uri->getSegment(1) == 'developer-mode' ? 'active current-page' : '' ?>">
                                        <a href="<?= route_to('developer_index') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cmd"></em></span>
                                            <span class="nk-menu-text">Developer</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="/public/images/jsTree/TTG-Photo-Storage-Logos.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Logos.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="/public/images/jsTree/TTG-Photo-Storage-Logos.png" srcset="/public/images/jsTree/TTG-Photo-Storage-Logos.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown chats-dropdown hide-mb-xs">
                                        <a class="dropdown-toggle nk-quick-nav-icon">
                                            <div class="icon-status icon-status-na" onclick="window.location.reload()">
                                                <em class="icon ni ni-repeat"></em>
                                            </div>
                                        </a>
                                    </li>
                                    <?php if (session()->get('loginType') == 'admin') : ?>
                                        <li class="">
                                            <em class="icon ni ni-globe"></em> <?= session()->get('user.country');  ?>
                                        </li>
                                    <?php endif; ?>
                                    <!-- <li class="dropdown chats-dropdown hide-mb-xs">
                                        <a href="<?= route_to('app_chats') ?>" class="dropdown-toggle nk-quick-nav-icon" data-toggle="">
                                            <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                                        </a>
                                    </li> -->
                                    <!-- <li class="dropdown notification-dropdown">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-foot center">
                                                <a href="<?= route_to('notifications') ?>">View All</a>
                                            </div>
                                        </div>
                                    </li> -->
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <?php if (!empty(session()->get('user.profile_pic')) && session()->get('user.profile_pic')) { ?>
                                                        <img src="<?= session()->get('user.profile_pic') ?>">
                                                    <?php } else { ?>
                                                        <em class="icon ni ni-user-alt"></em>

                                                    <?php } ?>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-status user-status-verified"><?= ucfirst(session()->get('user.type')) ?></div>
                                                    <div class="user-name dropdown-indicator"><?= session()->get('user.name');  ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <?php if (!empty(session()->get('user.profile_pic')) && session()->get('user.profile_pic')) { ?>
                                                            <img src="<?= session()->get('user.profile_pic') ?>">
                                                        <?php } else { ?>
                                                            <span><?= strtoupper(substr(session()->get('user.name'), 0, 2)); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?= session()->get('user.name');  ?></span>
                                                        <span class="sub-text"><?= session()->get('user.email');  ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= route_to('admin_profile') ?>"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <!-- <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li> -->
                                                    <!-- <li><a href="#"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> -->
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= route_to('logout') ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="nk-content">
                    <?= $this->renderSection('content') ?>
                </div>


                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; <?= date('Y') ?>
                            </div>
                            <!-- <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?= view('globals/scripts') ?>
    <script>
        function copyText(textValue) {
            console.log(textValue);
            /* Copy the text inside the text field */
            navigator.clipboard.writeText(textValue);

            /* Alert the copied text */
            alert("Copied the text: " + textValue);
        }

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).attr('data-copy')).select();
            document.execCommand("copy");
            $temp.remove();
            // alert("Link Copied!");
            swal({
                text: "Link copied successfully."
            })
        }

        function locationReload() {
            window.location.reload();
        }

        function showNoFilesError() {
            swal({
                title: "Reporting",
                text: "This data doesn't have any files. unable to open or copy link.",
                icon: "warning",
                // buttons: true,
                // dangerMode: true,
            })
        }
    </script>

    <?= $this->renderSection('javascript') ?>

</body>

</html>