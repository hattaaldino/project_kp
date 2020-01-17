<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loadview extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct(){
        parent::__construct();
    }
	public function regis_owner()
	{
		$this->load->view('register/register_akun_owner');
	}

	public function regis_kontraktor()
	{
		$this->load->view('register/register_akun_kontraktor');
	}

	public function logout()
	{
		$this->load->view('login_utama');
	}

}
