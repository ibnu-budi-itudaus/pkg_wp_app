<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peringkat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
       
        $this->load->model('nilai_model');
         $this->load->model('kriteria_model');
         $this->load->model('subkriteria_model');
         $this->load->model('alternatiff_model');
         $this->load->model('laporan_model');
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['title'] = 'Penilaian Kinerja Guru - Peringkat Guru';
        $data['position'] = 'Peringkat Guru';

        $data['tb_subkriteria'] = $this->subkriteria_model->get_AllSubkriteria();//result->
        $data['tb_kriteria'] = $this->kriteria_model->get_AAllKriteriaa2();//result->
        $data['tb_alternatif'] = $this->alternatiff_model->get_guruAllternatiff($tahun);//result
        $data['tb_nilaialternatif'] = $this->nilai_model->getdata($tahun);//join('guru','nilai')-->result

        $data['kriteriacount'] = $this->kriteria_model->countdata();
        $data['alternatifcount'] = $this->alternatiff_model->countdata();
        $data['nilaialternatifcount'] = $this->nilai_model->countdatanilai($tahun);
        $data['gurupkg'] = $this->laporan_model->get_gurupkg($tahun);

      
       
            $this->load->view('template/header', $data);
            $this->load->view('peringkat/index', $data);
            $this->load->view('template/footer');
       
    }

    public function ubah($id)
    {
        $data['admin'] = $this->mapel_model->admin_Active();
        $data['title'] = 'Penilaian Kinerja Guru - Mapel';
        $data['position'] = 'Mata Pelajaran';
        $data['mapel'] = $this->mapel_model->get_ById($id);

        $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('mapel/ubah', $data);
            $this->load->view('template/footer');
        } else {
            $this->mapel_model->edit($id);
            $this->session->set_flashdata('done', 'Data berhasil diubah');
            redirect('mapel');
        }
    }

    public function hapus($id)
    {
        $this->mapel_model->delete($id);
        $this->session->set_flashdata('done', 'Data berhasil dihapus');
        redirect('mapel');
    }
}
