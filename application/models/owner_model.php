<?php

class owner_model extends CI_Model{
    
    public function insert_owner($owner){
        $this->db->insert('owner',$owner);
    }

    public function get_owner(){
        $data = $this->db->get('owner')->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['ownerID'];
            unset($data[$i]['ownerID']);
        }

        return $data;
    }

    public function get_owner_byUname($username){
        $data =  $this->db->get_where('owner', [ 'username' => $username])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['ownerID'];
            unset($data[$i]['ownerID']);
        }

        return $data;
    }

    public function get_owner_byid($id){
        $data =  $this->db->get_where('owner', [ 'ownerID' => $id])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['ownerID'];
            unset($data[$i]['ownerID']);
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