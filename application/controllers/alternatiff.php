<?php
defined('BASEPATH') or exit('No direct script access allowed');

class alternatiff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        if ($this->session->userdata('akses') != 'Administrator') {
            redirect('auth/blok');
        }
        $this->load->model('alternatiff_model');
        $this->load->model('nilai_model');
        $this->load->library('cart');
    }

    public function index()
    {


        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'spk_pkg_wp';
        $koneksi = mysqli_connect($host, $username, $password, $database);

        // mengambil data barang dengan kode paling besar
        $query = mysqli_query($koneksi, "SELECT max(nama_alternatiff) as idTerbesar FROM alternatiff");
        $data = mysqli_fetch_array($query);
        $kodeBarang = $data['idTerbesar'];
         
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kodeBarang, 1, 1);
         
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
        //Mengambil data tahun sekarang

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "A";
        $nama_alt = $huruf . sprintf("%01s", $urutan);


        $data['admin'] = $this->alternatiff_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Alternatif';
        $data['alternatif'] = $this->alternatiff_model->get_AllAlternatif2();
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
        $nama_al = ["nama_ternatif"=>$nama_alt];
        $data['nama_alte'] = $nama_al;
         $data['cekid'] = $this->alternatiff_model->countaltdata();
         $data['maxdata'] = $this->alternatiff_model->get_maxdata();

        $this->load->view('template/header', $data);
        $this->load->view('alternatif/index', $data);
        $this->load->view('template/footer');
    }

     public function detail($id)
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Alternatif';
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['kriteria'] = $this->nilai_model->get_AllKriteria();
        $data['guru'] = $this->nilai_model->get_GuruById($tahun, $id);
        $data['nilai'] = $this->nilai_model->get_AllNilai($id, $tahun);
        $data['alternatif'] = $this->nilai_model->get_Alternatif();
        $data['nilai_guru'] = $this->nilai_model->get_NilaiGuru($id, $tahun);

        if ($data['nilai'] == null) {
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
                }
            elseif($kon_nilai>=76)
                {
                     $rate="Baik";
                }
            elseif($kon_nilai>=61)
                {
                     $rate="Cukup";
                }
            elseif($kon_nilai>=51)
                {
                     $rate="Sedang";
                }else{
                    $rate="Kurang";
                }

                 if($kon_nilai>=91)
                {
                    $rate="Amat Baik";
                }
            elseif($kon_nilai>=76)
                {
                     $rate="Baik";
                }
            elseif($kon_nilai>=61)
                {
                     $rate="Cukup";
                }
            elseif($kon_nilai>=51)
                {
                     $rate="Sedang";
                }else{
                    $rate="Kurang";
                }



        $data['jml_nilai'] = array(
            'total'=>$jml_nilai,
            'kon_nilai'=>$kon_nilai,
            'skala'=>$rate
        );

        $posisi = 0;
        foreach ($data['nilai_guru'] as $n) {
            $id_n = $n['id_nilai'];
            $data['detail'] = $this->nilai_model->detail($id_n);

            //Nilai A+
            if ($data['detail']['jenis'] == 'Benefit') {
                $data['aplus'] = $this->nilai_model->select_Max($id_n);
            } else {
                $data['aplus'] = $this->nilai_model->select_Min($id_n);
            }
            $data['A_plus'][$posisi] = $data['aplus'];


            //Nilai A-
            if ($data['detail']['jenis'] == 'Benefit') {
                $data['amin'] = $this->nilai_model->select_Min($id_n);
            } else {
                $data['amin'] = $this->nilai_model->select_Max($id_n);
            }
            $data['A_min'][$posisi] = $data['amin'];

            $posisi = $posisi + 1;
        }

        $x = 0;
        foreach ($data['alternatif'] as $a) {
            $id_a = $a['id_alternatif'];
            $y = 0;
            $dplus = 0;
            $dmin = 0;
            foreach ($data['nilai_guru'] as $n) {
                $id_n = $n['id_nilai'];
                $data['terbobot'] = $this->nilai_model->get_Nilai2($id_n, $id_a);
                $n_terbobot = $data['terbobot']['terbobot'];
                $aplus = $data['A_plus'][$y]['nilai_a'];
                $amin = $data['A_min'][$y]['nilai_a'];

                //Nilai D+
                $n_dplus = number_format(pow($aplus - $n_terbobot, 2), 3);
                $dplus = $dplus + $n_dplus;

                //Nilai D-
                $n_dmin = number_format(pow($n_terbobot - $amin, 2), 3);
                $dmin = $dmin + $n_dmin;

                $y = $y + 1;
            }
            $data['hasil'][$x]['0'] =  number_format(sqrt($dplus), 3);
            $data['hasil'][$x]['1'] =  number_format(sqrt($dmin), 3);

            //Nilai Preferensi
            if ($data['hasil'][$x]['0'] and $data['hasil'][$x]['1'] != 0) {
                $preferensi = number_format($data['hasil'][$x]['1'] / ($data['hasil'][$x]['1'] + $data['hasil'][$x]['0']), 3);
            } else {
                $preferensi = 0;
            }
            $data['hasil'][$x]['2'] =  $preferensi;

            //Cek sudah dihitung
            $data['isi'] = $this->nilai_model->select_nilai($id, $tahun, $id_a);
            if ($data['isi']['nilai_akhir'] == "0") {
                foreach ($data['nilai_guru'] as $n) {
                    $id_n = $n['id_nilai'];
                    $this->nilai_model->update_preferensi($preferensi, $id_n, $id_a);
                }
            }

            $x = $x + 1;
        }

        $data['nilai_akhir'] = $this->nilai_model->get_hasil($id, $tahun);
        $rank = $data['nilai_akhir']['id_alternatif'];
        $this->nilai_model->update_Rank($rank, $id, $tahun);
        $data['kinerja'] = $this->nilai_model->get_hasil($id, $tahun);

        $this->load->view('template/header', $data);
        $this->load->view('alternatif/detail', $data);
        $this->load->view('template/footer');
    }


     public function pilih()
    {
        $data['admin'] = $this->alternatiff_model->admin_Active();
        $admin = $data['admin']['id_admin'];
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Pilih Alternatif';
       $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        if ($this->session->userdata('akses') == 'Administrator') {
            $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
        } else {
            $data['guru'] = $this->nilai_model->get_Guru($tahun, $admin);
        }

        $this->load->view('template/header', $data);
        $this->load->view('alternatif/pilih', $data);
        $this->load->view('template/footer');
    }

    public function add($id)
    {
       $data['periode'] = $this->alternatiff_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
         $data['nilai'] = $this->nilai_model->get_NilaiGuru($id, $tahun);
         $id_nilai = $data['nilai']['id_nilai'];
        $data['guru'] = $this->nilai_model->get_GuruById($tahun, $id);
        $id_guru = $data['guru']['id_guru'];
         $nama_guru = $data['guru']['nama_guru'];

        $arrdata = array(
            'id_guru'=> $id_guru,
            'id_nilai'=> $id_nilai,
             'id_periode' => $tahun,
            'nama_guru'=> $nama_guru
        );
        $this->session->set_userdata($arrdata);
        redirect("alternatiff/pilih");
    }


    public function ubah($id)
    {
        $data['admin'] = $this->alternatiff_model->admin_Active();
         $admin = $data['admin']['id_admin'];
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Alternatif';
        $data['alternatif'] = $this->alternatiff_model->get_ById($id);
         $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
    
            $this->load->view('template/header', $data);
            $this->load->view('alternatif/ubah', $data);
            $this->load->view('template/footer');
       
           
    }
    

    public function update ()
    {
            $id = $this->input->post('id_guru');
            
            $data['periode'] = $this->nilai_model->tahun_Active();
            $tahun = $data['periode']['id_periode'];
             $data['gurus'] = $this->alternatiff_model->get_GuruById3($tahun, $id);
             $nilai = $data['gurus']['id_nilai'];

            $this->form_validation->set_rules('nama_alt', 'Nama Alternatif', 'required|trim');
            $data['cekid'] = $this->alternatiff_model->countdataguru($id);
            if($data['cekid'] > 0){

                 $this->session->set_flashdata('error', 'Data gagal diubah');
                redirect('alternatiff/index');
            
            }else{


            $id_alt                 = $this->input->post('id_alt');
            $nama_alternatiff   = $this->input->post('nama');
           
            $data = array(
                    'id_guru'           => $id,
                    'id_nilai'          => $nilai,
                    'id_periode'        => $tahun,
                    'nama_alternatiff'  => $nama
            );

            $where = array(
                'id_alternatiff ' => $id_alt
            );

            $this->alternatiff_model->update_data($where, $data, 'alternatiff');
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('alternatif');
           
        }
    }


    public function hapus($id)
    {
        $this->alternatiff_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('alternatiff');
    }

    public function tambah_alt()
    {
        $id = $this->input->post('id_guru');
        
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
         $data['gurus'] = $this->alternatiff_model->get_GuruById3($tahun, $id);
         $nilai = $data['gurus']['id_nilai'];

        $this->form_validation->set_rules('nama_alt', 'Nama Alternatif', 'required|trim');
        $data['cekid'] = $this->alternatiff_model->countdataguru($id);
        if($data['cekid'] > 0){

             $this->session->set_flashdata('error', 'Data gagal ditambah');
            redirect('alternatiff/index');

        
        }else{
            
            $data = array(
            'id_guru' => $id,
            'id_nilai' => $nilai,
            'id_periode' => $tahun, 
            'nama_alternatiff' => $this->input->post('nama_alt')
            );

                $this->alternatiff_model->tambah($data, 'alternatiff');
                 $this->session->set_flashdata('done', 'Data berhasil ditambah');
                redirect('alternatiff/index');
        }
        
    }



}
