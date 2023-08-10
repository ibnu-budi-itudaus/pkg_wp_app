<?php

class subkriteria_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllSubkriteria()
    {
        $this->db->select('*');
      $this->db->from('subkriteria');
      $this->db->join('kriteria','kriteria.id_kriteria = subkriteria.id_kriteria');      
      $query = $this->db->get()->result();

      return $query;
    }

    public function get_ById($id)
    {

        $this->db->select('*');
      $this->db->from('subkriteria');
      $this->db->join('kriteria','kriteria.id_kriteria = subkriteria.id_kriteria');  
        $query = $this->db->get_where('subkriteria', ['id_subkriteria' => $id])->row_array();
        return $query;
    }

    public function get_bySub($id)
    {
        $query = "SELECT * FROM `subkriteria` s
        join `kriteria` k on s.id_kriteria= k.id_kriteria WHERE s.id_subkriteria = ?";
        return $this->db->query($query, $id)->row_array();
    }

    // public function get_ById($id)
    // {

    //     return $this->db->get_where('subkriteria', ['id_subkriteria' => $id])->row_array();
    // }


    public function add()
    {
        $data = [
            
            'id_kriteria' => $this->input->post('kriteria', true),
            'nama_subkriteria' => $this->input->post('nama_subkriteria'),
            'nilai' => $this->input->post('nilai')
            
        ];

        $this->db->insert('subkriteria', $data);
    }


    public function edit($id)
    {
        $data = [
            // 'id_kriteria' => $this->input->post('id_kriteria', true),
             'nama_subkriteria' => $this->input->post('nama_subkriteria'),
            'nilai' => $this->input->post('nilai')
            // 'bobot' => $this->input->post('bobot'),
            // 'keterangan' => htmlspecialchars($this->input->post('keterangan', true))
        ];
        $this->db->where('id_subkriteria', $id);
        $this->db->update('subkriteria', $data);
    }

     public function delete($id)
    {
        $this->db->delete('subkriteria', ['id_subkriteria' => $id]);
    }
}
