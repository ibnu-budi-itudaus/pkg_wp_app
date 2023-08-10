<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <!-- <h4 class="page-title">Data <?= $position ?></h4> -->
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="<?= base_url('admin') ?>">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href=""><?= $position ?></a>
                    </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('flash')) { ?>
            <div class="alert alert-success alert-dismissable" id="close_alert">
                <h4><?= $this->session->flashdata('flash'); ?></h4>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?></h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h2>Pilih Periode</h2>
            <div class="row">
                <?php
                foreach ($periods as $p) {
                    ?>
                <div class="col-md-2">
                    <div class="card card-info card-round">
                        <div class="card-body text-center">
                            <h4><?= $p['waktu'] ?></h4>
                            <div class="card-detail">
                                <a href="<?= base_url('laporan/periodx/') . $p['id_periode'] ?>" class="btn btn-light btn-rounded">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            </div>
            
        </div>
    </div>
</div>

