<?php
function cariMultiplikasi($array) {
    $toExecute = "";

    foreach ($array as $key => $value) { 
        $operator = $key == count($array) - 1 ? "" : "*";
        $toExecute .= $value.$operator;
    }
    return eval("return ".$toExecute.";");
}

function distance(array $array) {
    // $array = array('-122.42,37.78','-122.45,37.91','-122.48,37.73');
    $array = implode(';', $array);
    $json = file_get_contents('https://api.mapbox.com/directions-matrix/v1/mapbox/driving/'.$array.'?access_token=pk.eyJ1IjoibXVoYXJpZnNvbmEiLCJhIjoiY2tvc2pvNG96MDF2MDJ3cGRjbXdxYTBmcSJ9._adKM78yAMk3GMRTpJnidQ');
    $obj = json_decode($json);
    // echo $obj->access_token;
    return $obj;
}

if(!function_exists('bulan'))
{
    function bulan($bulan)
    {
    Switch ($bulan){
        case 1 : $bulan="Januari";
            Break;
        case 2 : $bulan="Februari";
            Break;
        case 3 : $bulan="Maret";
            Break;
        case 4 : $bulan="April";
            Break;
        case 5 : $bulan="Mei";
            Break;
        case 6 : $bulan="Juni";
            Break;
        case 7 : $bulan="Juli";
            Break;
        case 8 : $bulan="Agustus";
            Break;
        case 9 : $bulan="September";
            Break;
        case 10 : $bulan="Oktober";
            Break;
        case 11 : $bulan="November";
            Break;
        case 12 : $bulan="Desember";
            Break;
        }
    return $bulan;
    }
}

if(!function_exists('nama_alternatif'))
{
    function nama_alternatif($id_alternatif)
    {
        $ci =& get_instance();
        $sql ="SELECT nama_alternatif FROM alternatif WHERE id_alternatif='$id_alternatif'";
        $query = $ci->db->query($sql);
        $nama_alternatif="";
        foreach ($query->result() as $row) {
        $nama_alternatif=$row->nama_alternatif;
        }
        return $nama_alternatif;
    }
}

if(!function_exists('deskripsi'))
{
    function deskripsi($id_alternatif)
    {
        $ci =& get_instance();
        $sql ="SELECT deskripsi FROM alternatif WHERE id_alternatif='$id_alternatif'";
        $query = $ci->db->query($sql);
        $deskripsi="";
        foreach ($query->result() as $row) {
        $deskripsi=$row->deskripsi;
        }
        return $deskripsi;
    }
}

if(!function_exists('id_alternatif_kriteria'))
{
    function id_alternatif_kriteria($id_alternatif,$id_kriteria)
    {
        $ci =& get_instance();
        $sql ="SELECT id_alternatif_kriteria FROM alternatif_kriteria WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'";
        $query = $ci->db->query($sql);
        $id_alternatif_kriteria="";
        foreach ($query->result() as $row) {
            $id_alternatif_kriteria=$row->id_alternatif_kriteria;
        }
        return $id_alternatif_kriteria;
    }
}

if(!function_exists('nilai'))
{
    function nilai($id_alternatif,$id_kriteria)
    {
        $ci =& get_instance();
        $sql ="SELECT nilai FROM alternatif_kriteria WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria'";
        $query = $ci->db->query($sql);
        $nilai="";
        foreach ($query->result() as $row) {
            $nilai=$row->nilai;
        }
        return $nilai;
    }
}

if(!function_exists('nilaisum'))
{
    function nilaisum($id_kriteria)
    {
        $ci =& get_instance();
        $sql1 = "SELECT SUM(nilai*nilai) AS nilaisum FROM alternatif_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY id_alternatif";
        $query1 = $ci->db->query($sql1);
        $datanilai1="";
        foreach ($query1->result() as $row1) {
        $datanilai1=$row1->nilaisum;
        }
        return $datanilai1;
    }
}

if(!function_exists('gettipe'))
{
    function gettipe($id_kriteria)
    {
        $ci =& get_instance();
        $sql1 = "SELECT tipe FROM kriteria WHERE id_kriteria='$id_kriteria'";
        $query1 = $ci->db->query($sql1);
        $datatype1="";
        foreach ($query1->result() as $row1) {
        $datatype1=$row1->tipe;
        }
        return $datatype1;
    }
}

if(!function_exists('decimal'))
{
    function decimal($val) 
    {
        return number_format($val,4);
    }
}

?>
