<?php
use Restserver\Libraries\REST_Controller;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('owner_model');
        $this->load->model('pengawas_model');
        $this->load->model('kontraktor_model');
    }

    public function index_post(){
        $username = $this->post('username');
        $password = $this->post('password');

        $user = $this->user_model->get_login($username, $password);
        if($user['role'] == 'owner') {
            $login_check = $this->owner_model->get_owner_byUname($username);
        } elseif($user['role'] == 'kontraktor') {
            $login_check = $this->kontraktor_model->get_kontraktor_byUname($username);
        } elseif($user['role'] == 'pengawas') {
            $login_check = $this->pengawas_model->get_pengawas_byUname($username);
        }
        
        if($login_check){
            $this->response([
                'status' => true,
                'data' => $login_check
                ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Login Failed'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}