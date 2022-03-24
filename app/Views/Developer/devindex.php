<?= $this->extend('Dashboard/layout') ?>


<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <?php if ($page == 'devindex') : ?>
                            <h3 class="nk-block-title page-title">Developer Dashboard</h3>
                        <?php endif; ?>
                    </div>
                    <div class="nk-block-head-content">
                        <?php if ($page != 'devindex') : ?>
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Last</span></a></li>
                                                        <li><a href="#"><span>Last</span></a></li>
                                                        <li><a href="#"><span>Last</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="<?= route_to('developer_index') ?>" class="btn btn-primary"><em class="icon ni ni-back-ios"></em><span>Back</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-gs">
                            <div class="col-12">
                                <button class="btn btn-primary" onclick="migratePostTable()">Start migrate old Post table to Defect analysis</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-gs">
                            <div class="col-12">
                                <button class="btn btn-primary" onclick="cleanPostTableValues()">Start cleaning post table for empty data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function migratePostTable() {
        $.ajax({
            type: 'POST',
            url: "",
            data: {
                typeOfRequest: 'migrateDefectAnalysis'
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
    function cleanPostTableValues() {
        $.ajax({
            type: 'POST',
            url: "",
            data: {
                typeOfRequest: 'cleanPostTableValues'
            },
            success: function(data) {
                console.log(data);
            }
        });
    }

</script>
<?= $this->endSection() ?>