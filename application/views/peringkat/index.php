<style>
    [data-toggle="collapse"].collapsed .if-not-collapsed {
    display: none;
    }
    [data-toggle="collapse"]:not(.collapsed) .if-collapsed {
    display: none;
    }
    #tablematrix {
    position: relative;
    }
    #tablematrix:before,
    #tablematrix:after {
    content: '';
    height: 100%;
    position: absolute;
    border-color: black;
    border-style: solid;
    width: 10px;
    top: -1px;
    }
    #tablematrix:before {
    left: -2px;
    border-width: 2px 0px 2px 2px;
    }
    #tablematrix:after {
    right: -2px;
    border-width: 2px 2px 2px 0px;
    }
</style>



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
        
            


                        <br />
                        <div class="card">
                            <div class="card-body">
<h4><strong>Peringkat Guru SMP Negeri 1 Kota Serang Tahun <?= $periode['waktu']; ?></strong><h4>

<hr />

<!-- <button id="coll" class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
    <span class="if-collapsed">Tampilkan Perhitungan <i class="fas fa-caret-down"></i></span>
    <span class="if-not-collapsed">Sembunyikan Perhitungan <i class="fas fa-caret-up"></i></span>
</button>
 -->
<div class="collapse" id="collapse1">
    

        <h6><strong>Inisialisasi Bobot</strong></h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <?php
                        foreach ($tb_kriteria as $kriteria) {
                        ?>
                        <th><?=$kriteria->nama_kriteria?><br>(<?=$kriteria->jenis?>)</th>
                        <?php
                        }
                        ?>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                
                    <tr>
                        <th>Kepentingan</th>
                        <?php
                        $arr_total_kriteria = array();
                        $arr_cb = array();
                        $arr_id = array();
                        foreach ($tb_kriteria as $kriteria) {
                        ?>
                        <td>
                            <?= $kriteria->bobot ;?>
                        </td>
                        <?php
                        $arr_total_kriteria[] = $kriteria->bobot;
                        $arr_cb[] = $kriteria->jenis;
                        $arr_id[] = $kriteria->id_kriteria;
                        }
                        $total_kriteria = array_sum($arr_total_kriteria);
                        ?>
                        <td>
                        <?= $total_kriteria ;?>
                        </td>
                    </tr>
                    <tr>
                        <th>Bobot Kepentingan</th>
                    <?php
                        $arr_total_bobot = array();
                        foreach ($arr_total_kriteria as $atk) {
                            $bobot = $atk/$total_kriteria;
                        ?>
                        <td>
                            <?= $bobot ;?>
                        </td>
                        <?php
                        $arr_total_bobot[] = $atk/$total_kriteria;
                        $total_bobot = array_sum($arr_total_bobot);
                        }
                        ?>
                        <td><?= $total_bobot ;?></td>

                    </tr>
                    <tr>
                        <th>Pangkat</th>
                        <?php
                        $arr_pangkat = array();
                        $x=0;
                        foreach ($arr_total_bobot as $atbk) {
                        ?>
                        <td>
                            <?= $pangkat = ($arr_cb[$x]=='Benefit') ? $atbk : -1*$atbk ;?>
                        </td>
                        <?php
                        $arr_pangkat[$arr_id[$x]] = $pangkat;
                        $x++;
                        }
                        ?>
                        <td></td>

                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <h6><strong>Inisialisasi Nilai</strong></h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th rowspan=2>No</th>
                        <th rowspan=2>Nama Alternatif</th>
                        <th colspan=<?php echo $kriteriacount;?>>Nilai</th>
                    </tr>
                    <tr>
                        <?php
                        foreach ($tb_kriteria as $kriteria) {
                        ?>
                        <th><?=$kriteria->nama_kriteria?><br>(<?=$kriteria->jenis?>)</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n=1;
                    foreach ($tb_alternatif as $alternatif) {
                    ?>
                    <tr>
                        <td><?=$n++?></td>
                        <td><?=$alternatif->nama_alternatiff?></td>
                        <?php
                        foreach ($tb_kriteria as $kriteria) {
                        ?>
                        <td>
                            <?php
                            foreach ($tb_nilaialternatif as $nilai) {
                                if ($nilai->id_guru == $alternatif->id_guru && $nilai->id_kriteria == $kriteria->id_kriteria) {     
                            ?>

                            <?=$nilai->nilai_guru?>
                           
                            <?php
                                }
                            }
                            ?>
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <hr>

        <?php
        $n=1;
        $arr_al = array();
        foreach ($tb_alternatif as $alternatif) {
            $arr_s = array();
            foreach ($tb_kriteria as $kriteria) {
                foreach ($tb_nilaialternatif as $nilai) {
                    if ($nilai->id_guru == $alternatif->id_guru && $nilai->id_kriteria == $kriteria->id_kriteria) {
                        $hasil_pangkat = pow($nilai->nilai_guru, $arr_pangkat[$kriteria->id_kriteria]);
                        $arr_s[] = $hasil_pangkat;
                    }
                }
            }
            $arr_al[] = $arr_s;
        }
        ?>

        <h6><strong>Nilai Vektor S</strong></h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th rowspan=1>Nilai S</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total=0; ?>
                    <?php $arr_s_final = array(); $x=0; $no=1; foreach ($tb_alternatif as $alternatif) { ;?>
                    <tr>
                        <td><?= $no++ ;?></td>
                        <td><?= $alternatif->nama_alternatiff ;?></td>
                        <td>
                            <!-- <pre>
                                <?= print_r($arr_al[$x]) ;?>
                            </pre> -->
                            <?= $nilai_s = cariMultiplikasi($arr_al[$x]) ;?>
                            <?php $total = $total + $nilai_s; ?>
                        </td>
                    </tr>
                    <?php $arr_s_final[$alternatif->id_alternatiff."-".$alternatif->nama_alternatiff]=$nilai_s; $x++; } ?>
                    <tr>
                        <td></td>
                        <th>Total</th>
                        <th><?= $total  ?></th>
                    </tr>
                </tbody>
            </table>
            
            <!-- <pre>
                <?= print_r($arr_s_final) ;?>
            </pre> -->
        </div>
        <hr>

        <h6><strong>Nilai Vektor V</strong></h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <th rowspan=1>Nilai V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($arr_s_final as $k => $v) { ;?>
                    <tr>
                        <td><?= $no++ ;?></td>
                        <td>
                            <?= explode("-",$k)[1] ;?>
                        </td>
                        <td>
                            <?= $nilai_v = $v/array_sum($arr_s_final);?>
                        </td>
                    </tr>
                    <?php $arr_v_final[$k]=$nilai_v; $no++; } ?>
                </tbody>
            </table>
            
            <!-- <pre>
                <?= print_r($arr_v_final) ;?>
            </pre> -->
        </div>
        <hr>
        <h6><strong>Perangkingan</strong></h6>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Rangking</th>
                        <th>Nama Alternatif</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n=1;
                    arsort($arr_v_final);
                    foreach ($arr_v_final as $k=>$v) {
                    ?>
                    <tr>
                        <td><?=$n++?></td>
                        <td>
                            <?= explode("-",$k)[1] ;?>
                        </td>
                        <td><?=$v?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    
</div>

<div class="collapse show" id="collapse2">
    <div class="card card-body">

        <form action="<?php echo site_url('analisa_wp/save'); ?>" method="post">
        <h6><strong>Hasil Ranking Metode WP</strong></h6>
        <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    
                                    <th>Ranking</th>
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai V</th>
                                    <th>Nilai Kinerja</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($gurupkg as $m) {
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $m->nama_guru ?></td>
                                        <td><?= $m->nip ?></td>
                                        <td><?= $m->jabatan ?></td>
                                        <td><?= $m->jenis_kelamin ?></td>
                                         <td><?= $m->nilai ?></td>
                                          <td><?= $m->kon_nilai ?></td>
                                       
                                    </tr>
                                <?php
                                    $no = $no + 1;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
</div>



                       </h6>

                    </div>
               
            
    </div>

</div>