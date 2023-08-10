<?php
defined('BASEPATH') or exit('No direct script access allowed');

class subkriteria extends CI_Controller
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
        $this->load->model('subkriteria_model');
      
      
    }

    public function index()
    {
        $data['admin'] = $this->kriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Sub Kriteria';
        $data['position'] = 'Sub Kriteria';
        $data['subkriteria'] = $this->subkriteria_model->get_AllSubkriteria();
         $data['kriteria'] = $this->kriteria_model->get_AllKriteria();

         // $data['subkriteria'] = $this->model_viewsubkriteria->getdata();

        $this->form_validation->set_rules('nilai', 'Nilai', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('subkriteria/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->subkriteria_model->add();
            $this->session->set_flashdata('done', 'Data berhasil ditambah');
            redirect('subkriteria');
        }
        
    }

    public function ubah($id)
    {
        $data['admin'] = $this->subkriteria_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Sub Kriteria';
        $data['position'] = 'Ubah Sub Kriteria';
        $data['kriteria'] = $this->kriteria_model->get_AllKriteria();
        $data['subkriteria'] = $this->subkriteria_model->get_bySub($id);
        $data['nilai'] = ['1', '2', '3', '4'];
        $data['nama_kriteria'] = ['C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9','C10','C11','C12','C13','C14'];

        $this->form_validation->set_rules('nama_subkriteria', 'Sub Kriteria', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('subkriteria/ubah', $data);
            $this->load->view('template/footer');
             $this->session->set_flashdata('danger', 'Data gagal diubah');
        } else {
            $this->subkriteria_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('subkriteria');
        }
    }

     public function hapus($id)
    {
        $this->subkriteria_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('subkriteria');
    }
}
