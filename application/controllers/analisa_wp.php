<?php
defined('BASEPATH') or exit('No direct script access allowed');

class analisa_wp extends CI_Controller
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
         $this->load->model('kriteria_model');
         $this->load->model('subkriteria_model');
         $this->load->model('alternatiff_model');
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['periode'] = $this->nilai_model->tahun_Active();
        $tahun = $data['periode']['id_periode'];
        $data['title'] = 'Penilaian Kinerja Guru - Analisa WP';
        $data['position'] = 'Analisa WP';

        $data['tb_subkriteria'] = $this->subkriteria_model->get_AllSubkriteria();//result->
        $data['tb_kriteria'] = $this->kriteria_model->get_AAllKriteriaa2();//result->
        $data['tb_alternatif'] = $this->alternatiff_model->get_guruAllternatiff($tahun);//result
        $data['tb_nilaialternatif'] = $this->nilai_model->getdata($tahun);//join('guru','nilai')-->result

        $data['kriteriacount'] = $this->kriteria_model->countdata();
        $data['alternatifcount'] = $this->alternatiff_model->countdata();
        $data['nilaialternatifcount'] = $this->nilai_model->countdatanilai($tahun);

      
       
            $this->load->view('template/header', $data);
            $this->load->view('wp/index', $data);
            $this->load->view('template/footer');
       
    }


    public function save()
    {
        $uuid = uniqid();
        $tanggal = date("Y-m-d");
        $data = array();    
        $index = 0;

        foreach($this->input->post('id_alternatiff') as $id_alternatiff){
            array_push($data, array(
                'id_alternatiff' => $id_alternatiff,
                'id_guru' => $this->input->post('id_guru')[$index],
                'nilai' => $this->input->post('nilai')[$index],
                'uuid' => $uuid,
                'tanggal' => $tanggal,
                 'id_periode' => $this->input->post('id_periode')[$index],
            ));
            $index++;
        }
        
        $this->load->model('laporan_model');
        $this->laporan_model->insertdata($data);
        
        redirect(site_url('laporan/periodx'));
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
