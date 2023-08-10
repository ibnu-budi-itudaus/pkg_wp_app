<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_viewsubkriteria extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getdata()
    {
        $this->load->helper('file');
       $this->db->order_by('id_kriteria, id_subkriteria');
        return $this->db->get('viewsubkriteria')->result();
    }

    public function get_ById($id)
    {
        return $this->db->get_where('mapel', ['id_mapel' => $id])->row_array();
    }

    public function add()
    {
        $data = [
            'mata_pelajaran' => $this->input->post('mapel')
        ];
        $this->db->insert('mapel', $data);
    }
    public function edit($id)
    {
        $this->db->set('mata_pelajaran', $this->input->post('mapel'));
        $this->db->where('id_mapel', $id);
        $this->db->update('mapel');
    }

    public function delete($id)
    {
        $this->db->delete('mapel', ['id_mapel' => $id]);
    }
}
