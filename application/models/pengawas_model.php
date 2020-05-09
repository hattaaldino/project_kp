<?php

class pengawas_model extends CI_Model{

    public function insert_pengawas($pengawas){
        $this->db->insert('pengawas', $pengawas);
    }

    public function get_pengawas(){
        $data = $this->db->get('pengawas')->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pengawasID'];
            unset($data[$i]['pengawasID']);
        }

        return $data;
      }
    
    public function get_pengawas_byowner($ownerID){
        $data = $this->db->get_where('pengawas', ['ownerID' => $ownerID])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pengawasID'];
            unset($data[$i]['pengawasID']);
        }
        return $data;
    }

    public function get_pengawas_byid($id){
        $data = $this->db->get_where('pengawas', [ 'pengawasID' => $id])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pengawasID'];
            unset($data[$i]['pengawasID']);
        }

        return $data;
    }

    public function get_pengawas_byUname($username){
        $data = $this->db->get_where('pengawas', [ 'username' => $username])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pengawasID'];
            unset($data[$i]['pengawasID']);
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