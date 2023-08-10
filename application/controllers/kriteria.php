<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kriteria extends CI_Controller
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
        $this->load->model('kriteria_model');
    }

    public function index()
    {

         $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'spk_pkg_wp';
        $koneksi = mysqli_connect($host, $username, $password, $database);

        // mengambil data barang dengan kode paling besar
        $query = mysqli_query($koneksi, "SELECT max(id_kriteria) as idTerbesar FROM kriteria");
        $data = mysqli_fetch_array($query);
        $kodeBarang = $data['idTerbesar'];
         
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kodeBarang, 0, 2);
         
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
        //Mengambil data tahun sekarang

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "C";
        $nama_krit = $huruf . sprintf("%02s", $urutan);



        $data['admin'] = $this->kriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Kriteria';
        $data['position'] = 'Kriteria';
        $data['jenis'] = ['Benefit', 'Cost'];
        $data['bobot'] = ['1','2','3','4'];
        $data['nama_al'] = ["nama_kr"=>$nama_krit];
        $data['kriteria'] = $this->kriteria_model->get_AllKriteria();
        $data['maxdata'] = $this->kriteria_model->get_maxdata();
        $data['cekid'] = $this->kriteria_model->countkrdata();

        $this->load->view('template/header', $data);
        $this->load->view('kriteria/index', $data);
        $this->load->view('template/footer');
    }

    public function ubah($id)
    {
        $data['admin'] = $this->kriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Kriteria';
        $data['position'] = 'Ubah Kriteria';
        $data['kriteria'] = $this->kriteria_model->get_ById($id);
        $data['jenis'] = ['Benefit', 'Cost'];
        $data['bobot'] = ['1', '2', '3', '4'];

        $this->form_validation->set_rules('kriteria', 'Kriteria', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('kriteria/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->kriteria_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('kriteria');
        }
    }

     public function tambah()
    {
        $nama = $this->input->post('nama_kriteria');
        
       
        $data['cekkriteria'] = $this->kriteria_model->countdataid($nama);
        if($data['cekkriteria'] > 0){

             $this->session->set_flashdata('error', 'Data gagal ditambah');
            redirect('kriteria/index');

        
        }else{
            
            $data = array(
            'nama_kriteria' => $nama,
            'jenis' => $this->input->post('jenis'),
            'bobot' => $this->input->post('bobot'),
            'keterangan' => $this->input->post('keterangan')
            );

                $this->kriteria_model->tambah($data, 'kriteria');
                 $this->session->set_flashdata('done', 'Data berhasil ditambah');
                redirect('kriteria/index');
        }
        
    }


    public function hapus($id)
    {
        $this->kriteria_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('kriteria');
    }

}
