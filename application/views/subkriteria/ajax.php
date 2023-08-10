<?php 	



//membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "spk_topsis");

//variabel nim yang dikirimkan form.php
$nama_kriteria = $_GET['nama_kriteria'];

//mengambil data
$query = mysqli_query($koneksi, "SELECT * FROM kriteria where nama_kriteria='$nama_kriteria'");
$kriteria = mysqli_fetch_array($query);
$data = array(
            'keterangan'      =>  @$kriteria['keterangan']
        );

//tampil data
echo json_encode($data);
?>


 ?>