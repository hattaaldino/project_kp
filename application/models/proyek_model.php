<?php

class proyek_model extends CI_Model{

    public function insert_proyek($proyek){
        $this->db->insert('proyek', $proyek);
    }

    public function get_proyek(){
        $data = $this->db->get('proyek')->result_array();
        foreach($data as $proyek) {
            $proyek['id'] = $proyek['proyekID'];
            unset($proyek['proyekID']);
        }

        return $data;
    }

    public function get_proyek_byid($id_proyek){
        $data = $this->db->get_where('proyek', ['proyekID' => $ownerID])->result_array();
        foreach($data as $proyek) {
            $proyek['id'] = $proyek['proyekID'];
            unset($proyek['proyekID']);
        }

        return $data;
    }

    public function get_proyek_byowner($ownerID){
        $data = $this->db->get_where('proyek', ['ownerID' => $ownerID])->result_array();
        foreach($data as $proyek) {
            $proyek['id'] = $proyek['proyekID'];
            unset($proyek['proyekID']);
        }

        return $data;
    }

    public function get_proyek_bypengawas($pengawasID){
       $data = $this->db->get_where('proyek', ['pengawasID' => $pengawasID])->result_array();
       foreach($data as $proyek) {
            $proyek['id'] = $proyek['proyekID'];
            unset($proyek['proyekID']);
        }

        return $data;
    }

    public function get_proyek_bykontraktor($kontraktorID){
        $data = $this->db->get_where('proyek', ['kontraktorID' => $kontraktorID])->result_array();
        foreach($data as $proyek) {
            $proyek['id'] = $proyek['proyekID'];
            unset($proyek['proyekID']);
        }

        return $data;
    }

    public function update_proyek($id, $data){
        $this->db->where(['proyekID' => $id]);
        $this->db->update('proyek', $data);
    }

    public function delete_proyek($id){
        $this->db->where(['proyekID' => $id]);
        $this->db->delete('proyek');
    }
}