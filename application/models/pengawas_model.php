<?php

class pengawas_model extends CI_Model{

    public function insert_pengawas($pengawas){
        $this->db->insert('pengawas', $pengawas);
    }

    public function get_pengawas(){
        $data = $this->db->get('pengawas')->result_array();
        foreach($data as $pengawas) {
            $pengawas['id'] = $pengawas['pengawasID'];
            unset($pengawas['pengawasID']);
        }

        return $data;
      }
    
    public function get_pengawas_byowner($ownerID){
        $data = $this->db->get_where('pengawas', [ 'ownerID' => $ownerID])->result_array();
        foreach($data as $pengawas) {
            $pengawas['id'] = $pengawas['pengawasID'];
            unset($pengawas['pengawasID']);
        }

        return $data;
    }

    public function get_pengawas_byid($id){
        $data = $this->db->get_where('pengawas', [ 'pengawasID' => $id])->row_array();
        foreach($data as $pengawas) {
            $pengawas['id'] = $pengawas['pengawasID'];
            unset($pengawas['pengawasID']);
        }

        return $data;
    }

    public function get_pengawas_byUname($username){
        $data = $this->db->get_where('pengawas', [ 'username' => $username])->row_array();
        foreach($data as $pengawas) {
            $pengawas['id'] = $pengawas['pengawasID'];
            unset($pengawas['pengawasID']);
        }

        return $data;
    }

    public function update_pengawas($id, $data){
        $this->db->where(['pengawasID' => $id]);
        $this->db->update('pengawas', $data);
    }

    public function delete_pengawas($id){
        $this->db->where(['pengawasID' => $id]);
        $this->db->delete('pengawas');
    }
}
?>