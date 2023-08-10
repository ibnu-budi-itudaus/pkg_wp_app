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
                        <a href="<?= base_url('nilai') ?>">Nilai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="">Detail <?= $position ?></a>
                    </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('done')) { ?>
                <div class="alert alert-success alert-dismissable" id="close_alert">
                    <h4><?= $this->session->flashdata('done'); ?></h4>
                </div>
            <?php } else if ($this->session->flashdata('kosong')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('kosong'); ?> <a href="<?= base_url('nilai') ?>">disini</a></h4>
                </div>
            <?php } else if ($this->session->flashdata('belum')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <h4><?= $this->session->flashdata('belum'); ?></h4>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">
                           
                            <?php if(isset($guru)): ?>
                            Detail <?= $position ?> <?= $guru['nama_guru'] ?>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <h2>Nilai Guru</h2>

                        <table class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($kriteria as $k) {
                                        ?>
                                        <th><?= $k['nama_kriteria'] ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <tr>
                                    <?php
                                    foreach ($nilai_guru as $n) {
                                        ?>
                                        <td><?= $n['nilai_guru'] ?></td>
                                    <?php }  ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($this->session->flashdata('belum')) { ?>
                    <?php } else { ?>
                        <h2>Hasil Kinerja <?= $guru['nama_guru'] ?> adalah <?= $jml_nilai['skala'] ?></h2>
                    <?php } ?>

                     <?php if ($this->session->flashdata('belum')) { ?>

                        <div class="card-body">
                            <h5 class="card-title"><b>Anda belum melakukan penilaian kinerja guru pada <?php echo $unratedguru['nama_guru'] ?>!</b></h5>
                            <p class="card-text">Ciick tombol dibawah ini untuk melakukan penilaian terlebih dahulu..</p>
                            <a href="<?= base_url('nilai/penilaian/').$unratedguru['id_guru'] ?>" class="btn btn-primary"><i class="fas fa-calculator"></i> Nilai</a>
                          </div>
                    <?php } else { ?>
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Detail Perhitungan
                        </a>
                    </p>
                    <?php } ?>
                    <div class="collapse" id="collapseExample">
                        <div class="table-responsive">
                            <h2>Hasil Penilaian Kinerja Guru (PKG) - <?php echo $guru['nama_guru'] ?></h2>
                            <table id="add" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 6%">No</th>
                                        <th style="width: 50%">Kompetensi</th>
                                    
                                        <th>Nilai</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>

                                  
                                    <?php
                                    $total=0;
                                    $x=0;
                                    $no = 1;
                                    $index = 0;
                                      foreach ($kriteria as $k) {
                                        ?>
                                      
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $k['keterangan'] ?></td>
                                            <td><?= $nilai_guru[$x]['nilai_guru'] ?>
                                               
                                            </td>
                                               <?php $total = $total + $nilai_guru[$x]['nilai_guru'] ?>
                                        </tr>

                                    <?php
                                    $x++;
                                        $no = $no + 1;
                                    }
                                    ?>
                                    <td></td>
                                    <th>Jumlah (Hasil Penilaian Kinerja Guru)</th>
                                    <th><?= $total;  ?></th>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="table-responsive col-sm-8">
                           
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="5">Nilai PK GURU Kelas/Mata Pelajaran</th>
                                        <th><?php echo $total; ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $x=0;
                                        $rate="";
                                        $x=(($total/56)*100);
                                        if($x>=91)
                                            {
                                                $rate="Amat Baik";
                                            }
                                        elseif($x>=76)
                                            {
                                                 $rate="Baik";
                                            }
                                        elseif($x>=61)
                                            {
                                                 $rate="Cukup";
                                            }
                                        elseif($x>=51)
                                            {
                                                 $rate="Sedang";
                                            }else{
                                                $rate="Kurang";
                                            }

                                             if($x>=91)
                                            {
                                                $rate="Amat Baik";
                                            }
                                        elseif($x>=76)
                                            {
                                                 $rate="Baik";
                                            }
                                        elseif($x>=61)
                                            {
                                                 $rate="Cukup";
                                            }
                                        elseif($x>=51)
                                            {
                                                 $rate="Sedang";
                                            }else{
                                                $rate="Kurang";
                                            }



                                     ?>
                                        <tr>
                                            <td colspan="5" style="width: 80%; height: 5px;"><p>Konversi nilai PK GURU ke dalam skala 0 – 100 sesuai Permenneg PAN & RB No. 16 Tahun 2009 dengan rumus :</p></td>
                                            <td rowspan="3"><?php echo $x ?></td>
                                            
                                        </tr>
                                        <tr style="border-bottom: black;">
                                            <td rowspan="2" align="center" style="width: 10%">Nilai PKG ( 100 )</td>
                                            <td rowspan="2" style="width: 2%">=</td>"
                                             <td border="2" style="width: 7%; border-bottom: solid;" align="center">Nilai PKG</td>
                                            <td rowspan="2" style="width: 2%" align="center">x</td>
                                            <td rowspan="2" style="width: 5%">100</td>
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td style="width: 7%" align="center" style="margin-bottom: 0px">Nilai PKG Tertinggi</td>
                                         
                                           
                                        </tr>
                                        <tr>
                                            
                                            <td colspan="5"><p>Berdasarkan hasil konversi ke dalam skala nilai sesuai dengan peraturan, selanjutnya ditetapkan sebutan dan persentase angka kreditnya</p></td>
                                             <td><h5><strong><?php echo $rate ?></strong></h5></td>
                                         
                                           
                                        </tr>

                                  
                                </tbody>
                            </table>
                        </div>

                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>