<?= $this->extend('Dashboard/clientlayout') ?>

<?= $this->section('content') ?>


<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Search Data by Asset ID</h4>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-header bg-primary text-white"><b>Perform Operations</b></div>
        <div class="card-inner">
            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="form-control-wrap">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Enter Asset ID's">
                            <div class="input-group-append">
                                <button class="btn btn-primary"><em class="ni ni-search"></em></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <ul class="list-unstyled">
                        <li> > For Multiple assets search, Seperate Asset ID's with comma</li>
                        <li> > Data list appeared below this section</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- nk-block -->

<?= $this->endSection() ?>