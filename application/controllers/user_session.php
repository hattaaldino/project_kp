<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    session_start();

    class user_session extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
        }	

        public function index(){
            if(isset($_POST['user'])){
                $user = $_POST['user'];
                $_SESSION['user'] = json_decode($user, true);
            }
        }
    }
?>