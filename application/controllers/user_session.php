<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    session_start();

    class user_session extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
        }	

        public function userIn(){
            $_SESSION['user'] = $_POST;
        }
    }
?>