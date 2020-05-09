<?php 

class dokumentasi_pekerjaan_model extends CI_Model{

    public function insert_dokumentasi($dokumentasi){

        $this->db->insert('dokumentasipekerjaan', $dokumentasi);
    }

    public function get_dokumentasi(){
        $data = $this->db->get('dokumentasipekerjaan')->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['dokumentasiID'];
            unset($data[$i]['dokumentasiID']);
        }

        return $data;
    }

    public function get_dokumentasi_byid($id){
        $data = $this->db->get_where('dokumentasipekerjaan', ['dokumentasiID' => $id])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['dokumentasiID'];
            unset($data[$i]['dokumentasiID']);
        }

        return $data;
    }

    public function get_dokumentasi_bypekerjaan($id_pekerjaan){
        $data = $this->db->get_where('dokumentasipekerjaan', ['pekerjaanID' => $id_pekerjaan])->result_array();
        for($i = 0; $i < count($data); $i++ ) {
            $data[$i]['id'] = $data[$i]['dokumentasiID'];
            unset($data[$i]['dokumentasiID']);
        }

        return $data;
    }

    public function update_dokumentasi($id, $data){
        $this->db->where(['dokumentasiID' => $id]);
        $this->db->update('dokumentasipekerjaan', $data);
    }

    public function delete_dokumentasi($id){
        $this->db->where(['dokumentasiID' => $id]);
        $this->db->delete('dokumentasipekerjaan');
    }
}
?>