<?php

class alternatiff_Model extends CI_Model
{
    //Akun Aktif
    public function admin_Active()
    {
        return $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function get_AllAlternatif()
    {
        return $this->db->get('alternatiff')->result_array();
    }

    public function get_AllAlternatiff2()
    {
        return $this->db->get('alternatiff')->result();
    }

     public function get_guruAllternatiff($tahun)
    {
         $this->db->select('*');
      $this->db->from('alternatiff');
      $this->db->join('guru','guru.id_guru = alternatiff.id_guru');
      $this->db->where('alternatiff.id_periode', $tahun);
    $query = $this->db->get()->result();
      return $query;
    }

     public function countaltdata()
    {
        return $this->db->get('alternatiff')->num_rows();
    }


    public function get_ById($id)
    {
        return $this->db->get_where('alternatiff', ['id_alternatiff' => $id])->row_array();
    }

    public function add()
    {
        $data = [
            'nama_alternatiff' => $this->input->post('nama')
        ];
        $this->db->insert('alternatiff', $data);
    }

    public function edit($id)
    {
        $this->db->set('nama_alternatiff', $this->input->post('nama'));
        
        $this->db->where('id_guru', $id);
        $this->db->update('guru', $data);
    }

    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function get_maxdata()
{
    $this->db->select_max('id_alternatiff','max_id_alternatiff');
$query = $this->db->get('alternatiff');
return $query->row_array();
}

    public function delete($id)
    {
        $this->db->delete('alternatiff', ['id_alternatiff' => $id]);
    }

    public function get_GuruById($tahun, $id)
    {
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_nilai`, `nama_guru`, `nip`, p.id_guru, p.nilai_guru FROM `guru` g join 
        `nilai` p on g.id_guru = p.id_guru WHERE p.id_periode = ? AND p.id_guru = ?";
        return $this->db->query($query, array($tahun, $id))->row();
    }

 public function get_GuruById3($tahun, $id){
      $this->db->select('*');
      $this->db->from('nilai');
      $this->db->join('guru','guru.id_guru = nilai.id_guru');
       $this->db->where('guru.id_guru', $id);     
      $query = $this->db->get()->row_array();
      return $query;
   }

   public function get_AllAlternatif2()
    {
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `nama_alternatiff`,`nama_guru`, `nip`, g.id_guru, a.id_alternatiff FROM `alternatiff` a join 
        `guru` g on a.id_guru = g.id_guru GROUP BY g.id_guru ORDER BY a.id_alternatiff ASC";
        return $this->db->query($query)->result_array();
    }

    public function countdata()
    {
        return $this->db->get('alternatiff')->num_rows();
    }

   public function countdataguru($id)
    {
        return $this->db->get_where('alternatiff', array('id_guru'=>$id))->num_rows();
    }

    

     public function get_Allgurunilai()
    {
                $this->db->select('*');
                $this->db->from('nilai');
                 $this->db->join('guru','guru.id_guru = nilai.id_guru');
                $query = $this->db->get()->result_array();
    }

     public function tahun_Active()
    {
        return $this->db->get_where('periode', ['aktif' => 'Y'])->row_array();
    }

public function tambah($data,$table){
        $this->db->insert($table,$data);
    }
    public function get_GuruById2($tahun, $id)
    {
        // return $this->db->get_where('nilai', ['id_periode' => $tahun])->result_array();
        $query = "SELECT `id_nilai`, `nama_guru`, `nip`, p.id_guru, p.nilai_guru FROM `guru` g join 
        `nilai` p on g.id_guru = p.id_guru WHERE p.id_periode = $tahun AND p.id_guru = $id";
        return $this->db->query($query, array($tahun, $id))->result_array();
    }
}
