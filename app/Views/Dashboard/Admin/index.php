<?= $this->extend('Dashboard/layout') ?>


<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Dashboard</h3>
                    </div><!-- .nk-block-head-content -->
                    <!-- <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>Last 30 Days</span></a></li>
                                                    <li><a href="#"><span>Last 6 Months</span></a></li>
                                                    <li><a href="#"><span>Last 1 Years</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <!-- total shipments -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Shipments</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount"><?= $shipments['total'] ?></div>
                                            <div class="nk-ecwg6-ck">
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change <?= $shipments['percentage'] >= 100 ? 'up' : 'down' ?> text-danger">
                                                <em class="icon ni ni-arrow-long-<?= $shipments['percentage'] >= 100 ? 'up' : 'down' ?>"></em>
                                                <?= round($shipments['percentage'], 2) ?> %
                                            </span>
                                            <span> vs. last month</span>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div>
                    <!-- total crn -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total CRN's</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount"><?= $crns['total'] ?></div>
                                            <div class="nk-ecwg6-ck">
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change <?= $crns['percentage'] >= 100 ? 'up' : 'down' ?> text-danger">
                                                <em class="icon ni ni-arrow-long-<?= $crns['percentage'] >= 100 ? 'up' : 'down' ?>"></em>
                                                <?= round($crns['percentage'], 2) ?> %
                                            </span>
                                            <span> vs. last month</span>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div>
                    <!-- total assets -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Assets</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount"><?= $assets['total'] ?></div>
                                            <div class="nk-ecwg6-ck">
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change <?= $assets['percentage'] >= 100 ? 'up' : 'down' ?> text-danger">
                                                <em class="icon ni ni-arrow-long-<?= $assets['percentage'] >= 100 ? 'up' : 'down' ?>"></em>
                                                <?= round($assets['percentage'], 2) ?> %
                                            </span>
                                            <span> vs. last month</span>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div>
                    <!-- total clients -->
                    <div class="col-xxl-3 col-sm-3">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Clients</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount"><?= $clients['total'] ?></div>
                                            <div class="nk-ecwg6-ck">
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change <?= $clients['percentage'] >= 100 ? 'up' : 'down' ?> text-danger">
                                                <em class="icon ni ni-arrow-long-<?= $clients['percentage'] >= 100 ? 'up' : 'down' ?>"></em>
                                                <?= round($clients['percentage'], 2) ?> %
                                            </span>
                                            <span> vs. last month</span>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div>
                    <!-- MAP -->
                    <div class="col-md-12 col-xxl-3">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title card-title-sm">
                                        <h6 class="title">Users by Country</h6>
                                    </div>
                                    <div class="card-tools">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">30 Days</a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="analytics-map row">
                                    <!-- <table class="analytics-map-data-list col-md-4 col-12">
                                        <tr class="analytics-map-data">
                                            <td class="country">United States</td>
                                            <td class="amount">12,094</td>
                                            <td class="percent">23.54%</td>
                                        </tr>
                                        <tr class="analytics-map-data">
                                            <td class="country">India</td>
                                            <td class="amount">7,984</td>
                                            <td class="percent">7.16%</td>
                                        </tr>
                                        <tr class="analytics-map-data">
                                            <td class="country">Turkey</td>
                                            <td class="amount">6,338</td>
                                            <td class="percent">6.54%</td>
                                        </tr>
                                        <tr class="analytics-map-data">
                                            <td class="country">Bangladesh</td>
                                            <td class="amount">4,749</td>
                                            <td class="percent">5.29%</td>
                                        </tr>
                                    </table> -->
                                    <div class="vector-map col-12" id="worldMap"></div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div>
                    <!-- CRN Statistics -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-title-group align-start gx-3 mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Sales Overview</h6>
                                    </div>
                                    <div class="card-tools">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="dropdown"><em class="icon ni ni-download-cloud"></em><span><span class="d-none d-md-inline">Download</span> Report</span></a>
                                            <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="dropdown"><em class="icon ni ni-download-cloud"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>Download Mini Version</span></a></li>
                                                    <li><a href="#"><span>Download Full Version</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><em class="icon ni ni-opt-alt"></em><span>More Options</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                    <div class="nk-sale-data">
                                    </div>
                                    <div class="nk-sale-data">
                                    </div>
                                </div>
                                <div class="nk-sales-ck large pt-4">
                                    <canvas class="sales-overview-chart" id="salesOverview"></canvas>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div>
                    <!-- orderStatistics -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-full overflow-hidden">
                            <div class="nk-ecwg nk-ecwg7 h-100">
                                <div class="card-inner flex-grow-1">
                                    <div class="card-title-group mb-4">
                                        <div class="card-title">
                                            <h6 class="title">Order Statistics</h6>
                                        </div>
                                        <div class="card-tools">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary btn-dim d-none d-sm-inline-flex" data-toggle="dropdown"><em class="icon ni ni-download-cloud"></em><span><span class="d-none d-md-inline">Download</span> Report</span></a>
                                                <a href="#" class="btn btn-icon btn-primary btn-dim d-sm-none" data-toggle="dropdown"><em class="icon ni ni-download-cloud"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Download Mini Version</span></a></li>
                                                        <li><a href="#"><span>Download Full Version</span></a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><em class="icon ni ni-opt-alt"></em><span>More Options</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-ecwg7-ck">
                                        <canvas class="ecommerce-doughnut-s1" id="orderStatistics"></canvas>
                                    </div>
                                    <ul class="nk-ecwg7-legends">
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#816bff"></span>
                                                <span>Completed</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#13c9f2"></span>
                                                <span>Processing</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#ff82b7"></span>
                                                <span>Canclled</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- .card-inner -->
                            </div>
                        </div><!-- .card -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/public/js/charts/chart-analytics.js"></script>
<script src="/public/js/libs/jqvmap.js"></script>
<script src="/public/js/charts/crn-chart.js"></script>
<script src="/public/js/charts/asset-chart.js"></script>
<script src="/public/js/charts/shipment-chart.js"></script>
<script src="/public/js/charts/package-quality-chart.js"></script>
<!-- <script src="/public/js/charts/chart-sales.js"></script> -->
<?= $this->endSection() ?>