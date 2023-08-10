<?php
defined('BASEPATH') or exit('No direct script access allowed');

class laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        // if ($this->session->userdata('akses') != 'Administrator') {
        //     redirect('auth/blok');
        // }
        $this->load->model('nilai_model');

         $this->load->model('kriteria_model');
          $this->load->model('laporan_model');
         $this->load->model('subkriteria_model');
         $this->load->model('alternatiff_model');
    }

    public function index()
    {
        $data['admin'] = $this->nilai_model->admin_Active();
        $data['period'] = $this->nilai_model->tahun_Active();
        $tahun = $data['period']['id_periode'];
        $data['title'] = 'Penilaian Kinerja Guru - Laporan';
        $data['position'] = 'Laporan';
        $data['periods'] = $this->laporan_model->get_allperiod();

      


        $data['kriteriacount'] = $this->kriteria_model->countdata();
        $data['alternatifcount'] = $this->alternatiff_model->countdata();
        $data['nilaialternatifcount'] = $this->nilai_model->countdatanilai($tahun);

      
       
            $this->load->view('template/header', $data);
            $this->load->view('laporan/index', $data);
            $this->load->view('template/footer');
       
    }

public function periodx($id_period)
{
    $data['admin'] = $this->nilai_model->admin_Active();
        $data['period'] = $this->nilai_model->tahun_Active();
        $tahun = $data['period']['id_periode'];
        $now = $id_period;
        $data['thnpilihan'] = $this->laporan_model->get_oneperiod($now);
        $data['title'] = 'Penilaian Kinerja Guru - Laporan';
        $data['position'] = 'Laporan';
        $data['laporan'] = $this->laporan_model->getdata($now);


         $this->load->view('template/header', $data);
            $this->load->view('laporan/periodx', $data);
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
                'nilai' => $this->input->post('nilai')[$index],
                'uuid' => $uuid,
                'tanggal' => $tanggal,
            ));
            $index++;
        }
         $this->session->set_flashdata('done', 'Data berhasil ditambah');
        
        $this->load->model('model_wp');
        $this->model_wp->insertdata($data);
        
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
