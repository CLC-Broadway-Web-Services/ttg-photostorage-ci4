<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/public/images/jsTree/TTG-Photo-Storage-Favicon.png">
    <!-- Page Title  -->
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="/public/css/dashlite.css">
    <link id="skin-default" rel="stylesheet" href="/public/css/theme.css">

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
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
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
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item <?= !$uri->getSegment(1) ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('admin_index') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-shipment' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_shipment') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-truck"></em></span>
                                        <span class="nk-menu-text">Manage Shipments</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-data' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_data') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-db-fill"></em></span>
                                        <span class="nk-menu-text">Manage Data</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'defect-analysis' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('defect_analysis') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file-check-fill"></em></span>
                                        <span class="nk-menu-text">Defect Analysis</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-client' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_client') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">Manage Clients</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'testing-staff' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('testing_staff') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Testing Staff</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'shipping-staff' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('shipping_satff') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Shipping Staff</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'manage-admin' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('manage_admin') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-account-setting-fill"></em></span>
                                        <span class="nk-menu-text"> Manage Admins</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'create-user' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('creat_user') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user-add-fill"></em></span>
                                        <span class="nk-menu-text">Create User</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'activity-log' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('activity_logs') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                                        <span class="nk-menu-text">Activity Logs</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item <?= $uri->getSegment(1) == 'performance-report' ? 'active current-page' : '' ?>">
                                    <a href="<?= route_to('performance_report') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                        <span class="nk-menu-text">Performance Report</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
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
                                            <div class="icon-status icon-status-na">
                                                <em class="icon ni ni-repeat"></em>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown chats-dropdown hide-mb-xs">
                                        <a href="<?= route_to('app_chats') ?>" class="dropdown-toggle nk-quick-nav-icon" data-toggle="">
                                            <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                                        </a>
                                    </li>
                                    <li class="dropdown notification-dropdown">
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
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="<?= route_to('notifications') ?>">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">


                                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-xl-block">
                                                    <div class="user-status user-status-unverified"><?php  ?></div>
                                                    <div class="user-name dropdown-indicator"><?= session()->get('user.name');  ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span><?= strtoupper(substr(session()->get('user.name'), 0, 2)); ?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text"><?= session()->get('user.name');  ?></span>
                                                        <span class="sub-text"><?= session()->get('user.email');  ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <!-- <li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> -->
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
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; <?= date('Y') ?>
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/js/bundle.js"></script>
    <script src="/public/js/scripts.js"></script>
    <!-- <script src="/public/js/charts/chart-analytics.js"></script> -->
    <!-- <script src="/public/js/libs/jqvmap.js"></script> -->
    <!-- <script src="/public/js/charts/chart-ecommerce.js"></script> -->
    <!-- <script src="/public/js/charts/chart-sales.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script> -->
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="/public/js/libs/datatable-btns.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
            alert("Link Copied!");
        }
    </script>

    <?= $this->renderSection('javascript') ?>
</body>

</html>