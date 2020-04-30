<?php

class user_model extends CI_Model{

    public function get_users(){
        return $this->db->get('user')->result_array();
    }

    public function get_login($username, $password){
        $data = [
            'username' => $username,
            'password' => md5($password)
        ];
        return $this->db->get_where('user', $data)->result_array();
    }

    public function insert_user($user){
        if ($this->db->insert('user', $user)) {
            return 'success';
        } else {
            $error = $this->db->error();
            if($error['code'] == 1062){
                return 'duplicate';
            } else {
                return 'error';
            }
        }

    }

    public function update_user($username, $data){
        $this->db->where(['username' => $username]);
        $this->db->update('user', $data);
    }

    public function delete_user($username){
        $this->db->where(['username' => $username]);
        $this->db->delete('user');
    }
}

?>