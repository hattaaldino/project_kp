<?php

class kontraktor_model extends CI_Model{
    
    public function insert_kontraktor($kontraktor){
        $this->db->insert('kontraktor',$kontraktor);
    }

    public function get_kontraktor(){
        $data = $this->db->get('kontraktor')->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['kontraktorID'];
            unset($data[$i]['kontraktorID']);
        }

        return $data;
    }

    public function get_kontraktor_byid($id){
        $data = $this->db->get_where('kontraktor', [ 'kontraktorID' => $id])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['kontraktorID'];
            unset($data[$i]['kontraktorID']);
        }

        return $data;
    }

    public function get_kontraktor_byUname($username){
        $data = $this->db->get_where('kontraktor', [ 'username' => $username])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['kontraktorID'];
            unset($data[$i]['kontraktorID']);
        }

        return $data;
    }

    public function update_kontraktor($id, $data){
        $this->db->where(['kontraktorID' => $id]);
        $this->db->update('kontraktor', $data);
    }

    public function delete_kontraktor($id){
        $this->db->where(['kontraktorID' => $id]);
        $this->db->delete('kontraktor');
    }
}

?>