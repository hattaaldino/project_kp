<?php
  // API for retrieve Users
use Restserver\Libraries\REST_Controller;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('owner_model');
    $this->load->model('pengawas_model');
    $this->load->model('kontraktor_model');
  }

  public function index_post(){
    $id = $this->post('id');
    $username = $this->post('username');
    $password = $this->post('password');
    $role = $this->post('role');
    
    $data = array(
      'nama' => $this->post('nama'),
      'username' => $username,
      'password' => md5($password),
      'role' => $role,
      'alamat' => $this->post('alamat'),
      'telepon' => $this->post('telepon'),
      'profile' => $this->post('profile')
    );

    $user = array(
      'username' => $username,
      'password' => md5($password),
      'role' => $role
    );
    $this->user_model->update_user($username, $user);

    if($role == 'owner'){
      $this->owner_model->update_owner($id, $data);
      $new_owner = $this->owner_model->get_owner_byid($id);
      if($new_owner){
        $this->response([
          'status' => true,
          'data' => $new_owner  
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Data Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } elseif($role == 'kontraktor'){
      $this->kontraktor_model->update_kontraktor($id, $data);
      $new_kontraktor = $this->kontraktor_model->get_kontraktor_byid($id);
      if($new_kontraktor){
        $this->response([
          'status' => true,
          'data' => $new_kontraktor  
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Data Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } elseif($role == 'pengawas') {
      $this->pengawas_model->update_pengawas($id, $data);
      $new_pengawas = $this->pengawas_model->get_pengawas_byid($id);
      if($new_pengawas){
        $this->response([
          'status' => true,
          'data' => $new_pengawas  
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Data Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $this->response([
        'status' => false,
        'message' => 'Data Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function edit_pengawas_post(){
    $id = $this->post('id');
    $username = $this->post('username');
    $password = $this->post('password');
    $role = $this->post('role');
    
    $data = array(
      'nama' => $this->post('nama'),
      'username' => $username,
      'password' => md5($password),
      'role' => $role,
      'alamat' => $this->post('alamat'),
      'telepon' => $this->post('telepon'),
      'profile' => $this->post('profile')
    );

    $user = array(
      'username' => $username,
      'password' => md5($password),
      'role' => $role
    );
    $this->user_model->update_user($username, $user);

    $this->pengawas_model->update_pengawas($id, $data);
      $new_pengawas = $this->pengawas_model->get_pengawas_byowner($_SESSION['user']['id']);
      if($new_pengawas){
        $this->response([
          'status' => true,
          'data' => $new_pengawas  
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => false,
          'message' => 'Data Not Found'
        ], REST_Controller::HTTP_NOT_FOUND);
      }
  }

  public function pengawas_post(){
    $pengawas = $this->pengawas_model->get_pengawas_byid($this->post('id'));

    if($pengawas){
      $this->response([
        'status' => true,
        'data' => $pengawas  
      ], REST_Controller::HTTP_OK);
    }else{
      $this->response([
        'status' => false,
        'message' => 'Data Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function kontraktor_post(){
    $kontraktor = $this->kontraktor_model->get_kontraktor_byid($this->post('id'));

    if($kontraktor){
      $this->response([
        'status' => true,
        'data' => $kontraktor  
      ], REST_Controller::HTTP_OK);
    }else{
      $this->response([
        'status' => false,
        'message' => 'Data Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function pengawas_byowner_get(){
    $ownerID = $_SESSION['user']['id'];
    $pengawas = $this->pengawas_model->get_pengawas_byowner($ownerID);
    if($pengawas){
      $this->response([
        'status' => true,
        'data' => $pengawas  
      ], REST_Controller::HTTP_OK);
    }else{
      $this->response([
        'status' => false,
        'message' => 'Data Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function kontraktorall_get(){
    $allkontraktor = $this->kontraktor_model->get_kontraktor();
    if($allkontraktor){
      $this->response([
        'status' => true,
        'data' => $allkontraktor  
      ], REST_Controller::HTTP_OK);
    }else{
      $this->response([
        'status' => false,
        'message' => 'Data Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }



}

?>

