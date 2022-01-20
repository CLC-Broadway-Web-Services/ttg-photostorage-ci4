<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <?= view('globals/headermeta') ?>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
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
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="<?= route_to('client_index') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="<?= route_to('client_crn_search') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file-text-fill"></em></span>
                                        <span class="nk-menu-text">Search By CRN</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="<?= route_to('client_asset_search') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file-text-fill"></em></span>
                                        <span class="nk-menu-text">Search By Asset ID</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= route_to('client_manage_users') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">Manage User</span>
                                    </a>
                                </li>
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
                                       

                                    </li>
                                    <li class="dropdown notification-dropdown">
                                       
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
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
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
    <?= view('globals/scripts') ?>

    <?= $this->renderSection('javascript') ?>
</body>

</html>