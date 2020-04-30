<?php

class owner_model extends CI_Model{
    
    public function insert_owner($owner){
        $this->db->insert('owner',$owner);
    }

    public function get_owner(){
        $data = $this->db->get('owner')->result_array();
        foreach($data as $owner) {
            $owner['id'] = $owner['ownerID'];
            unset($owner['ownerID']);
        }

        return $data;
    }

    public function get_owner_byUname($username){
        $data =  $this->db->get_where('owner', [ 'username' => $username])->row_array();
        foreach($data as $owner) {
            $owner['id'] = $owner['ownerID'];
            unset($owner['ownerID']);
        }

        return $data;
    }

    public function get_owner_byid($id){
        $data =  $this->db->get_where('owner', [ 'ownerID' => $id])->row_array();
        foreach($data as $owner) {
            $owner['id'] = $owner['ownerID'];
            unset($owner['ownerID']);
        }

        return $data;
    }

    public function update_owner($id, $data){
        $this->db->where(['ownerID' => $id]);
        $this->db->update('owner', $data);
    }

    public function delete_owner($id){
        $this->db->where(['ownerID' => $id]);
        $this->db->delete('owner');
    }
}

?>