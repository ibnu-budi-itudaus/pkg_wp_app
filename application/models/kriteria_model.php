<?php

class kriteria_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function get_AAllKriteriaa2()
    {
        return $this->db->get('kriteria')->result();
    }

    public function get_ById($id)
    {
        return $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
    }

    public function countdata()
    {
        return $this->db->get('kriteria')->num_rows();
    }

public function get_maxdata()
{
    $this->db->select_max('id_kriteria','max_id_kriteria');
$query = $this->db->get('kriteria');
return $query->row_array();
}

public function countkrdata()
    {
        return $this->db->get('kriteria')->num_rows();
    }

public function countdataid($nama)
    {
         
      $this->db->select('*');
      $this->db->from('kriteria');
       $this->db->where('nama_kriteria', $nama);     
      $query = $this->db->get()->num_rows();
      return $query;
   }
    


    public function edit($id)
    {
        $data = [
            'nama_kriteria' => htmlspecialchars($this->input->post('kriteria', true)),
            'jenis' => $this->input->post('jenis'),
            'bobot' => $this->input->post('bobot'),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true))
        ];
        $this->db->where('id_kriteria', $id);
        $this->db->update('kriteria', $data);
    }

    public function tambah($data,$table){
        $this->db->insert($table,$data);
    }

     public function delete($id)
    {
        $this->db->delete('kriteria', ['id_kriteria' => $id]);
    }

}
