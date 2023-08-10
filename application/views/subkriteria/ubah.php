<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <!-- <h4 class="page-title"><?= $position ?></h4> -->
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
                        <a href="<?= base_url('subkriteria') ?>">Sub Kriteria</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href=""><?= $position ?></a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $position ?></h4>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="card-body col-md-6">
                        <input type="text" name="id_subkriteria" value="<?= $subkriteria['id_subkriteria'] ?>" hidden>
                       
                       <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria" value="<?= $subkriteria['nama_kriteria'] ?>"readonly>
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= $subkriteria['keterangan']?>" disabled>
                                                                                
                        </div>
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input type="text" class="form-control" name="nama_subkriteria" placeholder="Nama Sub Kriteria" value="<?= $subkriteria['nama_subkriteria'] ?>">
                            <?= form_error('nama_subkriteria', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kriteria" class="placeholder"><b>Bobot</b></label>
                            <div class="position-relative">
                                <select class="form-control" id="exampleFormControlSelect1" name="nilai">
                                    <?php
                                    foreach ($nilai as $b) {
                                        if ($subkriteria['nilai'] != $b) {
                                            ?>
                                            <option value="<?= $b ?>"><?= $b ?></option>
                                        <?php
                                            } else {
                                                ?>
                                            <option value="<?= $b ?>" selected><?= $b ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                       
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary" name="ubah" onclick="return confirm('Are you sure want to edit?')">Ubah</button>
                        <a href=" <?= base_url('subkriteria') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>