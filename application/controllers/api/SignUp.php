<?php
use Restserver\Libraries\REST_Controller;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class SignUp extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('owner_model');
        $this->load->model('pengawas_model');
        $this->load->model('kontraktor_model');
    }

    public function index_post(){
        $nama = $this->post('nama');
        $username = $this->post('username');
        $password = $this->post('password');
        $role = $this->post('role');
        $alamat = $this->post('alamat');
        $telepon = $this->post('telepon');
        $profile = $this->post('profile');

        $user = array(
            'username' => $username,
            'password' => md5($password),
            'role'     => $role
        );

        $status_user = $this->user_model->insert_user($user);
        if($status_user == 'success'){
            if($role == 'owner') {
                $owner = array(
                    'nama' => $nama,
                    'username' => $username,
                    'password' => md5($password),
                    'role' => $role,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'profile' => $profile
                );

                $this->owner_model->insert_owner($owner);
                $ownerID = $this->$db->insertID();
                $owner['password'] = $password;
                $owner['id'] = $ownerID;

                $this->response([
                    'status' => true,
                    'data' => $owner
                ], REST_Controller::HTTP_OK);
            } elseif($role == 'kontraktor') {
                $kontraktor = array(
                    'nama' => $nama,
                    'username' => $username,
                    'password' => md5($password),
                    'role' => $role,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'profile' => $profile
                );

                $this->kontraktor_model->insert_kontraktor($kontraktor);
                $kontraktorID = $this->$db->insertID();
                $kontraktor['password'] = $password;
                $kontraktor['id'] = $kontraktorID;

                $this->response([
                    'status' => true,
                    'data' => $kontraktor
                ], REST_Controller::HTTP_OK);
            } elseif($role == 'pengawas') {
                $pengawas = array(
                    'nama' => $nama,
                    'username' => $username,
                    'password' => md5($password),
                    'role' => $role,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'profile' => $profile,
                    'ownerID' => $this->post('ownerID')
                );

                $this->pengawas_model->insert_pengawas($pengawas);
                $listpengawas = $this->pengawas_model->get_pengawas_byowner($_SESSION['user']['id']);

                $this->response([
                    'status' => true,
                    'data' => $listpengawas
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'SignUp Failed'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }  
        elseif($status_user == 'duplicate'){
            $this->response([
                'status' => false,
                'message' => 'Data Already Exist'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        else{
            $this->response([
                'status' => false,
                'message' => 'SignUp Failed'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}