<?php
defined('BASEPATH') or exit('No direct script access allowed');

class nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('nilai_model');
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $admin = $data['admin']['id_admin'];
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        if ($this->session->userdata('akses') == 'Administrator') {
            $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
        } else {
            // $data['guru'] = $this->nilai_model->get_Guru($tahun, $admin);
            $data['guru'] = $this->nilai_model->get_unratedGuru($admin);
        }

        $this->load->view('template/header', $data);
        $this->load->view('nilai/index', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['guru'] = $this->nilai_model->get_GuruById($tahun, $id);
         $data['nilai'] = ['1', '2', '3', '4'];

       

        $this->load->view('template/header', $data);
        $this->load->view('nilai/ubah', $data);
        $this->load->view('template/footer');
    }

     public function penilaian($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria2'] = $this->nilai_model->get_AllKriteria();
         $data['kriteria'] = $this->nilai_model->get_AllKriteriaAndSub();
        $data['guru'] = $this->nilai_model->get_unratedGuruById2($id);
         $data['nilai'] = ['1', '2', '3', '4'];

       

        $this->load->view('template/header', $data);
        $this->load->view('nilai/penilaian', $data);
        $this->load->view('template/footer');
    }

    public function simpan($id)
    {
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $this->nilai_model->edit($id, $tahun);
        $this->session->set_flashdata('done', 'Data berhasil diubah');
        redirect('nilai');
    }

    public function tambah($id)
    {
        $id_guru = $id;
        
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
         
    
        $data['cekid'] = $this->nilai_model->countdataguru($id);
        if($data['cekid'] > 0){

             $this->session->set_flashdata('error', 'Data gagal ditambah');
            redirect('nilai/index');
        }else{

            for($i=1; $i < 15; $i++){
            
            $data = array(
            'id_kriteria' => $this->input->post('krit'.$i.''),
            'id_guru' => $id,
            'id_periode' => $tahun, 
            'nilai_guru' => $this->input->post('C'.$i.'')
            );

                $this->nilai_model->tambah($data, 'nilai');
             }
              $this->session->set_flashdata('done', 'Data berhasil ditambah');
                redirect('nilai/index');  

        }
        
        
    }
    

    public function detail($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Nilai';
        $data['position'] = 'Nilai';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['guru'] = $this->nilai_model->get_GuruById3($tahun, $id);
         $data['unratedguru'] = $this->nilai_model->get_unratedGuruById($id);
        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        $data['alternatif'] = $this->nilai_model->get_Alternatif();
        $data['nilai_guru'] = $this->nilai_model->get_NilaiGuru($id, $tahun);
         $data['pkg'] = $this->nilai_model->get_pkg($id, $tahun);

        if ($data['nilai'] < 1) {
            $this->session->set_flashdata('belum', 'Penilaian belum dihitung');
        }

        
         $nilai=array();
         $x=0;
        foreach($data['kriteria'] as $n){
            $nilai[] = $data['nilai_guru'][$x]['nilai_guru'];
            $x++;
        }
        $jml_nilai = array_sum($nilai);
        

        $kon_nilai = (($jml_nilai/56)*100);

         

          if($kon_nilai>=91)
                {
                    $rate="Amat Baik";
                    $akk = 125;
                }
            elseif($kon_nilai>=76)
                {
                     $rate="Baik";
                     $akk = 100;
                }
            elseif($kon_nilai>=61)
                {
                     $rate="Cukup";
                      $akk = 75;
                }
            elseif($kon_nilai>=51)
                {
                     $rate="Sedang";
                      $akk = 50;
                }else{
                    $rate="Kurang";
                     $akk = 25;
                }

        $data['jml_nilai'] = array(
            'total'=>$jml_nilai,
            'kon_nilai'=>$kon_nilai,
            'skala'=>$rate,
            'id_periode'=>$tahun
        );

        if($data['pkg']== 0){

        $datar = array(
            'id_guru' => $id,
            'nilai_pkg'=>$jml_nilai,
            'kon_nilai'=>$kon_nilai,
            'skala'=>$rate,
            'akk'=>$akk
        );
         $this->nilai_model->tambah_pkg($datar, 'hasil_pkg');
    
}
        
                


        $this->load->view('template/header', $data);
        $this->load->view('nilai/detail', $data);
        $this->load->view('template/footer');
    }

    public function hitung($id)
    {
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['alternatif'] = $this->nilai_model->get_Alternatif();

        // Cek apakah data kosong
        $data['nilai'] = $this->nilai_model->get_NilaiGuru($id, $tahun);


       
           if ($data['nilai'][1] < 1) {
                $this->session->set_flashdata('unrated', 'Input Penilaian Kinerja Guru (PKG)');
                redirect('nilai/penilaian/' . $id);
            }
        

        // Cek apakah sudah dihitung
        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        if ($data['nilai'] != null) {
            $this->session->set_flashdata('done', 'Data Sudah dihitung');
            redirect('nilai/detail/' . $id);
        }


       
        


        foreach ($data['alternatif'] as $a) {
            $id_a = $a['id_alternatif'];
            $data['nilai'] = $this->nilai_model->get_NilaiGuru($id, $tahun);
            foreach ($data['nilai'] as $n) {
                $id_n = $n['id_nilai'];
                $nilai = $n['nilai_guru'];
                if ($nilai == "4") {
                    $konversi = $a['nilai4'];
                } elseif ($nilai == "3") {
                    $konversi = $a['nilai3'];
                } elseif ($nilai == "2") {
                    $konversi = $a['nilai2'];
                } elseif ($nilai == "1") {
                    $konversi = $a['nilai1'];
                } else {
                    $this->session->set_flashdata('kosong', 'Isi data yang masih kosong');
                    redirect('nilai/ubah/' . $id);
                }
                $this->nilai_model->konversi($konversi, $id_n, $id_a);
            }
        }

        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        foreach ($data['nilai'] as $n) {
            $id_n = $n['id_nilai'];
            // Nilai Pembagi
            $data['nilai'] = $this->nilai_model->get_Nilai($id_n);
            $pembagi = 0;
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
                $nilai = number_format(pow($data['nilai2']['nilai'], 2), 3);
                $pembagi = $pembagi + $nilai;
            }
            $pembagi = number_format(sqrt($pembagi), 6);

            //Nilai Normalisasi
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);

                $nilai = $data['nilai2']['nilai'];
                $normalisasi = number_format($nilai / $pembagi, 3);
                $this->nilai_model->update_Normalisasi($normalisasi, $id_n, $id_a);
            }

            //Nilai Terbobot
            foreach ($data['alternatif'] as $a) {
                $id_a = $a['id_alternatif'];
                $data['nilai2'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
                $n_normalisasi = $data['nilai2']['normalisasi'];
                $data['detail'] = $this->nilai_model->detail($id_n);
                $bobot = $data['detail']['bobot'];
                $terbobot = number_format($n_normalisasi * $bobot, 3);
                $this->nilai_model->update_Terbobot($terbobot, $id_n, $id_a);
            }

              
        }
        $this->session->set_flashdata('done', 'Data Berhasil dihitung');
        redirect('nilai/detail/' . $id);

      
    }
}
