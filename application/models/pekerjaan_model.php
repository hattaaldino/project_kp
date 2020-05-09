<?php

class pekerjaan_model extends CI_Model{

    public function insert_pekerjaan( $pekerjaan){
        $this->db->insert('pekerjaan', $pekerjaan);
    }

    public function get_pekerjaan(){
        $data = $this->db->get('pekerjaan')->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pekerjaanID'];
            unset($data[$i]['pekerjaanID']);
        }

        return $data;
    }

    public function get_pekerjaan_byid($id){
        $data = $this->db->get_where('pekerjaan', ['pekerjaanID' => $id])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pekerjaanID'];
            unset($data[$i]['pekerjaanID']);
        }

        return $data;
    }

    public function get_pekerjaan_byproyek($id_proyek){
        $data = $this->db->get_where('pekerjaan', ['proyekID' => $id_proyek])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['pekerjaanID'];
            unset($data[$i]['pekerjaanID']);
        }

        return $data;
    }

    public function update_pekerjaan($id, $data){
        $this->db->where(['pekerjaanID' => $id]);
        $this->db->update('pekerjaan', $data);
    }

    public function delete_pekerjaan($id){
        $this->db->where(['pekerjaanID' => $id]);
        $this->db->delete('pekerjaan');
    }
}

?>