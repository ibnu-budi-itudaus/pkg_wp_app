<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
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
        $this->load->model('nilai_model');
               $this->load->model('alternatiff_model');
        
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
        redirect("cart");
    }

    function update()
    {
        $this->cart->update($_POST);
        redirect("cart");
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Alternatif';
        $data['position'] = 'Pilih Alternatif';
       $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];

        if ($this->session->userdata('akses') == 'Administrator') {
            $data['guru'] = $this->nilai_model->get_AllGuru($tahun);
            $data['alternatif'] = $this->cart->contents();
        } else {
            $data['guru'] = $this->nilai_model->get_Guru($tahun, $admin);
        }
 
      
        // $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
        // if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('alternatif/pilih', $data);
            $this->load->view('template/footer');
        // } else {
        //     $this->periode_model->add();
        //     $this->periode_model->add_Nilai();
        //     $this->session->set_flashdata('done', 'Data berhasil ditambah');
        //     redirect('periode');
        // }
    }

    public function ubah($id)
    {
        $data['admin'] = $this->periode_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Periode';
        $data['position'] = 'Periode';
        $data['periode'] = $this->periode_model->get_ById($id);
        $data['status'] = ['Aktif', 'Tidak Aktif'];

        $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('periode/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->periode_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('periode');
        }
    }

    public function hapus($id)
    {
        $this->periode_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('periode');
    }

    public function aktif($id)
    {
        $this->periode_model->active($id);
        $this->session->set_flashdata('done', 'Periode berhasil diaktifkan');
        redirect('periode');
    }
}
