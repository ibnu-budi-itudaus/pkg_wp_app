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
                        <a href="<?= base_url('nilai') ?>">Nilai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">Input <?= $position ?></a>
                    </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('unrated')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('unrated'); ?></h4>
                </div>
            <?php } ?>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Input <?= $position ?> - <?= $guru['0']['nama_guru'] ?></h4>
                          
                    </div>
                </div>
                <form method="post" action="<?= base_url('nilai/tambah/') . $guru['0']['id_guru'] ?>">
                    <div class="card-body col-md-8">
                        <input type="text" name="id_period" value="<?= $periode['id_periode'] ?>" hidden>
                        <input type="text" name="krit1" value="1" hidden>
                        <input type="text" name="krit2" value="2" hidden>
                        <input type="text" name="krit3" value="3" hidden>
                          <input type="text" name="krit4" value="4" hidden>
                         <input type="text" name="krit5" value="5" hidden>
                          <input type="text" name="krit6" value="6" hidden>
                       <input type="text" name="krit7" value="7" hidden>
                        <input type="text" name="krit8" value="8" hidden>
                         <input type="text" name="krit9" value="9" hidden>
                          <input type="text" name="krit10" value="10" hidden>
                           <input type="text" name="krit11" value="11" hidden>
                            <input type="text" name="krit12" value="12" hidden>
                             <input type="text" name="krit13" value="13" hidden>
                              <input type="text" name="krit14" value="14" hidden>


                        <div class="form-group">
                            <label for="C1" class="placeholder"><b><?= $kriteria['0']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=0; $i < 4; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C1" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="form-group">
                            <input type="hidden" name="kriteria" value="">
                            <label for="C2" class="placeholder"><b><?= $kriteria['4']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=4; $i < 8; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C2" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="C3" class="placeholder"><b><?= $kriteria['9']['keterangan'] ?></b></label>
                             <div class="position-relative">

                        
                                <?php
                                for ($i=8; $i < 12; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C3" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C4" class="placeholder"><b><?= $kriteria['13']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=12; $i < 16; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C4" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C5" class="placeholder"><b><?= $kriteria['17']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=16; $i < 20; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C5" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C6" class="placeholder"><b><?= $kriteria['21']['keterangan'] ?></b></label>
                             <div class="position-relative">

                        
                                <?php
                                for ($i=20; $i < 24; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C6" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C7" class="placeholder"><b><?= $kriteria['25']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=24; $i < 28; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C7" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C8" class="placeholder"><b><?= $kriteria['29']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=28; $i < 32; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C8" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C9" class="placeholder"><b><?= $kriteria['33']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=32; $i < 36; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C9" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C10" class="placeholder"><b><?= $kriteria['37']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=36; $i < 40; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C10" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C11" class="placeholder"><b><?= $kriteria['41']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=40; $i < 44; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C11" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C12" class="placeholder"><b><?= $kriteria['45']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=44; $i < 48; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C12" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C13" class="placeholder"><b><?= $kriteria['49']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=48; $i < 52; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C13" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="C14" class="placeholder"><b><?= $kriteria['53']['keterangan'] ?></b></label>
                            <div class="position-relative">

                        
                                <?php
                                for ($i=52; $i < 56; $i++){
                                    ?>
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="C14" value="<?= $kriteria[$i]['nilai']?>">
                                        <span class="form-radio-sign"><?= $kriteria[$i]['nilai']?></span>
                                        
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-primary" name="simpan" onclick="return confirm('simpan hasil penilaian?')">Simpan</button>
                        <a href=" <?= base_url('nilai') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>