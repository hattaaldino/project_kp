<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class user_session extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
        }	

        public function index(){
            if($this->input->post('user')){
                $user = $this->input->post('user');
                $_SESSION['user'] = json_decode($user, true);
            }
        }
    }
?>