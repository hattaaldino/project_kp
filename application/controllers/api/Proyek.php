<?php
  // API for retrieve Progress
  use Restserver\Libraries\REST_Controller;
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  defined('BASEPATH') OR exit('No direct script access allowed');
  require APPPATH . 'libraries/REST_Controller.php';
  require APPPATH . 'libraries/Format.php';

  class Proyek extends REST_Controller {

    public function __construct(){
      parent::__construct();
      $this->load->model('proyek_model');
      $this->load->model('pekerjaan_model');
      $this->load->model('dokumentasi_pekerjaan_model');
      $this->load->model('kontraktor_model');
    }

    public function index_post(){
      $proyek = array(
        'nama' => $this->post('nama'),
        'lokasi' => $this->post('lokasi'),
        #===========ATTENTION==============
        # Format untuk tanggal = YYYY-MM-DD
        'tgl_awal' => $this->post('tgl_awal'),
        'tgl_akhir' => $this->post('tgl_akhir'),
        'ownerID' => $_SESSION['user']['id'],
        'pengawasID' => $this->post('pengawasID'),
        'kontraktorID' => $this->post('kontraktorID')
      );

      $this->proyek_model->insert_proyek($proyek);
      $kontraktor = $this->getKontraktor($this->post('kontraktorID'));
      $proyek_id = $this->$db->insertID();

      if($proyek_id){
        $proyek['id'] = $proyek_id;
        $this->response([
          'status' => true,
          'data'=> [
            'proyek' => $proyek,
            'kontraktor' => $kontraktor
          ]], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'message' => 'Create Project Failed'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function pekerjaan_post(){
      $id_proyek = $this->post('id_proyek');
      $list_pekerjaan = json_decode($this->post('pekerjaan'), true);
      foreach($list_pekerjaan as $pekerjaan){
        $pekerjaan['proyekID'] = $id_proyek;
        $this->pekerjaan_model->insert_pekerjaan($pekerjaan);
      }

      $this->set_response([
        'status' => true,
        'message' => 'Success'
      ], REST_Controller::HTTP_CREATED);
    }

    public function change_pekerjaan_post(){
      $list_pekerjaan = json_decode($this->post('pekerjaan'), true);
      foreach($list_pekerjaan as $pekerjaan){
        $id = $pekerjaan['id'];
        $this->pekerjaan_model->update_pekerjaan($id, $pekerjaan);
      }

      $this->set_response([
        'status' => true,
        'message' => 'Success'
      ], REST_Controller::HTTP_OK);
    }

    public function proyek_post(){
      $id_proyek = $this->post('id');
      $fullproyek = $this->proyek_model->get_proyek_byid($id_proyek);
      foreach($fullproyek as $proyek){
        $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
        foreach($proyek['pekerjaan'] as $pekerjaan){
          $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
        }
      }

      if($fullproyek) {
        $this->response([
          'status' => true,
          'data'=> $fullproyek
          ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function change_proyek_post(){
      $id = $this->post('id');
      $proyek = array(
        'nama' => $this->post('nama'),
        'lokasi' => $this->post('lokasi'),
        #===========ATTENTION==============
        # Format untuk tanggal = YYYY-MM-DD
        'tgl_awal' => $this->post('tgl_awal'),
        'tgl_akhir' => $this->post('tgl_akhir'),
        'ownerID' => $_SESSION['user']['id'],
        'pengawasID' => $this->post('pengawasID'),
        'kontraktorID' => $this->post('kontraktorID')
      );

      $this->proyek_model->update_proyek($id, $proyek);
      $listproyek = $this->proyek_model->get_proyek_byowner($_SESSION['user']['id']);
      if($listproyek){
        $this->response([
          'status' => true,
          'data'=> $listproyek
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          'status' => false,
          'message' => 'Create Project Failed'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function proyek_delete(){
      $this->proyek_model->delete_proyek($this->delete('id'));

      $this->set_response([
        'status' => true,
        'message' => 'Success'
      ], REST_Controller::HTTP_RESET_CONTENT);
    }

    public function proyek_byowner_post(){
      $ownerID = $this->post('ownerID');
      $fullproyek = $this->proyek_model->get_proyek_byowner($ownerID);
      foreach($fullproyek as $proyek){
        $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
        foreach($proyek['pekerjaan'] as $pekerjaan){
          $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
        }
      }

      if($fullproyek) {
        $this->response([
          'status' => true,
          'data'=> $fullproyek
          ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function proyek_bykontraktor_post(){
      $kontraktorID = $this->post('kontraktorID');
      $fullproyek = $this->proyek_model->get_proyek_bykontraktor($kontraktorID);
      foreach($fullproyek as $proyek){
        $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
        foreach($proyek['pekerjaan'] as $pekerjaan){
          $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
        }
      }

      if($fullproyek) {
        $this->response([
          'status' => true,
          'data'=> $fullproyek
          ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function proyek_bypengawas_post(){
      $pengawasID = $this->post('pengawasID');
      $fullproyek = $this->proyek_model->get_proyek_bypengawas($pengawasID);
      foreach($fullproyek as $proyek){
        $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
        foreach($proyek['pekerjaan'] as $pekerjaan){
          $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
        }
      }

      if($fullproyek) {
        $this->response([
          'status' => true,
          'data'=> $fullproyek
          ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function kontraktor_proyek_post(){
      $id = $this->post('id');
      $data = ['kontraktorID' => $this->post('kontraktorID')];

      $this->proyek_model->update_proyek($id, $data);
      $kontraktor = $this->getKontraktor($this->post('kontraktorID'));

      if($kontraktor) {
        $this->response([
          'status' => true,
          'data'=> $kontraktor
          ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function status_pekerjaan_post(){
      $listID = $this->post('id');
      $data = ['status' => $this->post('status')];
      foreach($listID as $id){
        $this->pekerjaan_model->update_pekerjaan($id, $data);
      }
      
      $role = $_SESSION['user']['role'];
      if($role == 'kontraktor') {
        $fullproyek = $this->proyek_model->get_proyek_bykontraktor($_SESSION['user']['id']);
        foreach($fullproyek as $proyek){
          $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
          foreach($proyek['pekerjaan'] as $pekerjaan){
            $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
          }
        }

        if($fullproyek) {
          $this->response([
            'status' => true,
            'data'=> $fullproyek
            ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => false,
            'message' => 'Proyek Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
      } elseif($role == 'pengawas'){
        $fullproyek = $this->proyek_model->get_proyek_bypengawas($_SESSION['user']['id']);
        foreach($fullproyek as $proyek){
          $proyek['pekerjaan'] = $this->pekerjaan_model->get_pekerjaan_byproyek($proyek['id']);
          foreach($proyek['pekerjaan'] as $pekerjaan){
            $pekerjaan['dokumentasi'] = $this->dokumentasi_pekerjaan_model->get_dokumentasi_bypekerjaan($pekerjaan['id']);
          }
        }

        if($fullproyek) {
          $this->response([
            'status' => true,
            'data'=> $fullproyek
            ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => false,
            'message' => 'Proyek Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
      } else {
        $this->response([
          'status' => false,
          'message' => 'Proyek Not Found'
          ], REST_Controller::HTTP_NOT_FOUND);
      }
    }

    public function dokumentasi_post(){
      $dataURL = $this->post('dokumentasi');
      foreach($dataURL as $data){
        $dokumentasi = [
          'pekerjaanID' => $this->post('id'),
          'dataURL' => $data
        ];

        $this->dokumentasi_pekerjaan_model->insert_dokumentasi($dokumentasi);
      }

      $this->set_response([
        'status' => true,
        'message' => 'Success'
      ], REST_Controller::HTTP_CREATED);
    }

    private function getKontraktor($id){
      return $this->kontraktor_model->get_kontraktor_byid($id);
    }

  }


 ?> 